<?php

declare(strict_types=1);

namespace Tests\Integration;

use App\Infrastructure\Database\DatabaseConfig;
use App\Infrastructure\Database\MigrationRunner;
use App\Infrastructure\Database\PdoConnectionFactory;
use PDO;
use PDOException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class AuditWriteFoundationTest extends TestCase
{
    private const TEST_SCHEMA = 'e2_s1_audit_write_foundation_test';

    private PDO $pdo;

    protected function setUp(): void
    {
        $config = DatabaseConfig::fromEnvironment(
            $this->databaseEnvironment(),
        );

        $this->pdo = (new PdoConnectionFactory())->connect(
            $config,
        );

        $this->pdo->exec(
            sprintf(
                'DROP SCHEMA IF EXISTS %s CASCADE',
                self::TEST_SCHEMA,
            ),
        );

        $this->pdo->exec(
            sprintf(
                'CREATE SCHEMA %s',
                self::TEST_SCHEMA,
            ),
        );

        $this->pdo->exec(
            sprintf(
                'SET search_path TO %s',
                self::TEST_SCHEMA,
            ),
        );

        $runner = new MigrationRunner(
            $this->pdo,
            dirname(__DIR__, 2) . '/migrations',
        );

        $runner->run();
    }

    protected function tearDown(): void
    {
        if (!isset($this->pdo)) {
            return;
        }

        $this->pdo->exec('SET search_path TO public');

        $this->pdo->exec(
            sprintf(
                'DROP SCHEMA IF EXISTS %s CASCADE',
                self::TEST_SCHEMA,
            ),
        );
    }

    public function testAuditMigrationCreatesCoreSchemaWithoutUserForeignKey(): void
    {
        self::assertTrue(
            $this->tableExists('audit_log'),
            'E2-S1 must create the audit_log table.',
        );

        $actorUserId = $this->columnMetadata(
            'audit_log',
            'actor_user_id',
        );

        self::assertSame(
            'bigint',
            $actorUserId['data_type'],
        );

        self::assertSame(
            'YES',
            $actorUserId['is_nullable'],
        );

        self::assertSame(
            0,
            $this->actorUserIdForeignKeyCount(),
            'E2-S1 must not add the User foreign key before E1-S1 creates users.',
        );
    }

    public function testValidActorShapesCanBePersisted(): void
    {
        $this->insertAudit(
            actorType: 'user',
            actorUserId: 101,
            attemptedPrincipal: null,
            action: 'authentication.login',
        );

        $this->insertAudit(
            actorType: 'anonymous',
            actorUserId: null,
            attemptedPrincipal: 'editor@example.test',
            action: 'authentication.login_failed',
        );

        $this->insertAudit(
            actorType: 'anonymous',
            actorUserId: null,
            attemptedPrincipal: null,
            action: 'authentication.login_failed',
        );

        $this->insertAudit(
            actorType: 'system',
            actorUserId: null,
            attemptedPrincipal: null,
            action: 'system.maintenance',
        );

        $rows = $this->pdo
            ->query(
                <<<'SQL'
                SELECT
                    actor_type,
                    actor_user_id,
                    attempted_principal
                FROM audit_log
                ORDER BY id
                SQL,
            )
            ->fetchAll();

        self::assertSame(
            [
                [
                    'actor_type' => 'user',
                    'actor_user_id' => 101,
                    'attempted_principal' => null,
                ],
                [
                    'actor_type' => 'anonymous',
                    'actor_user_id' => null,
                    'attempted_principal' => 'editor@example.test',
                ],
                [
                    'actor_type' => 'anonymous',
                    'actor_user_id' => null,
                    'attempted_principal' => null,
                ],
                [
                    'actor_type' => 'system',
                    'actor_user_id' => null,
                    'attempted_principal' => null,
                ],
            ],
            $rows,
        );
    }

    /**
     * @return iterable<string, array{string, ?int}>
     */
    public static function invalidActorShapes(): iterable
    {
        yield 'user requires actor_user_id' => [
            'user',
            null,
        ];

        yield 'anonymous forbids actor_user_id' => [
            'anonymous',
            101,
        ];

        yield 'system forbids actor_user_id' => [
            'system',
            101,
        ];
    }

    #[DataProvider('invalidActorShapes')]
    public function testInvalidActorShapesAreRejected(
        string $actorType,
        ?int $actorUserId,
    ): void {
        self::assertTrue(
            $this->tableExists('audit_log'),
            'E2-S1 must create the audit_log table before actor constraints can be verified.',
        );

        $this->expectException(PDOException::class);

        $this->insertAudit(
            actorType: $actorType,
            actorUserId: $actorUserId,
            attemptedPrincipal: null,
            action: 'test.invalid_actor',
        );
    }

    public function testCoreAuditPayloadRoundTrips(): void
    {
        $statement = $this->pdo->prepare(
            <<<'SQL'
            INSERT INTO audit_log (
                actor_type,
                actor_user_id,
                attempted_principal,
                action,
                target_type,
                target_id,
                before_data,
                after_data,
                reason,
                correlation_metadata
            )
            VALUES (
                :actor_type,
                :actor_user_id,
                :attempted_principal,
                :action,
                :target_type,
                :target_id,
                CAST(:before_data AS jsonb),
                CAST(:after_data AS jsonb),
                :reason,
                CAST(:correlation_metadata AS jsonb)
            )
            RETURNING id
            SQL,
        );

        $statement->execute([
            'actor_type' => 'system',
            'actor_user_id' => null,
            'attempted_principal' => null,
            'action' => 'content.example',
            'target_type' => 'content',
            'target_id' => '123',
            'before_data' => '{"status":"draft"}',
            'after_data' => '{"status":"published"}',
            'reason' => 'integration test',
            'correlation_metadata' => '{"correlation_id":"corr-123","request_id":"req-456"}',
        ]);

        $id = $statement->fetchColumn();

        self::assertIsInt($id);

        $read = $this->pdo->prepare(
            <<<'SQL'
            SELECT
                action,
                target_type,
                target_id,
                occurred_at,
                before_data,
                after_data,
                reason,
                correlation_metadata
            FROM audit_log
            WHERE id = :id
            SQL,
        );

        $read->execute([
            'id' => $id,
        ]);

        $row = $read->fetch();

        self::assertIsArray($row);
        self::assertSame('content.example', $row['action']);
        self::assertSame('content', $row['target_type']);
        self::assertSame('123', $row['target_id']);
        self::assertNotSame('', $row['occurred_at']);
        self::assertSame(
            ['status' => 'draft'],
            json_decode($row['before_data'], true, flags: JSON_THROW_ON_ERROR),
        );
        self::assertSame(
            ['status' => 'published'],
            json_decode($row['after_data'], true, flags: JSON_THROW_ON_ERROR),
        );
        self::assertSame('integration test', $row['reason']);
        self::assertSame(
            [
                'request_id' => 'req-456',
                'correlation_id' => 'corr-123',
            ],
            json_decode(
                $row['correlation_metadata'],
                true,
                flags: JSON_THROW_ON_ERROR,
            ),
        );
    }

    private function insertAudit(
        string $actorType,
        ?int $actorUserId,
        ?string $attemptedPrincipal,
        string $action,
    ): int {
        $statement = $this->pdo->prepare(
            <<<'SQL'
            INSERT INTO audit_log (
                actor_type,
                actor_user_id,
                attempted_principal,
                action,
                target_type,
                target_id,
                correlation_metadata
            )
            VALUES (
                :actor_type,
                :actor_user_id,
                :attempted_principal,
                :action,
                :target_type,
                :target_id,
                CAST(:correlation_metadata AS jsonb)
            )
            RETURNING id
            SQL,
        );

        $statement->execute([
            'actor_type' => $actorType,
            'actor_user_id' => $actorUserId,
            'attempted_principal' => $attemptedPrincipal,
            'action' => $action,
            'target_type' => 'integration_test',
            'target_id' => 'fixture-1',
            'correlation_metadata' => '{}',
        ]);

        $id = $statement->fetchColumn();

        if (!is_int($id)) {
            throw new RuntimeException(
                'Expected Audit INSERT to return an integer id.',
            );
        }

        return $id;
    }

    /**
     * @return array{data_type: string, is_nullable: string}
     */
    private function columnMetadata(
        string $tableName,
        string $columnName,
    ): array {
        $statement = $this->pdo->prepare(
            <<<'SQL'
            SELECT
                data_type,
                is_nullable
            FROM information_schema.columns
            WHERE table_schema = current_schema()
              AND table_name = :table_name
              AND column_name = :column_name
            SQL,
        );

        $statement->execute([
            'table_name' => $tableName,
            'column_name' => $columnName,
        ]);

        $metadata = $statement->fetch();

        self::assertIsArray(
            $metadata,
            sprintf(
                'Expected column %s.%s to exist.',
                $tableName,
                $columnName,
            ),
        );

        return $metadata;
    }

    private function tableExists(string $tableName): bool
    {
        $statement = $this->pdo->prepare(
            <<<'SQL'
            SELECT EXISTS (
                SELECT 1
                FROM information_schema.tables
                WHERE table_schema = current_schema()
                  AND table_name = :table_name
            )
            SQL,
        );

        $statement->execute([
            'table_name' => $tableName,
        ]);

        return $statement->fetchColumn() === true;
    }

    private function actorUserIdForeignKeyCount(): int
    {
        $statement = $this->pdo->query(
            <<<'SQL'
            SELECT COUNT(*)
            FROM information_schema.table_constraints AS constraints
            INNER JOIN information_schema.key_column_usage AS columns
                ON columns.constraint_schema = constraints.constraint_schema
               AND columns.constraint_name = constraints.constraint_name
            WHERE constraints.constraint_type = 'FOREIGN KEY'
              AND constraints.table_schema = current_schema()
              AND constraints.table_name = 'audit_log'
              AND columns.column_name = 'actor_user_id'
            SQL,
        );

        return (int) $statement->fetchColumn();
    }

    /**
     * @return array<string, string>
     */
    private function databaseEnvironment(): array
    {
        return [
            'DB_HOST' => $this->requiredEnvironmentVariable('DB_HOST'),
            'DB_PORT' => $this->requiredEnvironmentVariable('DB_PORT'),
            'DB_NAME' => $this->requiredEnvironmentVariable('DB_NAME'),
            'DB_USER' => $this->requiredEnvironmentVariable('DB_USER'),
            'DB_PASSWORD' => $this->requiredEnvironmentVariable('DB_PASSWORD'),
        ];
    }

    private function requiredEnvironmentVariable(string $name): string
    {
        $value = getenv($name);

        if (!is_string($value) || trim($value) === '') {
            throw new RuntimeException(
                sprintf(
                    'Required integration-test environment variable %s is missing.',
                    $name,
                ),
            );
        }

        return $value;
    }
}

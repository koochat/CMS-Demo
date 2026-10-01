<?php

declare(strict_types=1);

namespace Tests\Integration;

use App\Infrastructure\Database\DatabaseConfig;
use App\Infrastructure\Database\MigrationRunner;
use App\Infrastructure\Database\PdoConnectionFactory;
use App\Modules\Audit\AuditRecord;
use App\Modules\Audit\AuditRepository;
use App\Modules\Audit\AuditWriter;
use PDO;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use RuntimeException;

final class AuditApplicationTest extends TestCase
{
    private const TEST_SCHEMA = 'e2_s1_audit_application_test';

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

    public function testWriterAppendsAuditRecord(): void
    {
        $repository = new AuditRepository(
            $this->pdo,
        );

        $writer = new AuditWriter(
            $repository,
        );

        $record = new AuditRecord(
            actorType: 'anonymous',
            actorUserId: null,
            attemptedPrincipal: 'editor@example.test',
            action: 'authentication.login_failed',
            targetType: 'authentication',
            targetId: 'editor@example.test',
            beforeData: null,
            afterData: null,
            reason: 'invalid credentials',
            correlationMetadata: [
                'correlation_id' => 'corr-123',
                'request_id' => 'req-456',
            ],
        );

        $id = $writer->write(
            $record,
        );

        self::assertGreaterThan(
            0,
            $id,
        );

        $statement = $this->pdo->prepare(
            <<<'SQL'
            SELECT
                actor_type,
                actor_user_id,
                attempted_principal,
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

        $statement->execute([
            'id' => $id,
        ]);

        $persisted = $statement->fetch();

        self::assertIsArray($persisted);
        self::assertSame('anonymous', $persisted['actor_type']);
        self::assertNull($persisted['actor_user_id']);
        self::assertSame(
            'editor@example.test',
            $persisted['attempted_principal'],
        );
        self::assertSame(
            'authentication.login_failed',
            $persisted['action'],
        );
        self::assertSame(
            'authentication',
            $persisted['target_type'],
        );
        self::assertSame(
            'editor@example.test',
            $persisted['target_id'],
        );
        self::assertNotSame('', $persisted['occurred_at']);
        self::assertNull($persisted['before_data']);
        self::assertNull($persisted['after_data']);
        self::assertSame(
            'invalid credentials',
            $persisted['reason'],
        );

        self::assertEquals(
            [
                'correlation_id' => 'corr-123',
                'request_id' => 'req-456',
            ],
            json_decode(
                $persisted['correlation_metadata'],
                true,
                flags: JSON_THROW_ON_ERROR,
            ),
        );
    }

    public function testRepositoryUsesBoundParametersForAuditValues(): void
    {
        $repository = new AuditRepository(
            $this->pdo,
        );

        $writer = new AuditWriter(
            $repository,
        );

        $dangerousTarget = "fixture-1'); DROP TABLE audit_log; --";

        $id = $writer->write(
            new AuditRecord(
                actorType: 'system',
                actorUserId: null,
                attemptedPrincipal: null,
                action: "system.operator's_action",
                targetType: 'integration_test',
                targetId: $dangerousTarget,
                beforeData: [
                    'value' => "before's value",
                ],
                afterData: [
                    'value' => "after's value",
                ],
                reason: "operator's reason",
                correlationMetadata: [],
            ),
        );

        $statement = $this->pdo->prepare(
            <<<'SQL'
            SELECT
                action,
                target_id
            FROM audit_log
            WHERE id = :id
            SQL,
        );

        $statement->execute([
            'id' => $id,
        ]);

        $persisted = $statement->fetch();

        self::assertIsArray($persisted);

        self::assertSame(
            $dangerousTarget,
            $persisted['target_id'],
        );

        self::assertSame(
            "system.operator's_action",
            $persisted['action'],
        );
    }

    public function testApplicationApiDoesNotExposeAuditMutationOperations(): void
    {
        $repository = new ReflectionClass(
            AuditRepository::class,
        );

        $writer = new ReflectionClass(
            AuditWriter::class,
        );

        foreach ([
            'update',
            'delete',
            'remove',
            'replace',
        ] as $forbiddenMethod) {
            self::assertFalse(
                $repository->hasMethod($forbiddenMethod),
                sprintf(
                    'AuditRepository must not expose %s().',
                    $forbiddenMethod,
                ),
            );

            self::assertFalse(
                $writer->hasMethod($forbiddenMethod),
                sprintf(
                    'AuditWriter must not expose %s().',
                    $forbiddenMethod,
                ),
            );
        }
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

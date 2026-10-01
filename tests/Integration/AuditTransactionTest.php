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
use PDOException;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Throwable;

final class AuditTransactionTest extends TestCase
{
    private const TEST_SCHEMA = 'e2_s1_audit_transaction_test';

    private PDO $pdo;

    private AuditRepository $repository;

    private AuditWriter $writer;

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

        $this->pdo->exec(
            <<<'SQL'
            CREATE TABLE domain_fixture (
                id bigint GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
                value text NOT NULL
            )
            SQL,
        );

        $this->repository = new AuditRepository(
            $this->pdo,
        );

        $this->writer = new AuditWriter(
            $this->repository,
        );
    }

    protected function tearDown(): void
    {
        if (!isset($this->pdo)) {
            return;
        }

        if ($this->pdo->inTransaction()) {
            $this->pdo->rollBack();
        }

        $this->pdo->exec('SET search_path TO public');

        $this->pdo->exec(
            sprintf(
                'DROP SCHEMA IF EXISTS %s CASCADE',
                self::TEST_SCHEMA,
            ),
        );
    }

    public function testDomainChangeAndAuditCommitTogether(): void
    {
        $this->pdo->beginTransaction();

        try {
            $domainId = $this->insertDomainRecord(
                'published',
            );

            $auditId = $this->writer->write(
                new AuditRecord(
                    actorType: 'system',
                    actorUserId: null,
                    attemptedPrincipal: null,
                    action: 'domain_fixture.created',
                    targetType: 'domain_fixture',
                    targetId: (string) $domainId,
                    beforeData: null,
                    afterData: [
                        'value' => 'published',
                    ],
                    reason: 'transaction commit verification',
                    correlationMetadata: [
                        'correlation_id' => 'commit-001',
                    ],
                ),
            );

            $this->pdo->commit();
        } catch (Throwable $exception) {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }

            throw $exception;
        }

        self::assertSame(
            1,
            $this->domainRowCount(),
        );

        self::assertSame(
            1,
            $this->auditRowCount(),
        );

        $statement = $this->pdo->prepare(
            <<<'SQL'
            SELECT COUNT(*)
            FROM audit_log
            WHERE id = :id
            SQL,
        );

        $statement->execute([
            'id' => $auditId,
        ]);

        self::assertSame(
            1,
            (int) $statement->fetchColumn(),
        );
    }

    public function testFailedRequiredAuditRollsBackDomainChange(): void
    {
        $this->pdo->beginTransaction();

        $domainId = $this->insertDomainRecord(
            'must-not-survive',
        );

        self::assertGreaterThan(
            0,
            $domainId,
            'Domain fixture INSERT must succeed before the required Audit write is exercised.',
        );

        self::assertSame(
            1,
            $this->domainRowCount(),
            'Domain change must exist inside the caller transaction before the Audit write fails.',
        );

        try {
            $this->writer->write(
                new AuditRecord(
                    actorType: 'user',
                    actorUserId: null,
                    attemptedPrincipal: null,
                    action: 'domain_fixture.created',
                    targetType: 'domain_fixture',
                    targetId: (string) $domainId,
                    beforeData: null,
                    afterData: [
                        'value' => 'must-not-survive',
                    ],
                    reason: 'force invalid actor constraint',
                    correlationMetadata: [
                        'correlation_id' => 'rollback-001',
                    ],
                ),
            );

            self::fail(
                'Expected required Audit write to fail the actor identity constraint.',
            );
        } catch (PDOException $exception) {
            self::assertSame(
                '23514',
                $exception->errorInfo[0] ?? null,
                'Expected PostgreSQL CHECK constraint SQLSTATE 23514.',
            );

            self::assertStringContainsString(
                'audit_log_actor_identity_check',
                $exception->getMessage(),
                'Expected the Audit actor identity constraint to cause the failure.',
            );

            self::assertTrue(
                $this->pdo->inTransaction(),
                'The caller transaction must remain active until the caller rolls it back.',
            );

            $this->pdo->rollBack();
        }

        self::assertSame(
            0,
            $this->domainRowCount(),
            'Domain change must roll back when its required Audit write fails.',
        );

        self::assertSame(
            0,
            $this->auditRowCount(),
            'Failed Audit write must not leave a partial Audit row.',
        );
    }

    private function insertDomainRecord(string $value): int
    {
        $statement = $this->pdo->prepare(
            <<<'SQL'
            INSERT INTO domain_fixture (value)
            VALUES (:value)
            RETURNING id
            SQL,
        );

        $statement->execute([
            'value' => $value,
        ]);

        $id = $statement->fetchColumn();

        if ($id === false) {
            throw new RuntimeException(
                'Domain fixture INSERT did not return an id.',
            );
        }

        return (int) $id;
    }

    private function domainRowCount(): int
    {
        return (int) $this->pdo
            ->query(
                <<<'SQL'
                SELECT COUNT(*)
                FROM domain_fixture
                SQL,
            )
            ->fetchColumn();
    }

    private function auditRowCount(): int
    {
        return (int) $this->pdo
            ->query(
                <<<'SQL'
                SELECT COUNT(*)
                FROM audit_log
                SQL,
            )
            ->fetchColumn();
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

<?php

declare(strict_types=1);

namespace Tests\Integration;

use App\Infrastructure\Database\DatabaseConfig;
use App\Infrastructure\Database\MigrationRunner;
use App\Infrastructure\Database\PdoConnectionFactory;
use PDO;
use PDOException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class MigrationRunnerTest extends TestCase
{
    private const TEST_SCHEMA = 'e0_s4_migration_runner_test';

    private PDO $pdo;

    private string $migrationDirectory;

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

        $this->migrationDirectory = sprintf(
            '%s/mol-cms-e0-s4-migrations',
            sys_get_temp_dir(),
        );

        $this->resetMigrationDirectory();

        /*
         * Deliberately create 002 before 001.
         *
         * Migration 002 references a table created by 001, so the test proves
         * that the runner orders migrations by filename instead of relying on
         * filesystem creation order.
         */
        $this->writeMigration(
            '002_create_second_table.sql',
            <<<'SQL'
CREATE TABLE second_table (
    id integer PRIMARY KEY,
    first_id integer NOT NULL REFERENCES first_table(id)
);
SQL,
        );

        $this->writeMigration(
            '001_create_first_table.sql',
            <<<'SQL'
CREATE TABLE first_table (
    id integer PRIMARY KEY
);
SQL,
        );
    }

    protected function tearDown(): void
    {
        if (isset($this->pdo)) {
            $this->pdo->exec('SET search_path TO public');

            $this->pdo->exec(
                sprintf(
                    'DROP SCHEMA IF EXISTS %s CASCADE',
                    self::TEST_SCHEMA,
                ),
            );
        }

        if (isset($this->migrationDirectory)) {
            $this->removeMigrationDirectory();
        }
    }

    public function testFirstRunAppliesOrderedPendingMigrationsAndRecordsSuccess(): void
    {
        $runner = new MigrationRunner(
            $this->pdo,
            $this->migrationDirectory,
        );

        $runner->run();

        self::assertTrue(
            $this->tableExists('first_table'),
        );

        self::assertTrue(
            $this->tableExists('second_table'),
        );

        $recordedMigrations = $this->pdo
            ->query(
                <<<'SQL'
SELECT migration
FROM schema_migrations
ORDER BY migration
SQL,
            )
            ->fetchAll(PDO::FETCH_COLUMN);

        self::assertSame(
            [
                '001_create_first_table.sql',
                '002_create_second_table.sql',
            ],
            $recordedMigrations,
        );
    }

    public function testSecondRunLeavesSchemaAndMigrationLedgerUnchanged(): void
    {
        $runner = new MigrationRunner(
            $this->pdo,
            $this->migrationDirectory,
        );

        $runner->run();

        $schemaBeforeSecondRun = $this->schemaSnapshot();
        $ledgerBeforeSecondRun = $this->migrationLedgerSnapshot();

        $runner->run();

        self::assertSame(
            $schemaBeforeSecondRun,
            $this->schemaSnapshot(),
        );

        self::assertSame(
            $ledgerBeforeSecondRun,
            $this->migrationLedgerSnapshot(),
        );
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

    /**
     * @return list<array<string, mixed>>
     */
    private function schemaSnapshot(): array
    {
        $statement = $this->pdo->query(
            <<<'SQL'
    SELECT
        table_name,
        column_name,
        ordinal_position,
        data_type,
        is_nullable,
        COALESCE(column_default, '') AS column_default
    FROM information_schema.columns
    WHERE table_schema = current_schema()
    ORDER BY table_name, ordinal_position
    SQL,
        );

        return $statement->fetchAll();
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function migrationLedgerSnapshot(): array
    {
        $statement = $this->pdo->query(
            <<<'SQL'
    SELECT
        migration,
        applied_at::text AS applied_at
    FROM schema_migrations
    ORDER BY migration
    SQL,
        );

        return $statement->fetchAll();
    }

    private function resetMigrationDirectory(): void
    {
        $this->removeMigrationDirectory();

        if (!mkdir($this->migrationDirectory, 0777, true)) {
            throw new RuntimeException(
                sprintf(
                    'Unable to create temporary migration directory: %s',
                    $this->migrationDirectory,
                ),
            );
        }
    }

    private function removeMigrationDirectory(): void
    {
        if (!is_dir($this->migrationDirectory)) {
            return;
        }

        $files = glob(
            $this->migrationDirectory . '/*',
        );

        if ($files === false) {
            throw new RuntimeException(
                'Unable to enumerate temporary migration files.',
            );
        }

        foreach ($files as $file) {
            if (is_file($file) && !unlink($file)) {
                throw new RuntimeException(
                    sprintf(
                        'Unable to remove temporary migration file: %s',
                        $file,
                    ),
                );
            }
        }

        if (!rmdir($this->migrationDirectory)) {
            throw new RuntimeException(
                sprintf(
                    'Unable to remove temporary migration directory: %s',
                    $this->migrationDirectory,
                ),
            );
        }
    }

    private function writeMigration(
        string $filename,
        string $sql,
    ): void {
        $result = file_put_contents(
            $this->migrationDirectory . '/' . $filename,
            $sql . PHP_EOL,
        );

        if ($result === false) {
            throw new RuntimeException(
                sprintf(
                    'Unable to write temporary migration file: %s',
                    $filename,
                ),
            );
        }
    }

    public function testFailingTransactionalMigrationLeavesNoSuccessRecordOrPartialSchemaChanges(): void
    {
        $this->writeMigration(
            '003_failing_transaction.sql',
            <<<'SQL'
    CREATE TABLE should_be_rolled_back (
        id integer PRIMARY KEY
    );

    THIS IS INTENTIONALLY INVALID SQL;
    SQL,
        );

        $runner = new MigrationRunner(
            $this->pdo,
            $this->migrationDirectory,
        );

        try {
            $runner->run();

            self::fail(
                'Expected failing migration to throw a database exception.',
            );
        } catch (PDOException) {
            // Expected: the migration SQL is intentionally invalid.
        }

        self::assertFalse(
            $this->tableExists('should_be_rolled_back'),
            'Partial schema changes from the failing migration must be rolled back.',
        );

        $recordedMigrations = $this->pdo
            ->query(
                <<<'SQL'
    SELECT migration
    FROM schema_migrations
    ORDER BY migration
    SQL,
            )
            ->fetchAll(PDO::FETCH_COLUMN);

        self::assertSame(
            [
                '001_create_first_table.sql',
                '002_create_second_table.sql',
            ],
            $recordedMigrations,
            'The failing migration must not receive a success record.',
        );
    }
}
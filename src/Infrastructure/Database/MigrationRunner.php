<?php

declare(strict_types=1);

namespace App\Infrastructure\Database;

use PDO;
use RuntimeException;
use Throwable;

final class MigrationRunner
{
    public function __construct(
        private readonly PDO $pdo,
        private readonly string $migrationDirectory,
    ) {
    }

    public function run(): void
    {
        $this->ensureMigrationLedgerExists();

        foreach ($this->pendingMigrationFiles() as $migrationFile) {
            $this->applyMigration($migrationFile);
        }
    }

    private function ensureMigrationLedgerExists(): void
    {
        $this->pdo->exec(
            <<<'SQL'
            CREATE TABLE IF NOT EXISTS schema_migrations (
                migration text PRIMARY KEY,
                applied_at timestamptz NOT NULL DEFAULT CURRENT_TIMESTAMP
            )
            SQL,
        );
    }

    /**
     * @return list<string>
     */
    private function pendingMigrationFiles(): array
    {
        if (!is_dir($this->migrationDirectory)) {
            throw new RuntimeException(
                sprintf(
                    'Migration directory does not exist: %s',
                    $this->migrationDirectory,
                ),
            );
        }

        $migrationFiles = glob(
            $this->migrationDirectory
                . DIRECTORY_SEPARATOR
                . '*.sql',
        );

        if ($migrationFiles === false) {
            throw new RuntimeException(
                sprintf(
                    'Unable to enumerate migration files: %s',
                    $this->migrationDirectory,
                ),
            );
        }

        sort(
            $migrationFiles,
            SORT_STRING,
        );

        $appliedMigrations = $this->appliedMigrationNames();

        return array_values(
            array_filter(
                $migrationFiles,
                static fn (string $migrationFile): bool =>
                    !isset(
                        $appliedMigrations[
                            basename($migrationFile)
                        ],
                    ),
            ),
        );
    }

    /**
     * @return array<string, true>
     */
    private function appliedMigrationNames(): array
    {
        $statement = $this->pdo->query(
            <<<'SQL'
            SELECT migration
            FROM schema_migrations
            SQL,
        );

        $migrationNames = $statement->fetchAll(
            PDO::FETCH_COLUMN,
        );

        $appliedMigrations = [];

        foreach ($migrationNames as $migrationName) {
            if (is_string($migrationName)) {
                $appliedMigrations[$migrationName] = true;
            }
        }

        return $appliedMigrations;
    }

    private function applyMigration(string $migrationFile): void
    {
        $sql = file_get_contents(
            $migrationFile,
        );

        if ($sql === false) {
            throw new RuntimeException(
                sprintf(
                    'Unable to read migration file: %s',
                    $migrationFile,
                ),
            );
        }

        $migrationName = basename(
            $migrationFile,
        );

        try {
            $this->pdo->beginTransaction();

            $this->pdo->exec(
                $sql,
            );

            $statement = $this->pdo->prepare(
                <<<'SQL'
                INSERT INTO schema_migrations (migration)
                VALUES (:migration)
                SQL,
            );

            $statement->execute([
                'migration' => $migrationName,
            ]);

            $this->pdo->commit();
        } catch (Throwable $exception) {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }

            throw $exception;
        }
    }
}
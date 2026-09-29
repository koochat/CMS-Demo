<?php

declare(strict_types=1);

namespace Tests\Integration;

use App\Infrastructure\Database\DatabaseConfig;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class DatabaseConfigTest extends TestCase
{
    /**
     * @return array<string, array{0: string}>
     */
    public static function requiredEnvironmentVariableProvider(): array
    {
        return [
            'host' => ['DB_HOST'],
            'port' => ['DB_PORT'],
            'name' => ['DB_NAME'],
            'user' => ['DB_USER'],
            'password' => ['DB_PASSWORD'],
        ];
    }

    #[DataProvider('requiredEnvironmentVariableProvider')]
    public function testMissingRequiredDatabaseConfigurationFailsWithDiagnostic(
        string $missingVariable,
    ): void {
        $environment = [
            'DB_HOST' => 'postgres',
            'DB_PORT' => '5432',
            'DB_NAME' => 'mol_cms',
            'DB_USER' => 'mol_cms',
            'DB_PASSWORD' => 'super-secret-test-value',
        ];

        unset($environment[$missingVariable]);

        try {
            DatabaseConfig::fromEnvironment($environment);

            self::fail(
                sprintf(
                    'Expected missing %s to fail configuration validation.',
                    $missingVariable,
                ),
            );
        } catch (InvalidArgumentException $exception) {
            self::assertStringContainsString(
                $missingVariable,
                $exception->getMessage(),
            );

            self::assertStringNotContainsString(
                'super-secret-test-value',
                $exception->getMessage(),
            );
        }
    }
}
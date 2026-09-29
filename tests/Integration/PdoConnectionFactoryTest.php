<?php

declare(strict_types=1);

namespace Tests\Integration;

use App\Infrastructure\Database\DatabaseConfig;
use App\Infrastructure\Database\PdoConnectionFactory;
use PDO;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class PdoConnectionFactoryTest extends TestCase
{
    public function testConnectsToComposePostgres(): void
    {
        $config = DatabaseConfig::fromEnvironment(
            $this->databaseEnvironment(),
        );

        $pdo = (new PdoConnectionFactory())->connect($config);

        self::assertSame(
            'pgsql',
            $pdo->getAttribute(PDO::ATTR_DRIVER_NAME),
        );

        self::assertSame(
            1,
            $pdo->query('SELECT 1')->fetchColumn(),
        );
    }

    public function testFailedConnectionDoesNotExposePassword(): void
    {
        $password = 'intentionally-wrong-secret-value';

        $environment = $this->databaseEnvironment();
        $environment['DB_PASSWORD'] = $password;

        $config = DatabaseConfig::fromEnvironment($environment);

        try {
            (new PdoConnectionFactory())->connect($config);

            self::fail(
                'Expected database connection with invalid credentials to fail.',
            );
        } catch (RuntimeException $exception) {
            self::assertSame(
                'Database connection failed.',
                $exception->getMessage(),
            );

            self::assertStringNotContainsString(
                $password,
                $exception->getMessage(),
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

        self::assertIsString(
            $value,
            sprintf(
                'Required integration-test environment variable %s is missing.',
                $name,
            ),
        );

        self::assertNotSame(
            '',
            trim($value),
            sprintf(
                'Required integration-test environment variable %s is empty.',
                $name,
            ),
        );

        return $value;
    }
}
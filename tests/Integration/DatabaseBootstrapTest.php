<?php

declare(strict_types=1);

namespace Tests\Integration;

use App\Infrastructure\Database\PdoProbeRepository;
use PDO;
use PHPUnit\Framework\TestCase;

final class DatabaseBootstrapTest extends TestCase
{
    public function testBootstrapInjectsConnectedPdoIntoRepository(): void
    {
        $bootstrapPath = dirname(__DIR__, 2) . '/bootstrap/database.php';

        self::assertFileExists($bootstrapPath);

        $repository = require $bootstrapPath;

        self::assertInstanceOf(
            PdoProbeRepository::class,
            $repository,
        );

        $pdo = $repository->connection();

        self::assertInstanceOf(PDO::class, $pdo);

        self::assertSame(
            'pgsql',
            $pdo->getAttribute(PDO::ATTR_DRIVER_NAME),
        );

        self::assertSame(
            1,
            $pdo->query('SELECT 1')->fetchColumn(),
        );
    }
}
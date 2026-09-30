<?php

declare(strict_types=1);

use App\Infrastructure\Database\DatabaseConfig;
use App\Infrastructure\Database\MigrationRunner;
use App\Infrastructure\Database\PdoConnectionFactory;

require dirname(__DIR__) . '/vendor/autoload.php';

try {
    /** @var array<string, mixed> $environment */
    $environment = require dirname(__DIR__) . '/config/database.php';

    $config = DatabaseConfig::fromEnvironment(
        $environment,
    );

    $pdo = (new PdoConnectionFactory())->connect(
        $config,
    );

    $runner = new MigrationRunner(
        $pdo,
        dirname(__DIR__) . '/migrations',
    );

    $runner->run();

    fwrite(
        STDOUT,
        'Migrations completed successfully.' . PHP_EOL,
    );

    exit(0);
} catch (Throwable $exception) {
    fwrite(
        STDERR,
        sprintf(
            'Migration failed: %s%s',
            $exception->getMessage(),
            PHP_EOL,
        ),
    );

    exit(1);
}
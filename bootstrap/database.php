<?php

declare(strict_types=1);

use App\Infrastructure\Database\DatabaseConfig;
use App\Infrastructure\Database\PdoConnectionFactory;
use App\Infrastructure\Database\PdoProbeRepository;

/** @var array<string, mixed> $environment */
$environment = require dirname(__DIR__) . '/config/database.php';

$config = DatabaseConfig::fromEnvironment(
    $environment,
);

$pdo = (new PdoConnectionFactory())->connect(
    $config,
);

return new PdoProbeRepository(
    $pdo,
);
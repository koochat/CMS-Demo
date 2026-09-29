<?php

declare(strict_types=1);

namespace App\Infrastructure\Database;

use PDO;

final class PdoProbeRepository
{
    public function __construct(
        private readonly PDO $pdo,
    ) {
    }

    public function connection(): PDO
    {
        return $this->pdo;
    }
}
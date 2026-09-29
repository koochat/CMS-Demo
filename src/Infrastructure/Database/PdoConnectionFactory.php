<?php

declare(strict_types=1);

namespace App\Infrastructure\Database;

use PDO;
use PDOException;
use RuntimeException;

final class PdoConnectionFactory
{
    public function connect(DatabaseConfig $config): PDO
    {
        $dsn = sprintf(
            'pgsql:host=%s;port=%s;dbname=%s',
            $config->host(),
            $config->port(),
            $config->database(),
        );

        try {
            return new PDO(
                $dsn,
                $config->user(),
                $config->password(),
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ],
            );
        } catch (PDOException) {
            throw new RuntimeException(
                'Database connection failed.',
            );
        }
    }
}
<?php

declare(strict_types=1);

namespace App\Infrastructure\Database;

use InvalidArgumentException;

final class DatabaseConfig
{
    private const REQUIRED_VARIABLES = [
        'DB_HOST',
        'DB_PORT',
        'DB_NAME',
        'DB_USER',
        'DB_PASSWORD',
    ];

    /**
     * @param array<string, string> $values
     */
    private function __construct(
        private readonly array $values,
    ) {
    }

    /**
     * @param array<string, mixed> $environment
     */
    public static function fromEnvironment(array $environment): self
    {
        $values = [];

        foreach (self::REQUIRED_VARIABLES as $variable) {
            $value = $environment[$variable] ?? null;

            if (!is_string($value) || trim($value) === '') {
                throw new InvalidArgumentException(
                    sprintf(
                        'Missing required database configuration: %s.',
                        $variable,
                    ),
                );
            }

            $values[$variable] = $value;
        }

        return new self($values);
    }

    public function host(): string
    {
        return $this->values['DB_HOST'];
    }

    public function port(): string
    {
        return $this->values['DB_PORT'];
    }

    public function database(): string
    {
        return $this->values['DB_NAME'];
    }

    public function user(): string
    {
        return $this->values['DB_USER'];
    }

    public function password(): string
    {
        return $this->values['DB_PASSWORD'];
    }
}
<?php

declare(strict_types=1);

namespace App\Http;

final class Router
{
    /**
     * @var array<string, array<string, callable>>
     */
    private array $routes = [];

    public function get(string $path, callable $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function dispatch(string $method, string $path): ?callable
    {
        $method = strtoupper($method);

        return $this->routes[$method][$path] ?? null;
    }
}
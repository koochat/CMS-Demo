<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Http\HealthController;
use App\Http\Router;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionNamedType;
use Twig\Environment;

final class FrontControllerTest extends TestCase
{
    public function testGetHealthTraversesFrontControllerAndReturnsEscapedHtml(): void
    {
        [$statusCode, $body] = $this->runFrontController(
            'GET',
            '/health',
        );

        self::assertSame(200, $statusCode);
        self::assertStringContainsString('<h1>Health</h1>', $body);
        self::assertStringContainsString('OK &lt;ready&gt;', $body);
        self::assertStringNotContainsString('OK <ready>', $body);
    }

    public function testUnknownPathReturns404(): void
    {
        [$statusCode, $body] = $this->runFrontController(
            'GET',
            '/does-not-exist',
        );

        self::assertSame(404, $statusCode);
        self::assertStringContainsString('Not Found', $body);
    }

    public function testBootstrapWiresHealthControllerWithTwigByConstructor(): void
    {
        $router = require dirname(__DIR__, 2) . '/bootstrap/app.php';

        self::assertInstanceOf(Router::class, $router);

        $handler = $router->dispatch('GET', '/health');

        self::assertInstanceOf(HealthController::class, $handler);

        $constructor = (new ReflectionClass($handler))->getConstructor();

        self::assertNotNull($constructor);

        $parameters = $constructor->getParameters();

        self::assertCount(1, $parameters);

        $type = $parameters[0]->getType();

        self::assertInstanceOf(ReflectionNamedType::class, $type);
        self::assertSame(Environment::class, $type->getName());
    }

    /**
     * @return array{0: int, 1: string}
     */
    private function runFrontController(string $method, string $uri): array
    {
        $_SERVER['REQUEST_METHOD'] = $method;
        $_SERVER['REQUEST_URI'] = $uri;

        http_response_code(200);

        ob_start();

        try {
            require dirname(__DIR__, 2) . '/public/index.php';

            $body = (string) ob_get_contents();
        } finally {
            ob_end_clean();
        }

        return [
            http_response_code(),
            $body,
        ];
    }
}
<?php

declare(strict_types=1);

namespace Tests\Unit\Http;

use App\Http\Router;
use PHPUnit\Framework\TestCase;

final class RouterTest extends TestCase
{
    public function testDispatchReturnsRegisteredGetHandler(): void
    {
        $router = new Router();

        $handler = static fn (): string => 'health';

        $router->get('/health', $handler);

        $matchedHandler = $router->dispatch('GET', '/health');

        self::assertSame($handler, $matchedHandler);
    }

    public function testDispatchReturnsNullForUnknownPath(): void
    {
        $router = new Router();

        $handler = static fn (): string => 'health';

        $router->get('/health', $handler);

        self::assertNull(
            $router->dispatch('GET', '/does-not-exist'),
        );
    }

    public function testDispatchDoesNotMatchDifferentHttpMethod(): void
    {
        $router = new Router();

        $handler = static fn (): string => 'health';

        $router->get('/health', $handler);

        self::assertNull(
            $router->dispatch('POST', '/health'),
        );
    }
}
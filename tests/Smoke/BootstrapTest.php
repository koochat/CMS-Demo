<?php

declare(strict_types=1);

namespace Tests\Smoke;

use PHPUnit\Framework\TestCase;
use Twig\Environment;

final class BootstrapTest extends TestCase
{
    public function testRuntimeIsPhpEightPointFive(): void
    {
        self::assertSame(
            '8.5',
            PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION,
        );
    }

    public function testComposerAutoloaderCanLoadTwig(): void
    {
        self::assertTrue(class_exists(Environment::class));
    }
}
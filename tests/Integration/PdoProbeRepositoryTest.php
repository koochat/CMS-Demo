<?php

declare(strict_types=1);

namespace Tests\Integration;

use App\Infrastructure\Database\PdoProbeRepository;
use PDO;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionNamedType;

final class PdoProbeRepositoryTest extends TestCase
{
    public function testRepositoryReceivesPdoThroughConstructor(): void
    {
        $pdo = $this->createStub(PDO::class);

        $repository = new PdoProbeRepository($pdo);

        self::assertSame(
            $pdo,
            $repository->connection(),
        );

        $constructor = (new ReflectionClass($repository))->getConstructor();

        self::assertNotNull($constructor);

        $parameters = $constructor->getParameters();

        self::assertCount(1, $parameters);

        $type = $parameters[0]->getType();

        self::assertInstanceOf(ReflectionNamedType::class, $type);
        self::assertSame(PDO::class, $type->getName());
    }
}
<?php

declare(strict_types=1);

namespace App\Modules\Audit;

final readonly class AuditRecord
{
    /**
     * @param array<string, mixed>|null $beforeData
     * @param array<string, mixed>|null $afterData
     * @param array<string, mixed> $correlationMetadata
     */
    public function __construct(
        public string $actorType,
        public ?int $actorUserId,
        public ?string $attemptedPrincipal,
        public string $action,
        public string $targetType,
        public string $targetId,
        public ?array $beforeData,
        public ?array $afterData,
        public ?string $reason,
        public array $correlationMetadata,
    ) {
    }
}

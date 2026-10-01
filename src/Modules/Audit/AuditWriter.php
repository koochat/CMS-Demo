<?php

declare(strict_types=1);

namespace App\Modules\Audit;

final class AuditWriter
{
    public function __construct(
        private readonly AuditRepository $repository,
    ) {
    }

    public function write(AuditRecord $record): int
    {
        return $this->repository->append(
            $record,
        );
    }
}

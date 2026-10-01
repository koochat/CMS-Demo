<?php

declare(strict_types=1);

namespace App\Modules\Audit;

use JsonException;
use PDO;
use RuntimeException;

final class AuditRepository
{
    public function __construct(
        private readonly PDO $pdo,
    ) {
    }

    /**
     * @throws JsonException
     */
    public function append(AuditRecord $record): int
    {
        $statement = $this->pdo->prepare(
            <<<'SQL'
            INSERT INTO audit_log (
                actor_type,
                actor_user_id,
                attempted_principal,
                action,
                target_type,
                target_id,
                before_data,
                after_data,
                reason,
                correlation_metadata
            )
            VALUES (
                :actor_type,
                :actor_user_id,
                :attempted_principal,
                :action,
                :target_type,
                :target_id,
                CAST(:before_data AS jsonb),
                CAST(:after_data AS jsonb),
                :reason,
                CAST(:correlation_metadata AS jsonb)
            )
            RETURNING id
            SQL,
        );

        $statement->execute([
            'actor_type' => $record->actorType,
            'actor_user_id' => $record->actorUserId,
            'attempted_principal' => $record->attemptedPrincipal,
            'action' => $record->action,
            'target_type' => $record->targetType,
            'target_id' => $record->targetId,
            'before_data' => $this->encodeNullableJson(
                $record->beforeData,
            ),
            'after_data' => $this->encodeNullableJson(
                $record->afterData,
            ),
            'reason' => $record->reason,
            'correlation_metadata' => json_encode(
                $record->correlationMetadata,
                JSON_THROW_ON_ERROR,
            ),
        ]);

        $id = $statement->fetchColumn();

        if ($id === false) {
            throw new RuntimeException(
                'Audit INSERT did not return an id.',
            );
        }

        return (int) $id;
    }

    /**
     * @param array<string, mixed>|null $value
     *
     * @throws JsonException
     */
    private function encodeNullableJson(?array $value): ?string
    {
        if ($value === null) {
            return null;
        }

        return json_encode(
            $value,
            JSON_THROW_ON_ERROR,
        );
    }
}

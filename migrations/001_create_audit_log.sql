CREATE TABLE audit_log (
    id bigint GENERATED ALWAYS AS IDENTITY PRIMARY KEY,

    actor_type text NOT NULL,
    actor_user_id bigint NULL,
    attempted_principal text NULL,

    action text NOT NULL,
    target_type text NOT NULL,
    target_id text NOT NULL,

    occurred_at timestamptz NOT NULL DEFAULT CURRENT_TIMESTAMP,

    before_data jsonb NULL,
    after_data jsonb NULL,
    reason text NULL,

    correlation_metadata jsonb NOT NULL DEFAULT '{}'::jsonb,

    CONSTRAINT audit_log_actor_identity_check
        CHECK (
            (
                actor_type = 'user'
                AND actor_user_id IS NOT NULL
            )
            OR
            (
                actor_type IN ('anonymous', 'system')
                AND actor_user_id IS NULL
            )
        )
);

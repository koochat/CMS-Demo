# Story E1-S1: User Identity Model

> Status: done
> Priority: Core Must
> Depends on: E2-S1
> Execution checkpoint: COMPLETED PREVIOUSLY (next separate Guided Development target: E1-S1b)

## WHAT — ต้องสร้างอะไร

Persist User and Core Role identity/association schema, account state, normalized principal behavior and the completed Audit-to-User reference; no authentication or user-management HTTP yet.

## Acceptance Criteria

- AC-1: `users.id` is a PostgreSQL BIGINT generated identity primary key. Persist and retrieve an active User and an inactive User without caller-assigned IDs.
- AC-2: Username and email are both required and non-empty. The persistence boundary trims each value before storage and preserves the trimmed entered value, including letter case.
- AC-3: Username and email uniqueness is case-insensitive. Repository lookup by either principal trims the lookup value and uses the same case-insensitive comparison, while returning the preserved stored value. Case-only duplicates and duplicates differing only by surrounding trimmable whitespace are rejected.
- AC-4: Account state persists as `is_active BOOLEAN NOT NULL DEFAULT TRUE`; an explicitly inactive User remains inactive after reload. Deactivation preserves the User row; deactivation behavior and its Audit event belong to a later account-management story.
- AC-5: Persist exactly the Core Role identities Admin, Editor and Approver in `roles`. Every persisted User has exactly one Role through a non-null `users.role_id` foreign key; a missing or nonexistent Role is rejected. Demo v1 has no multi-role association.
- AC-6: Audit `actor_user_id` remains BIGINT. E1-S1 adds referential linkage from Audit `actor_user_id` to `users.id` using `RESTRICT` or equivalent `NO ACTION` delete behavior. After this migration, a user-actor Audit row referencing a nonexistent User is rejected, while anonymous/system rows retain null `actor_user_id`.
- AC-7: Deactivating a User does not remove the User or break existing Audit references; attempting to delete a referenced User cannot be used to resolve Audit linkage.

## HOW — Constraints / Implementation Boundaries

Relational storage; repository SQL uses parameter binding. Username/email trimming uses the PHP persistence boundary, and database uniqueness plus repository lookup use the same PostgreSQL case-insensitive comparison while retaining the trimmed entered value. E1-S1 owns only Role identity/association schema; permission tables, grant evaluation and grant management remain in later authorization stories. Subsequent User state and Role-assignment mutations must audit, but those mutation use cases are not implemented here.

### Expected files / areas

migrations/, src/Modules/Identity/, tests/integration/

### Tests required

Integration: generated BIGINT identity; required/non-empty trimmed principals; preserved case; case-insensitive duplicate rejection and repository lookup; active-state default/round trip; exactly-one-Role enforcement; Audit foreign-key linkage, nonexistent-user rejection and delete restriction.
Verification maps to AC-1 through AC-7 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Stable, deterministic account model on which authentication, authorization, admin management and append-only actor linkage depend; FR-01/02. The dependency/identity planning remediation passed targeted independent review. E1-S1 was completed previously and is not the next implementation target; E1-S1b is next.
Trace: foundation / NFR only. Validated v0.3 baseline: Lean Spec §4 FR-01–02, §15 Identity, §17, §25; D-04/05. Reviewed remediation additions: §15 Identity Schema Contract and §28.1 R-IDENT-01..05/R-ORDER-01.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-1/story-s1.md`
- `docs/lean-spec.md` v0.3 baseline §4 FR-01–02, §15 Identity, §17, §25 and D-04/05; reviewed remediation §15 Identity Schema Contract and §28.1 R-IDENT-01..05/R-ORDER-01

## Out of Scope

Password persistence/checking, login, session lifecycle, MFA, permission/grant persistence or evaluation, user-management HTTP/UI, audited activation/deactivation use cases, Audit query/export, multi-role users.

## Dependencies / Preconditions

E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

- Owner decisions recorded 2026-09-30: BIGINT generated User identity; required trimmed case-preserving/case-insensitive username and email; Boolean active state; exactly one persisted Core Role per User; E1-S1 completion of delete-restricting Audit linkage. Planning remediation targeted independent review: PASS. E1-S1 was completed previously; its technical contract is retained without reopening the Story.

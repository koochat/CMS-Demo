# Story E0-S4: SQL Migration Runner

> Status: done
> Completion commit: f7692362b72ae3409941f16e0f1f5570e23fada7
> Priority: Core Must
> Depends on: E0-S3

## WHAT — ต้องสร้างอะไร

PHP CLI runner with SQL files and schema_migrations tracking.

## Acceptance Criteria

- AC-1: First run applies ordered pending migrations and records success.
- AC-2: Second run leaves schema and migration ledger unchanged.
- AC-3: On a failing transactional migration, no success record or partial schema changes remain.

## HOW — Constraints / Implementation Boundaries

Use PostgreSQL transactions where operations allow; SQL migration files rather than framework migration tooling.

### Expected files / areas

bin/, migrations/, src/Infrastructure/Database/, tests/integration/

### Tests required

Integration on real PostgreSQL: initial, repeat, failed transaction.
Verification maps to AC-1 through AC-3 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Reliable handwritten SQL schema evolution; D-15.
Trace: foundation / NFR only. Validated context: Lean Spec §25–26; D-15.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-0/story-s4.md`
- `docs/lean-spec.md` §25–26; D-15

## Out of Scope

User or content schema beyond minimal migration ledger.

## Dependencies / Preconditions

E0-S3. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

- Implemented, independently reviewed, committed and pushed: `f7692362b72ae3409941f16e0f1f5570e23fada7` (`feat: add E0-S4 SQL migration runner`). The E0-S4 prerequisite for E2-S1 is satisfied.

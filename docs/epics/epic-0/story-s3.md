# Story E0-S3: Configuration & PDO

> Status: todo
> Priority: Core Must
> Depends on: E0-S2

## WHAT — ต้องสร้างอะไร

Read validated environment settings and provide a PDO PostgreSQL connection to repositories through manual wiring.

## Acceptance Criteria

- AC-1: Missing required DB config fails with a diagnostic without disclosing a secret.
- AC-2: PDO connects to Compose PostgreSQL; failed connection cannot expose credentials.
- AC-3: A repository receives the PDO instance from bootstrap without creating its own connection.

## HOW — Constraints / Implementation Boundaries

Parameterized PDO operations; environment secrets are not committed; SQL stays in Repository/Infrastructure.

### Expected files / areas

config/, bootstrap/, src/Infrastructure/Database/, tests/integration/

### Tests required

Integration connection and invalid-config checks.
Verification maps to AC-1 through AC-3 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Single, inspectable data access boundary; D-04/05/08.
Trace: foundation / NFR only. Validated context: Lean Spec §16–18, §20; D-04/05/08.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-0/story-s3.md`
- `docs/lean-spec.md` §16–18, §20; D-04/05/08

## Out of Scope

Migration runner, schema, domain CRUD.

## Dependencies / Preconditions

E0-S2. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

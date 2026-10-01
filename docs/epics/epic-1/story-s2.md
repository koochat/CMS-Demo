# Story E1-S2: Password Authentication

> Status: todo
> Priority: Core Must
> Depends on: E1-S1, E2-S1

## WHAT — ต้องสร้างอะไร

Password verification and login initiation, recording success/failure, without granting an authenticated session before MFA.

## Acceptance Criteria

- AC-1: Valid active credentials enter a pending-MFA state; no authorized CMS session exists.
- AC-2: Wrong credentials and inactive accounts fail without disclosing which field failed.
- AC-3: Failed login writes anonymous audit with attempted principal; accepted password writes an auditable event.
- AC-4: Repeated failed attempts trigger rate limit; stored passwords use secure hashing.
- AC-5: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Password → MFA → regenerate session → authenticated; parameter-bound repository SQL and audit writer.

### Expected files / areas

src/Modules/Identity/, src/Http/, templates/auth/, tests/

### Tests required

Unit password/rate logic; HTTP success/failure/inactive; integration audit.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Secure entry point to FR-05 and NFR-03; D-09.
Trace: foundation / NFR only. Validated context: Lean Spec §4 FR-05, §12.2, §20, §13 NFR-03; D-09.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-1/story-s2.md`
- `docs/lean-spec.md` §4 FR-05, §12.2, §20, §13 NFR-03; D-09

## Out of Scope

MFA verification, full session access, password recovery.

## Dependencies / Preconditions

E1-S1, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

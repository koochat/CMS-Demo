# Story E1-S5A: Email OTP Backup

> Status: todo
> Priority: Core Must
> Depends on: E1-S4, E2-S1

## WHAT — ต้องสร้างอะไร

Email OTP registration, delivery and challenge as primary or backup MFA method.

## Acceptance Criteria

- AC-1: Registered user can configure TOTP and Email OTP as primary/backup methods.
- AC-2: Valid Email OTP after password check completes session; wrong, expired or reused OTP fails.
- AC-3: OTP send/verify is rate-limited and backup use is audited; OTP value is not stored in plaintext or logged.
- AC-4: If configured primary method is unavailable, registered backup method works without a lost-device recovery workflow.
- AC-5: Successful Email OTP challenge invokes E1-S3 session completion; integration verifies distinct Login success audit and backup usage audit where relevant.
- AC-6: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

External Email OTP delivery is necessary for MFA; it is distinct from Stretch notifications and must not use a queue.

### Expected files / areas

src/Modules/Identity/, src/Infrastructure/Email/, templates/auth/, tests/

### Tests required

Unit token expiry/reuse; HTTP primary/backup; integration audit and delivery adapter.
Verification maps to AC-1 through AC-6 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

FR-06 MFA continuity without Stretch infrastructure; D-10/14.
Trace: foundation / NFR only. Validated context: Lean Spec §9, §12.2, §13 NFR-03; D-10.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-1/story-s5a.md`
- `docs/lean-spec.md` §9, §12.2, §13 NFR-03; D-10

## Out of Scope

Notification inbox, email notification jobs, recovery codes, Admin reset.

## Dependencies / Preconditions

E1-S4, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

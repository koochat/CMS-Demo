# Story E1-S4: TOTP MFA

> Status: todo
> Priority: Core Must
> Depends on: E1-S3, E2-S1

## WHAT — ต้องสร้างอะไร

TOTP enrollment and verification as registered primary or backup method; complete the session only after a valid challenge.

## Acceptance Criteria

- AC-1: Password-verified pending-MFA user may enroll TOTP and must confirm a valid code before full CMS access.
- AC-2: Correct code for password-verified user completes session; wrong/replayed/expired code does not.
- AC-3: OTP attempts are rate-limited, and setup/verification events are audited without recording OTP secrets.
- AC-4: User can mark registered method primary while leaving backup capability for E1-S5.
- AC-5: Successful TOTP challenge invokes E1-S3 session completion; integration verifies distinct Login success audit in addition to TOTP/MFA audit.
- AC-6: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

TOTP secret is not rendered after enrollment; MFA recovery is backup method or Admin reset only.

### Expected files / areas

src/Modules/Identity/, templates/auth/, tests/

### Tests required

Unit time window and replay/attempt policy; HTTP enrollment and challenge; audit integration.
Verification maps to AC-1 through AC-6 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Second factor to complete password login; FR-05/06, D-10.
Trace: foundation / NFR only. Validated context: Lean Spec §9, §20, §12.2, §13 NFR-03; D-10.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-1/story-s4.md`
- `docs/lean-spec.md` §9, §20, §12.2, §13 NFR-03; D-10

## Out of Scope

Email OTP, recovery codes, lost-device workflow.

## Dependencies / Preconditions

E1-S3, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

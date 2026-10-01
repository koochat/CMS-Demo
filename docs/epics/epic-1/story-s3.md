# Story E1-S3: Server-side Session Lifecycle

> Status: todo
> Priority: Core Must
> Depends on: E1-S2, E2-S1

## WHAT — ต้องสร้างอะไร

Pending-MFA and authenticated server sessions, renewal on successful MFA, logout and cookie security.

## Acceptance Criteria

- AC-1: A password-only session cannot access protected CMS routes.
- AC-2: When the MFA verifier calls completion, session ID regenerates and authorizes the account; old session identifier no longer grants access.
- AC-3: Logout invalidates the session; Secure/HttpOnly/SameSite cookie attributes are present.
- AC-4: Inactive user cannot regain access using a previously issued session.
- AC-5: The central completion operation called after verified TOTP or Email OTP writes a distinct Login success audit event as authenticated user when it creates a fully authorized session; password acceptance and MFA attempts alone never write Login success.
- AC-6: Logout is a CSRF-protected state-changing browser request: missing or invalid token leaves the existing session intact and does not persist logout; valid token invalidates it.

## HOW — Constraints / Implementation Boundaries

Session data stays server-side; browser stores only cookie; authentication completion is called by MFA story, never by password step.

### Expected files / areas

src/Modules/Identity/, src/Http/, config/, tests/

### Tests required

HTTP pre/post MFA, TOTP/Email completion contract, Login success audit once, CSRF logout, regeneration and inactive account; integration audit transaction.
Verification maps to AC-1 through AC-6 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Prevent password-only access and session fixation; FR-05, NFR-03, D-09.
Trace: foundation / NFR only. Validated context: Lean Spec §12.1–12.2, §13 NFR-03, §20, §26; D-09/16.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-1/story-s3.md`
- `docs/lean-spec.md` §12.1–12.2, §13 NFR-03, §20, §26; D-09/16

## Out of Scope

JWT, MFA enrollment and OTP transports.

## Dependencies / Preconditions

E1-S2, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

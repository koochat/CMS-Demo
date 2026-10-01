# Story E8-S2: Security Hardening

> Status: todo
> Priority: Core Must
> Depends on: E1-S5B, E4-S8, E6-S3, E7-S2, E9-S1

## WHAT — ต้องสร้างอะไร

Close gaps across implemented Core flows and run fixed security checks before demo.

## Acceptance Criteria

- AC-1: Protected state-changing requests reject missing/invalid CSRF token.
- AC-2: Login/OTP rate limits, Secure/HttpOnly/SameSite cookie, regenerated sessions, prepared SQL, authorization, upload validation and output escaping pass recorded checks.
- AC-3: Run composer audit, the project security checklist and OWASP ZAP baseline against the E9-S1 deployed candidate build; if remediation changes code, redeploy that build and rerun the complete gate against the changed deployed build. No unresolved High/Critical finding remains.
- AC-4: Override checks reason, permission, transaction and audit.
- AC-5: If security remediation changes runtime/application/configuration or public UI/templates, record the new deployed build identifier and mark affected earlier E8-S3 performance and E8-S1 accessibility evidence as stale for E9-S2 re-verification.

## HOW — Constraints / Implementation Boundaries

Security gate scans the E9-S1 deployed build; every changed build is redeployed and rescanned. Runtime/application code or performance-relevant configuration changes invalidate performance evidence; public UI/template or accessibility-relevant output changes invalidate affected accessibility evidence. E9-S2 checks final evidence freshness.

### Expected files / areas

src/Http/, src/Modules/, templates/, tests/, docs/quality/

### Tests required

HTTP CSRF/permission regression; checklist; composer audit; deployed ZAP scan after E9-S1.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Fixed NFR-03 security gate; not a substitute for each feature’s security AC.
Trace: foundation / NFR only. Validated context: Lean Spec §13 NFR-03, §17, §20, §26.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-8/story-s2.md`
- `docs/lean-spec.md` §13 NFR-03, §17, §20, §26

## Out of Scope

Third-party SSO, production HA, queue.

## Dependencies / Preconditions

E1-S5B, E4-S8, E6-S3, E7-S2, E9-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

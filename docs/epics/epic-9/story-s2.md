# Story E9-S2: Final Online Demo Verification

> Status: todo
> Priority: Core Must
> Depends on: E9-S1, E8-S2

## WHAT — ต้องสร้างอะไร

Verify the online demo after the deployed security gate on the exact build that will be demonstrated.

## Acceptance Criteria

- AC-1: Final deployed build identifier matches the build that passed E8-S2 composer audit, deployed ZAP baseline and security checklist; it is also covered by current E8-S1 accessibility and E8-S3 performance evidence.
- AC-2: If E8-S2 or later remediation changes runtime/application code or performance-relevant configuration, redeploy and rerun E8-S3 fixed public and CMS load profiles against final build before signoff; if it changes public UI/templates or accessibility-relevant output, rerun affected E8-S1 checks. Redeploy and rerun E8-S2 security gate after any build change.
- AC-3: Public and CMS smoke, DB migration, scheduler and persistent media pass on final build; no unresolved High/Critical finding.
- AC-4: Signoff evidence maps one final build identifier to the passing security, accessibility and performance gates; stale or mismatched evidence blocks completion, and a rerun does not reopen completed stories as dependencies.

## HOW — Constraints / Implementation Boundaries

Complete after E9-S1 and E8-S2; check evidence on exact final deployed build. Carry forward E8-S1/E8-S3 only when changes cannot invalidate their measured surfaces; otherwise rerun affected gates here. No story-completion cycle.

### Expected files / areas

docs/deployment/, tests/smoke/

### Tests required

Verify build identity and evidence freshness; rerun E8-S3 fixed profiles after relevant runtime/app/config changes and affected E8-S1 checks after public UI changes; final deployed end-to-end smoke and linked E8-S2 scan evidence.
Verification maps to AC-1 through AC-4 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Close final Core Demo Gate without circular completion conditions; NFR-03.
Trace: foundation / NFR only. Validated context: Lean Spec §2, §13 NFR-01–03, §27, §32.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-9/story-s2.md`
- `docs/lean-spec.md` §2, §13 NFR-01–03, §27, §32

## Out of Scope

New feature work, production HA, Secondary/Stretch.

## Dependencies / Preconditions

E9-S1, E8-S2. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

# Story E1-S6: Role Permissions

> Status: todo
> Priority: Core Must
> Depends on: E1-S3, E1-S1

## WHAT — ต้องสร้างอะไร

Admin/Editor/Approver role permissions and default-deny authorization for protected operations.

## Acceptance Criteria

- AC-1: Versioned default grant seed on a new installation: Admin = User.Manage, Role.Manage, Audit.View, EmergencyOverride.Execute; Editor = Content.Create, Content.Edit, Content.Submit, Content.Withdraw, Content.Preview, Archive.Request, Restore.Request, Media.Upload, Media.Manage; Approver = Content.Preview, Content.Approve, Content.Reject, Archive.Approve, Restore.Approve. Exact Resource.Action grants are readable and everything unlisted is default deny.
- AC-2: Missing permission denies access even when logged in.
- AC-3: Unauthenticated or pending-MFA request is denied.
- AC-4: Role changes are audited and take effect on later authorization checks.
- AC-5: Role grant matrix permits Admin account/audit management, Editor create/edit/submit and archive/restore requests, Approver review/approval of revision/archive/restore, while denying those operations to roles without the listed grant; self-approval remains governed by workflow rules.
- AC-6: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Role permission applies only after authentication; permission checks in application/controller boundary, never Twig.

### Expected files / areas

migrations/, src/Modules/Identity/, src/Http/, tests/

### Tests required

Unit default deny/role allow; integration deterministic seeded grant matrix and audit-ready role assignment; HTTP Admin/Editor/Approver action checks.
Verification maps to AC-1 through AC-6 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Baseline authorization and role model; FR-01/04, D-03.
Trace: foundation / NFR only. Validated context: Lean Spec §1.2 Users, §4 FR-01–04/10–11/20–24/53–56, §8.1, §12.2, §15 Identity; D-03/16.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-1/story-s6.md`
- `docs/lean-spec.md` §1.2 Users, §4 FR-01–04/10–11/20–24/53–56, §8.1, §12.2, §15 Identity; D-03/16

## Out of Scope

Per-user overrides, break-glass bypass.

## Dependencies / Preconditions

E1-S3, E1-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

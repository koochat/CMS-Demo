# Story E1-S5B: Admin MFA Reset

> Status: todo
> Priority: Core Must
> Depends on: E1-S1B, E1-S5A

## WHAT — ต้องสร้างอะไร

Authorized Admin resets a user’s registered MFA, allowing safe re-enrollment on next password sign-in.

## Acceptance Criteria

- AC-1: Only Admin whose normal permission evaluation grants User.Manage may reset a target user’s MFA; an explicit User Deny: User.Manage blocks reset even for Admin.
- AC-2: Reset invalidates prior registered MFA methods and forces re-enrollment before CMS access.
- AC-3: Reset is auditable with actor, target and before/after (without secrets).
- AC-4: Non-Admin and denied Admin cannot perform reset.
- AC-5: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

MFA Reset uses only User.Manage plus Admin role, subject to User Deny > User Allow > Role Permission > Default Deny. Recovery is registered backup or Admin reset only.

### Expected files / areas

src/Modules/Identity/, src/Http/, templates/admin/users/, tests/

### Tests required

HTTP Admin allow/explicit User Deny/non-Admin denial; integration invalidation, re-enrollment and audit.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Completes FR-07 without mixing enrollment and Admin management; D-10/16.
Trace: FR-07. Validated context: Lean Spec §9, §12.2, §8.1; D-10/16.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-1/story-s5b.md`
- `docs/lean-spec.md` §9, §12.2, §8.1; D-10/16

## Out of Scope

Email notification jobs, public recovery flow.

## Dependencies / Preconditions

E1-S1B, E1-S5A. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

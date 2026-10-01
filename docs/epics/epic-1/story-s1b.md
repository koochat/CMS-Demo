# Story E1-S1B: Admin User Management

> Status: todo
> Priority: Core Must
> Depends on: E1-S7, E1-S5A, E2-S1, E1-S1C, E1-S6B
> Execution checkpoint: NEXT / NOT STARTED (E2-S1 satisfied; ready for fresh-context guided development; retain and verify the other listed prerequisites in that separate session)

## WHAT — ต้องสร้างอะไร

Admin-facing create/edit/deactivate user and assign role using the authenticated CMS; first-Admin provisioning is in E1-S1C.

## Acceptance Criteria

- AC-1: Authorized Admin creates user, updates account fields, activates/deactivates and assigns Admin/Editor/Approver.
- AC-2: Unauthorized user cannot manage users.
- AC-3: Deactivation blocks further authentication/session access.
- AC-4: Each account/role mutation is audited with actor and before/after.
- AC-5: Newly created users receive the selected role’s seeded Core grants and remain subject to user-specific Deny/Allow; first-Admin provisioning is exclusively E1-S1C.
- AC-6: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Check User.Manage; keep provisioning credentials out of repository; admin reset belongs to E1-S5B.

### Expected files / areas

src/Modules/Identity/, src/Http/, templates/admin/users/, tests/

### Tests required

HTTP authorized/denied create/edit/deactivate/role assignment; integration deactivation and audit.
Verification maps to AC-1 through AC-6 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Completes the explicitly required Admin user lifecycle absent from the original roadmap; FR-01/02.
Trace: FR-01, FR-02, FR-07. Validated context: Lean Spec §4 FR-01–02/07, §9, §12.2, §15 Identity; D-10/16.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-1/story-s1b.md`
- `docs/lean-spec.md` §4 FR-01–02/07, §9, §12.2, §15 Identity; D-10/16

## Out of Scope

First-Admin provisioning, public registration, MFA reset and notification.

## Dependencies / Preconditions

E1-S7, E1-S5A, E2-S1, E1-S1C, E1-S6B. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

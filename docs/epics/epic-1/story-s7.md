# Story E1-S7: User Permission Overrides

> Status: todo
> Priority: Core Must
> Depends on: E1-S6

## WHAT — ต้องสร้างอะไร

Per-user Allow/Deny evaluation layered over role permissions.

## Acceptance Criteria

- AC-1: User Deny wins over User Allow and role grant.
- AC-2: User Allow grants when not denied, even if role has no grant.
- AC-3: Role grant applies when no user rule; absent rule denies.
- AC-4: Permission changes are authorized and audited with relevant before/after.
- AC-5: Authorized Admin can set/revoke a user-specific Allow or Deny using a protected management action; tests show explicit User Deny defeats an otherwise seeded Admin/Editor/Approver role grant.
- AC-6: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Normal precedence exactly User Deny > User Allow > Role Permission > Default Deny. Admin override management requires User.Manage via that same precedence; every change audits relevant before/after.

### Expected files / areas

migrations/, src/Modules/Identity/, src/Http/, templates/admin/permissions/, tests/

### Tests required

Unit all precedence combinations; integration persistence and audit; HTTP denied operation.
Verification maps to AC-1 through AC-6 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Deterministic least-privilege control; FR-03/04, D-03.
Trace: FR-03, FR-04. Validated context: Lean Spec §8.1, §12.2; D-03.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-1/story-s7.md`
- `docs/lean-spec.md` §8.1, §12.2; D-03

## Out of Scope

Emergency action bypass semantics, role editor UI.

## Dependencies / Preconditions

E1-S6. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

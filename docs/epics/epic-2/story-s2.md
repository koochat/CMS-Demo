# Story E2-S2: Audit Admin Query

> Status: todo
> Priority: Core Must
> Depends on: E1-S7, E2-S1

## WHAT — ต้องสร้างอะไร

Authorized Admin list/filter/detail view for audit records.

## Acceptance Criteria

- AC-1: Admin with Audit.View can list records and filter by available actor, action, target and time fields.
- AC-2: A selected record shows relevant before/after, reason and request metadata; no edit/delete control.
- AC-3: Unauthorized or pending-MFA user cannot view audit.
- AC-4: Queries cannot alter stored records.
- AC-5: Admin with Audit.View searches by exact target ID or partial attempted principal and receives matching records only; search combines with actor/action/time filters without changing stored audit rows.

## HOW — Constraints / Implementation Boundaries

Read-only repository; role check uses final precedence; user/anonymous/system actor rendering.

### Expected files / areas

src/Modules/Audit/, src/Http/, templates/admin/audit/, tests/

### Tests required

Integration exact target and partial attempted-principal search combined with filters; HTTP permission and detail.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Makes the immutable trail inspectable; FR-55, D-16.
Trace: FR-55. Validated context: Lean Spec §12, §12.1, §15 Audit; D-16.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-2/story-s2.md`
- `docs/lean-spec.md` §12, §12.1, §15 Audit; D-16

## Out of Scope

Export, audit purge, dashboard.

## Dependencies / Preconditions

E1-S7, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

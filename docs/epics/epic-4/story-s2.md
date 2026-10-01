# Story E4-S2: Withdraw & Reject

> Status: todo
> Priority: Core Must
> Depends on: E4-S1

## WHAT — ต้องสร้างอะไร

Editor withdraws Pending Approval; authorized reviewer rejects Pending Approval with standard reason plus optional text.

## Acceptance Criteria

- AC-1: Withdraw Pending Approval returns revision to Draft; approved/scheduled/active revision cannot withdraw.
- AC-2: Reject Pending Approval requires a selected standard reason and accepts optional explanation; revision returns Draft.
- AC-3: Unauthorized or already decided requests fail without mutation.
- AC-4: Both actions and reasons are audited transactionally.
- AC-5: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Withdraw only Pending Approval; standard reason selection; no after-approval cancellation.

### Expected files / areas

src/Modules/Workflow/, src/Http/, templates/admin/workflow/, tests/

### Tests required

Unit transition matrix; HTTP reason validation/permissions; integration atomic audit.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Bounded return paths for editorial review; FR-11–13.
Trace: FR-11, FR-12, FR-13. Validated context: Lean Spec §6.1, §6.5, §12.2, §15 Workflow.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-4/story-s2.md`
- `docs/lean-spec.md` §6.1, §6.5, §12.2, §15 Workflow

## Out of Scope

Approve, cancel scheduled approval, visual diff.

## Dependencies / Preconditions

E4-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

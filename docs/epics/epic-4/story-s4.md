# Story E4-S4: Revision Activation

> Status: todo
> Priority: Core Must
> Depends on: E4-S3, E3-S2

## WHAT — ต้องสร้างอะไร

Atomic immediate or due scheduled activation of locale revision and replacement of old Active pointer.

## Acceptance Criteria

- AC-1: Approval with Display From ≤ now < Display Until may activate immediately.
- AC-2: Future-approved revision leaves old Active publicly selectable until due; due activation points locale to new revision and sets old Active to Superseded.
- AC-3: Superseded is used only for replaced Active revision; Approved Scheduled never becomes Superseded without activation.
- AC-4: Retry/concurrent activation cannot create multiple active pointers; each actual activation gets a separate Revision activation audit record, distinct from Approval: authenticated user actor for immediate approval-triggered activation and system actor for scheduler-driven activation.
- AC-5: Active slug is the only canonical slug for that locale.

## HOW — Constraints / Implementation Boundaries

Atomic pointer/state/audit; one approved scheduled; no postapproval cancel; expose due activation CLI callable by scheduler without Stretch queue.

### Expected files / areas

src/Modules/Workflow/, src/Modules/Content/, bin/, tests/

### Tests required

Unit windows/transition; integration immediate user-actor and scheduled system-actor activation audit distinct from approval, pointer swap/concurrency; CLI due activation.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Keep old revision visible until replacement is eligible; FR-15/18/27, D-21.
Trace: FR-14, FR-15, FR-18, FR-27. Validated context: Lean Spec §5–7, §10.1, §24.1; D-17/20/21.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-4/story-s4.md`
- `docs/lean-spec.md` §5–7, §10.1, §24.1; D-17/20/21

## Out of Scope

Public route fallback, expiration, queue.

## Dependencies / Preconditions

E4-S3, E3-S2. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

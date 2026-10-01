# Story E4-S7: Restore Workflow

> Status: todo
> Priority: Core Must
> Depends on: E4-S6

## WHAT — ต้องสร้างอะไร

Content-level Restore request/decision, re-evaluating each locale’s public eligibility.

## Acceptance Criteria

- AC-1: Editor requests restore for archived content; authorized Approver approves or rejects.
- AC-2: Approved restore lifts Content-level archive; each locale shows only an Active revision whose Display From ≤ now < Display Until. If an Approved Scheduled revision became eligible during archive, restore atomically invokes E4-S4 due activation before deciding visibility; a revision already past Display Until stays hidden/Expired.
- AC-3: Rejection keeps both locales archived.
- AC-4: Request, decision and change are audited atomically.
- AC-5: Normal Approver cannot approve Restore for Content they created or edited most recently; both creator and latest-editor cases are denied and emergency exception is reserved to E4-S8.
- AC-6: If restore request triggers due activation, write distinct Revision activation audit with authenticated user actor within the restore transaction; restore decision audit remains separate.
- AC-7: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Restore.Request authorizes Editor request; Restore.Approve authorizes normal Approver decision, additionally denying Content creator/latest editor. At restore, evaluate each locale with E4-S4 due activation and window rule; archive/restore are Content-level.

### Expected files / areas

src/Modules/Workflow/, src/Modules/Content/, src/Http/, tests/

### Tests required

Unit creator/latest-editor denial; integration archived eligible Approved Scheduled activation versus expired hidden state and atomic audit; HTTP permission/decision.
Verification maps to AC-1 through AC-7 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Recover preserved identity without bypassing display rules; FR-21, D-22.
Trace: FR-21. Validated context: Lean Spec §1.2 Approver, §4 FR-21/24, §5, §6.3–6.4, §8.3, §10.2, §12.2; D-18/22.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-4/story-s7.md`
- `docs/lean-spec.md` §1.2 Approver, §4 FR-21/24, §5, §6.3–6.4, §8.3, §10.2, §12.2; D-18/22

## Out of Scope

New revision approval, break-glass, per-locale archive.

## Dependencies / Preconditions

E4-S6. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

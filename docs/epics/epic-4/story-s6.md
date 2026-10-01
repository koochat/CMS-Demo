# Story E4-S6: Archive Workflow

> Status: todo
> Priority: Core Must
> Depends on: E4-S3, E4-S4, E2-S1

## WHAT — ต้องสร้างอะไร

Content-level Archive request/decision including approval or rejection.

## Acceptance Criteria

- AC-1: Editor requests archive and authorized Approver approves or rejects request.
- AC-2: Approved archive hides all TH/EN public revisions and fallback, while content/revisions remain stored.
- AC-3: Normal Approver cannot approve Archive for Content they created or edited most recently; creator and latest-editor cases are denied, even when they are not the requester. Emergency exception belongs to E4-S8.
- AC-4: Archive request, decision and effective state are audited transactionally.
- AC-5: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Archive.Request authorizes Editor request; Archive.Approve authorizes normal Approver decision, additionally denying Content creator/latest editor. Archive is Content-level; E4-S8 is the only break-glass exception.

### Expected files / areas

migrations/, src/Modules/Workflow/, src/Modules/Content/, src/Http/, tests/

### Tests required

Unit creator/latest-editor denial; integration both locales and atomic audit; HTTP role restrictions.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Prevent any public route serving archived identity; FR-20, D-22.
Trace: FR-20. Validated context: Lean Spec §1.2 Approver, §4 FR-20/24, §5, §8.3, §10.2, §12.2; D-18/22.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-4/story-s6.md`
- `docs/lean-spec.md` §1.2 Approver, §4 FR-20/24, §5, §8.3, §10.2, §12.2; D-18/22

## Out of Scope

Restore, automatic deletion, per-locale archive.

## Dependencies / Preconditions

E4-S3, E4-S4, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

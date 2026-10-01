# Story E4-S1: Draft & Submit Workflow

> Status: todo
> Priority: Core Must
> Depends on: E3-S3, E1-S7, E2-S1

## WHAT — ต้องสร้างอะไร

Authorized Draft → Pending Approval transition on one locale revision.

## Acceptance Criteria

- AC-1: Editor saves Draft and submits it; state becomes Pending Approval with submission record.
- AC-2: Unauthorized user and invalid source state cannot submit.
- AC-3: Transition and audit commit together; active revision remains unchanged.
- AC-4: TH submit does not change EN state.
- AC-5: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Workflow service owns transition; transaction includes revision and audit; no SQL in service.

### Expected files / areas

src/Modules/Workflow/, src/Modules/Content/, src/Http/, tests/

### Tests required

Unit valid/invalid transition; integration transactional audit; HTTP submit permission.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

First reviewable workflow step; FR-10, D-17/20.
Trace: FR-10. Validated context: Lean Spec §6.1, §12.2, §17, §15 Workflow; D-17.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-4/story-s1.md`
- `docs/lean-spec.md` §6.1, §12.2, §17, §15 Workflow; D-17

## Out of Scope

Reject, Withdraw, Approval, optional visual diff.

## Dependencies / Preconditions

E3-S3, E1-S7, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

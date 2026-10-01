# Story E4-S3: Approval & Separation of Duties

> Status: todo
> Priority: Core Must
> Depends on: E4-S1, E1-S7, E2-S1

## WHAT — ต้องสร้างอะไร

Normal Approver approval decision with ownership check and pending scheduled/activation handoff.

## Acceptance Criteria

- AC-1: Authorized Approver may approve Pending Approval revision created and last edited by another user.
- AC-2: Creator or latest editor cannot approve own revision, even if role grants Content.Approve.
- AC-3: Approving future Display From yields Approved Scheduled and does not replace current Active revision.
- AC-4: Approved Scheduled already present for locale blocks another future approval; invalid/unauthorized approvals leave state untouched.
- AC-5: Approval decision is audited atomically.
- AC-6: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Approval ≠ Activation; one Approved Scheduled per locale; no cancellation after approval; activation behavior delegated E4-S4.

### Expected files / areas

src/Modules/Workflow/, src/Modules/Content/, src/Http/, tests/

### Tests required

Unit self-approval/transition; integration one-scheduled concurrency and audit; HTTP permission.
Verification maps to AC-1 through AC-6 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Separation of duties and safe scheduling; FR-11/18/24, D-18/21.
Trace: FR-11, FR-18, FR-24. Validated context: Lean Spec §6.1–6.5, §8, §12.2; D-18/21.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-4/story-s3.md`
- `docs/lean-spec.md` §6.1–6.5, §8, §12.2; D-18/21

## Out of Scope

Break-glass, scheduling runner, visual diff.

## Dependencies / Preconditions

E4-S1, E1-S7, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

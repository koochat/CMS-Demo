# Story E4-S8: Emergency Override

> Status: todo
> Priority: Core Must
> Depends on: E4-S3, E4-S6, E4-S7, E1-S7, E2-S1

## WHAT — ต้องสร้างอะไร

Admin break-glass approval decision path with explicit permission, mandatory reason and append-only audit.

## Acceptance Criteria

- AC-1: Only Admin whose normal evaluation grants EmergencyOverride.Execute may execute; explicit user Deny blocks Admin.
- AC-2: Override can bypass normal approval permission, Approver requirement and self-approval only.
- AC-3: Missing reason, failed validation or failed audit aborts entire action.
- AC-4: Audit includes actor, action, target, time, reason, before/after and request correlation.
- AC-5: Exercise revision, Archive and Restore approval separately: for each action, authorized Admin may bypass normal Approver role, action approval permission and creator/latest-editor prohibition; mandatory reason, domain validation, audit and transaction still cannot be bypassed.
- AC-6: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Never bypass validation, transaction integrity or audit; same domain transitions and archive/restore ownership.

### Expected files / areas

src/Modules/Identity/, src/Modules/Workflow/, src/Http/, tests/

### Tests required

Unit denied Admin and explicit User Deny matrix; integration/HTTP action matrix for revision/Archive/Restore, mandatory reason, audit failure rollback and validation failure.
Verification maps to AC-1 through AC-6 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Controlled exception for approval emergencies; FR-22/23, D-19.
Trace: FR-22, FR-23. Validated context: Lean Spec §8.1–8.3, §12, §15 Workflow; D-19.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-4/story-s8.md`
- `docs/lean-spec.md` §8.1–8.3, §12, §15 Workflow; D-19

## Out of Scope

General superuser mode, direct mutation of audit, bypass of data validation.

## Dependencies / Preconditions

E4-S3, E4-S6, E4-S7, E1-S7, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

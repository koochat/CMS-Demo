# Story E2-S3: Audit Export

> Status: todo
> Priority: Core Must
> Depends on: E2-S2

## WHAT — ต้องสร้างอะไร

Export filtered audit data from the authorized Admin view.

## Acceptance Criteria

- AC-1: Admin with Audit.View exports exactly the selected search and filter result set in an explicitly labeled tabular file.
- AC-2: Escaping prevents exported values from being interpreted as spreadsheet formulas.
- AC-3: Unauthorized request is denied; export never mutates the audit trail.

## HOW — Constraints / Implementation Boundaries

Reuse read-only query and authorization semantics; preserve timestamps and actor fields.

### Expected files / areas

src/Modules/Audit/, src/Http/, tests/

### Tests required

HTTP export permission/filter; integration record integrity.
Verification maps to AC-1 through AC-3 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Completes audit search/filter/export capability; FR-55.
Trace: FR-55. Validated context: Lean Spec §4 FR-55, §12, §15 Audit.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-2/story-s3.md`
- `docs/lean-spec.md` §4 FR-55, §12, §15 Audit

## Out of Scope

Automated purge, external analytics.

## Dependencies / Preconditions

E2-S2. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

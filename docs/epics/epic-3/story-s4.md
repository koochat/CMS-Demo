# Story E3-S4: Core Block Editor

> Status: todo
> Priority: Core Must
> Depends on: E3-S3, E6-S2

## WHAT — ต้องสร้างอะไร

Draft Page revision editor for Rich Text, Image, Download and CTA blocks with add/delete/reorder.

## Acceptance Criteria

- AC-1: Editor adds, deletes and reorders four core block types; saved order and content round-trip in revision JSONB snapshot.
- AC-2: Invalid block type or invalid media reference is rejected.
- AC-3: Saving draft does not mutate Active Revision or another locale.
- AC-4: Rich Text and CTA output is escaped/sanitized at rendering boundary.
- AC-5: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Each Revision owns JSONB block snapshot; media selection uses asset IDs; no arbitrary layout builder.

### Expected files / areas

src/Modules/Content/, src/Http/, templates/admin/content/, tests/

### Tests required

HTTP add/remove/reorder and unauthorized edit; integration JSONB round-trip/immutability.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Complete minimum Page editor without optional capabilities; FR-33–35, D-11/17.
Trace: FR-33, FR-34, FR-35. Validated context: Lean Spec §4 FR-33–35, §21, §11; D-11.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-3/story-s4.md`
- `docs/lean-spec.md` §4 FR-33–35, §21, §11; D-11

## Out of Scope

Hero/Gallery, Shared Block, visual diff, SEO.

## Dependencies / Preconditions

E3-S3, E6-S2. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

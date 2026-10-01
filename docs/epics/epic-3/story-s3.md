# Story E3-S3: Revision Persistence

> Status: todo
> Priority: Core Must
> Depends on: E3-S2, E2-S1

## WHAT — ต้องสร้างอะไร

Persist locale-bound revisions with title, slug, display window, workflow state and JSONB block snapshot.

## Acceptance Criteria

- AC-1: Draft revision saves and reloads localized metadata, display times and independent JSONB snapshot.
- AC-2: New revision on published content leaves Active Revision unchanged.
- AC-3: Attempt to modify an Active Revision is rejected; draft creation/edit is audited.
- AC-4: Each revision belongs to one locale; invalid windows are rejected.
- AC-5: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Revision-level title/slug/window; immutable Active revision; relational metadata and JSONB blocks.

### Expected files / areas

migrations/, src/Modules/Content/, tests/integration/

### Tests required

Integration snapshot round trip, ownership, active immutability; unit window validation.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Revision history without live editing; FR-14/17, D-11/17.
Trace: FR-14, FR-17. Validated context: Lean Spec §5–7, §21, §12.2; D-11/17.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-3/story-s3.md`
- `docs/lean-spec.md` §5–7, §21, §12.2; D-11/17

## Out of Scope

Block editor UI, approval, SEO fields.

## Dependencies / Preconditions

E3-S2, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

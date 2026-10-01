# Story E6-S3: Media Usage Protection

> Status: todo
> Priority: Core Must
> Depends on: E3-S4, E6-S2

## WHAT — ต้องสร้างอะไร

Persist media usage references from revision blocks; block deletion updates usage and asset deletion respects references.

## Acceptance Criteria

- AC-1: Media detail lists content identities using asset.
- AC-2: Referenced asset deletion is rejected with no bytes or metadata removed.
- AC-3: Removing last reference through draft edit permits deletion only when no other revision/content still references asset.
- AC-4: Revision write and usage reference update commit or roll back together.
- AC-5: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

References include revision history where still referenced; transaction across content/media persistence.

### Expected files / areas

migrations/, src/Modules/Media/, src/Modules/Content/, tests/integration/

### Tests required

Integration shared usage, historic revision, rollback and deletion gate.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Prevent broken downloads and images; FR-40, D-11/12.
Trace: FR-40. Validated context: Lean Spec §11, §21, §17; D-11/12.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-6/story-s3.md`
- `docs/lean-spec.md` §11, §21, §17; D-11/12

## Out of Scope

Folder/tag taxonomy, shared blocks.

## Dependencies / Preconditions

E3-S4, E6-S2. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

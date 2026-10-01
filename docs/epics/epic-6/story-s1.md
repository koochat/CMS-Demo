# Story E6-S1: Storage Abstraction

> Status: todo
> Priority: Core Must
> Depends on: E0-S3

## WHAT — ต้องสร้างอะไร

StorageInterface and LocalStorage implementation for content assets using configured persistent volume.

## Acceptance Criteria

- AC-1: Storage contract stores, reads and removes asset bytes through an opaque reference.
- AC-2: Local implementation retains bytes across runtime recreation with configured volume.
- AC-3: Calling domain does not construct filesystem paths or assume local disk.

## HOW — Constraints / Implementation Boundaries

Core LocalStorage; no direct filesystem dependency in business rules.

### Expected files / areas

src/Modules/Media/, src/Infrastructure/Storage/, config/, compose.yaml, tests/

### Tests required

Unit storage contract; integration write/read/delete and volume smoke.
Verification maps to AC-1 through AC-3 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Decouples asset lifecycle from local paths; D-12.
Trace: foundation / NFR only. Validated context: Lean Spec §22, §27; D-12.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-6/story-s1.md`
- `docs/lean-spec.md` §22, §27; D-12

## Out of Scope

Upload UI, S3/MinIO, advanced media folders.

## Dependencies / Preconditions

E0-S3. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

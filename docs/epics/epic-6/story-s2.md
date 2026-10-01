# Story E6-S2: Basic Media Upload

> Status: todo
> Priority: Core Must
> Depends on: E6-S1, E1-S7, E2-S1

## WHAT — ต้องสร้างอะไร

Authorized basic image/file upload with alt text, caption and metadata.

## Acceptance Criteria

- AC-1: Authorized upload stores accepted file and persists metadata, alt text and caption.
- AC-2: Invalid type/size/content and unauthorized upload are rejected without asset record or stored bytes.
- AC-3: Successful media creation/edit/removal is audited.
- AC-4: Read of asset uses storage reference, not path derived from user input.
- AC-5: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Input validation and parameter binding; Media.Upload permission; no media reference deletion policy until E6-S3.

### Expected files / areas

migrations/, src/Modules/Media/, src/Http/, templates/admin/media/, tests/

### Tests required

HTTP valid/invalid/unauthorized upload; integration storage rollback and audit.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Minimal media support required by content; FR-09/39 and NFR-03.
Trace: FR-09, FR-39. Validated context: Lean Spec §11, §12.2, §13 NFR-03, §22; D-12.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-6/story-s2.md`
- `docs/lean-spec.md` §11, §12.2, §13 NFR-03, §22; D-12

## Out of Scope

Asset folders/tags, usage reference, notification.

## Dependencies / Preconditions

E6-S1, E1-S7, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

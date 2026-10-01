# Story E5-S3: Protected Preview

> Status: todo
> Priority: Core Must
> Depends on: E3-S4, E4-S1, E1-S7

## WHAT — ต้องสร้างอะไร

Authenticated preview of Draft/Pending revision with independent locale and no public indexing.

## Acceptance Criteria

- AC-1: Authorized Editor or Approver previews specified Draft/Pending revision including core blocks.
- AC-2: Anonymous, password-only, unauthorized user and guessed revision URL cannot preview.
- AC-3: Preview does not change active pointer or make draft publicly listable.
- AC-4: Output identifies preview state and locale clearly.

## HOW — Constraints / Implementation Boundaries

Use session authorization; do not resolve preview through public Active slug routing.

### Expected files / areas

src/Modules/PublicSite/, src/Http/, templates/admin/preview/, tests/

### Tests required

HTTP allowed/denied preview; integration no public visibility.
Verification maps to AC-1 through AC-4 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Allows review before publishing without leaking unpublished material; FR-32.
Trace: FR-32. Validated context: Lean Spec §4 FR-32, §10, §15 Public Site, §20.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-5/story-s3.md`
- `docs/lean-spec.md` §4 FR-32, §10, §15 Public Site, §20

## Out of Scope

Public draft route, visual diff, SEO preview.

## Dependencies / Preconditions

E3-S4, E4-S1, E1-S7. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

# Story E7-S1: Public Content Rendering

> Status: todo
> Priority: Core Must
> Depends on: E4-S5, E4-S6, E3-S4, E1-S3

## WHAT — ต้องสร้างอะไร

Public Home/List/Detail using only visible active content; safe block rendering.

## Acceptance Criteria

- AC-1: Anonymous user can load Home, Listing and Detail for visible content.
- AC-2: Draft/Pending/Scheduled/Expired/Archived revisions are absent from listing and detail; no active public revision returns no content.
- AC-3: Rich Text, Image, Download, CTA render safely with escaped user-controlled output.
- AC-4: Content type and revision data come from public read model without CMS permissions.

## HOW — Constraints / Implementation Boundaries

Publication eligibility checked at request time; active pointer only; no dependency on Category/Tag/Menu/Search.

### Expected files / areas

src/Modules/PublicSite/, src/Modules/Content/, templates/public/, tests/

### Tests required

HTTP home/list/detail and hidden-state matrix; integration active read.
Verification maps to AC-1 through AC-4 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

End-to-end public surface for Core demo; FR-47, D-06/07/21.
Trace: FR-47. Validated context: Lean Spec §4 FR-47, §6–7, §10.2, §15 Public Site, §19.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-7/story-s1.md`
- `docs/lean-spec.md` §4 FR-47, §6–7, §10.2, §15 Public Site, §19

## Out of Scope

Locale prefix/fallback, search/filter, SEO, menus.

## Dependencies / Preconditions

E4-S5, E4-S6, E3-S4, E1-S3. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

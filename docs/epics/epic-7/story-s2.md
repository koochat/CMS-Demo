# Story E7-S2: Core Public Localization

> Status: todo
> Priority: Core Must
> Depends on: E7-S1, E5-S2

## WHAT — ต้องสร้างอะไร

HTTP /th/... and /en/... routes, active slug links and rendered fallback notice using E5-S2 resolver.

## Acceptance Criteria

- AC-1: TH and EN active revisions produce their locale-prefixed canonical detail URLs.
- AC-2: /en/{type}/{TH active slug} renders TH when EN lacks Active, with clear fallback notice and no redirect.
- AC-3: Inactive/historical slugs return no content; archive hides both locale routes.
- AC-4: Home/list links use active revision slugs and requested prefix; no localized URL is built from draft.
- AC-5: When EN has Active slug A but request /en/... uses current TH Active slug B, return no content/no fallback rather than TH; HTTP regression covers this and inactive/historical slugs.

## HOW — Constraints / Implementation Boundaries

Route resolver is E5-S2; no public slug from inactive revision; no SEO dependency.

### Expected files / areas

src/Modules/PublicSite/, src/Http/, templates/public/, tests/

### Tests required

HTTP locale route matrix including fallback notice and nonredirect.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Exposes deterministic multilingual public experience; FR-26–29.
Trace: FR-26, FR-27, FR-28, FR-29. Validated context: Lean Spec §4 FR-26–29, §10.1, §15 Public Site; D-20/21.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-7/story-s2.md`
- `docs/lean-spec.md` §4 FR-26–29, §10.1, §15 Public Site; D-20/21

## Out of Scope

Search, metadata, menu, per-locale archive.

## Dependencies / Preconditions

E7-S1, E5-S2. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

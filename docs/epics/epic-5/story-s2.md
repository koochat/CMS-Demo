# Story E5-S2: EN→TH Fallback Resolver

> Status: todo
> Priority: Core Must
> Depends on: E5-S1, E7-S1

## WHAT — ต้องสร้างอะไร

Public read resolver for missing requested EN Active revision using TH Active revision slug; returns fallback notice signal.

## Acceptance Criteria

- AC-1: EN Active with matching EN slug resolves EN.
- AC-2: EN absent and TH Active with matching TH slug resolves TH under /en/ with fallback signal.
- AC-3: Slug from Draft/Pending/Approved Scheduled/Expired/Superseded/history never resolves fallback.
- AC-4: Neither locale Active or archived content resolves no public content.
- AC-5: EN has any Active revision and requested slug does not match EN Active, even if slug matches current TH Active: return no content and no fallback. Historical TH slug is likewise not a route source.

## HOW — Constraints / Implementation Boundaries

Only requested Active or fallback Active slug; preserve requested locale prefix; eligibility obeys display window/archive.

### Expected files / areas

src/Modules/PublicSite/, src/Modules/Content/, tests/

### Tests required

Unit slug/state matrix; integration archived/expired routes.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Deterministic language fallback with visible notice; FR-28/29, D-20/21/22.
Trace: FR-28, FR-29. Validated context: Lean Spec §10.1–10.2, §5; D-20/21/22.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-5/story-s2.md`
- `docs/lean-spec.md` §10.1–10.2, §5; D-20/21/22

## Out of Scope

HTTP route templates, redirects, search fallback.

## Dependencies / Preconditions

E5-S1, E7-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

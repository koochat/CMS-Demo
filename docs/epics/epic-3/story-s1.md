# Story E3-S1: Content Identity

> Status: todo
> Priority: Core Must
> Depends on: E1-S7, E2-S1

## WHAT — ต้องสร้างอะไร

Content identity, type and auditable create/list for Page, News, Announcement and Banner.

## Acceptance Criteria

- AC-1: Authorized Editor can create each of four types using one content identity model.
- AC-2: Identity and type persist independently of locale/revisions.
- AC-3: Unauthorized create fails without persistence; successful create is audited.
- AC-4: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Content-level identity/type; SQL repository; no public visibility without Active Revision.

### Expected files / areas

migrations/, src/Modules/Content/, src/Http/, templates/admin/content/, tests/

### Tests required

Integration four types; HTTP permission and create audit.
Verification maps to AC-1 through AC-4 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Shared core content model; FR-08, D-11.
Trace: FR-08. Validated context: Lean Spec §4 FR-08, §5, §15 Content, §21; D-11.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-3/story-s1.md`
- `docs/lean-spec.md` §4 FR-08, §5, §15 Content, §21; D-11

## Out of Scope

Category/Tag, SEO, revisions, archive.

## Dependencies / Preconditions

E1-S7, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

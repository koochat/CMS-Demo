# Story E8-S1: Accessibility Core Verification

> Status: todo
> Priority: Core Must
> Depends on: E7-S2, E5-S3

## WHAT — ต้องสร้างอะไร

Verify and correct Core Public UI against WCAG 2.2 AA target on demo flows.

## Acceptance Criteria

- AC-1: Home/list/detail and fallback notice use semantic headings/landmarks and descriptive alt text.
- AC-2: All interactive elements are keyboard-operable with visible focus; forms have labels.
- AC-3: Measured color contrast meets WCAG 2.2 AA for tested states.
- AC-4: Manual screen-reader structure check and recorded checklist cover core pages.
- AC-5: Record the verified build identifier, public pages/states and accessibility evidence; a later public UI/template change invalidates affected evidence until the checks are rerun on the changed build.

## HOW — Constraints / Implementation Boundaries

Scope limited to existing core screens; template output remains escaped.

### Expected files / areas

templates/public/, public/assets/, tests/, docs/quality/

### Tests required

Automated accessibility checks where practical; keyboard/screen-reader manual checklist with recorded evidence.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

NFR-01 measurable public accessibility verification.
Trace: foundation / NFR only. Validated context: Lean Spec §13 NFR-01, §19, §26.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-8/story-s1.md`
- `docs/lean-spec.md` §13 NFR-01, §19, §26

## Out of Scope

Secondary/Stretch UI, redesign.

## Dependencies / Preconditions

E7-S2, E5-S3. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

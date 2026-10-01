# Story E3-S2: Locale Foundation

> Status: todo
> Priority: Core Must
> Depends on: E3-S1

## WHAT — ต้องสร้างอะไร

TH and EN locale records, publication state and independent Active Revision pointer placeholders.

## Acceptance Criteria

- AC-1: TH and EN records can exist for same content with separate Unpublished/Scheduled/Live/Expired state.
- AC-2: Changing one locale state does not change the other.
- AC-3: Locale cannot reference a different content’s revision as active.

## HOW — Constraints / Implementation Boundaries

Content archive state remains content-level; no forced simultaneous translation.

### Expected files / areas

migrations/, src/Modules/Content/, tests/integration/

### Tests required

Integration locale independence and pointer ownership.
Verification maps to AC-1 through AC-3 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Data ownership needed for independent lifecycle; FR-25, D-20.
Trace: FR-25. Validated context: Lean Spec §5, §7, §10, §21; D-20.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-3/story-s2.md`
- `docs/lean-spec.md` §5, §7, §10, §21; D-20

## Out of Scope

Actual approval, activation, fallback resolution.

## Dependencies / Preconditions

E3-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

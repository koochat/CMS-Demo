# Story E5-S1: TH/EN Independent Workflow

> Status: todo
> Priority: Core Must
> Depends on: E4-S5, E4-S7, E3-S2

## WHAT — ต้องสร้างอะไร

Cross-locale integration of independently scoped revision, approval, scheduling, expiry and restore states.

## Acceptance Criteria

- AC-1: TH Live remains public when EN is Draft or Pending Approval.
- AC-2: EN can become Live or Expired without mutating TH revision/status.
- AC-3: Approval, replacement, expiry and restore target correct locale; content archive still affects both.
- AC-4: Shared content identity survives different revision histories.

## HOW — Constraints / Implementation Boundaries

Reuse existing workflow operations; no required simultaneous translation or cross-locale approvals.

### Expected files / areas

src/Modules/Content/, src/Modules/Workflow/, tests/

### Tests required

Integration mixed-locale lifecycle matrix; HTTP independent edit/approve paths.
Verification maps to AC-1 through AC-4 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Protect independent localization across feature boundaries; FR-25, D-20.
Trace: FR-25. Validated context: Lean Spec §5–7, §10, §26; D-20.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-5/story-s1.md`
- `docs/lean-spec.md` §5–7, §10, §26; D-20

## Out of Scope

Public fallback route, SEO, per-locale archive.

## Dependencies / Preconditions

E4-S5, E4-S7, E3-S2. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

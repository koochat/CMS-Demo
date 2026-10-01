# Story E8-S3: Performance Verification

> Status: todo
> Priority: Core Must
> Depends on: E7-S2, E4-S5, E5-S3

## WHAT — ต้องสร้างอะไร

Fixed dataset and load profiles measuring public/CMS p95 on designated demo environment.

## Acceptance Criteria

- AC-1: Fixture contains ≥1,000 content identities, TH/EN cases and multi-revision histories.
- AC-2: Warm public test runs ≥5 minutes at 10 concurrent virtual users with 20% home/40% list/40% detail and p95 ≤500ms.
- AC-3: Warm CMS test runs ≥5 minutes at 5 authenticated users with list/detail/edit form/core workflow mix and p95 ≤800ms.
- AC-4: Record environment, fixture, request mix and results; external email latency excluded.
- AC-5: Record the measured build identifier with fixture/profile/results; later runtime/application code changes or performance-relevant configuration changes invalidate p95 evidence until both fixed load profiles are rerun against final deployed build.

## HOW — Constraints / Implementation Boundaries

Core excludes Search; make load profile repeatable without Secondary/Stretch taxonomy.

### Expected files / areas

tests/performance/, docs/quality/, src/ (only measured remediation)

### Tests required

Load profiles plus fixture reproducibility and result report.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Measurable NFR-02 performance gate.
Trace: foundation / NFR only. Validated context: Lean Spec §13 NFR-02, §26.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-8/story-s3.md`
- `docs/lean-spec.md` §13 NFR-02, §26

## Out of Scope

Search performance, arbitrary production SLA.

## Dependencies / Preconditions

E7-S2, E4-S5, E5-S3. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

# Story E4-S5: Display Expiration Scheduler

> Status: todo
> Priority: Core Must
> Depends on: E4-S4

## WHAT — ต้องสร้างอะไร

Direct scheduler + PHP CLI that expires Active revisions after Display Until and activates eligible scheduled successor.

## Acceptance Criteria

- AC-1: Scheduler processes due windows using PostgreSQL transactions.
- AC-2: If eligible scheduled successor exists when old Active expires, successor activates; otherwise pointer is no longer publicly eligible and locale becomes Expired.
- AC-3: Re-running scheduler is idempotent and audit actor is system.
- AC-4: Expired locale may later activate a newly approved revision and become Live; no job queue is required.
- AC-5: A Active with Display Until later than B Display From and B Approved Scheduled: at B Display From, CLI invokes E4-S4 due activation, B becomes Active, A becomes Superseded, without waiting for A expiration.

## HOW — Constraints / Implementation Boundaries

Cron/Scheduler → PHP CLI → PostgreSQL; expiry gates public eligibility even if scheduler is delayed.

### Expected files / areas

bin/, src/Modules/Workflow/, compose.yaml, tests/integration/

### Tests required

CLI real PostgreSQL: scheduled replacement while old Active remains in window, replacement at expiry, no successor, retry, revived Expired locale.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Completes bounded public display lifecycle; FR-17/19, D-23.
Trace: FR-17, FR-19. Validated context: Lean Spec §6.4, §7, §24.1, §27; D-23.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-4/story-s5.md`
- `docs/lean-spec.md` §6.4, §7, §24.1, §27; D-23

## Out of Scope

Job queue, automatic audit purge.

## Dependencies / Preconditions

E4-S4. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

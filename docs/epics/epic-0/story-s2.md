# Story E0-S2: Docker Runtime

> Status: todo
> Priority: Core Must
> Depends on: E0-S1

## WHAT — ต้องสร้างอะไร

Local Compose runtime with Nginx, PHP-FPM and PostgreSQL; reserve scheduler service integration for E4-S5.

## Acceptance Criteria

- AC-1: Compose starts Nginx, PHP-FPM and PostgreSQL and exposes the health page.
- AC-2: PostgreSQL persists data across service recreation.
- AC-3: PHP runtime reports 8.5 and Composer dependencies load.

## HOW — Constraints / Implementation Boundaries

Nginx forwards requests to PHP-FPM front controller; PostgreSQL is the only core database; local storage gets a persistent volume when E6 is wired.

### Expected files / areas

compose.yaml, docker/nginx/, docker/php/

### Tests required

HTTP smoke in Compose; database persistence smoke.
Verification maps to AC-1 through AC-3 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Repeatable development environment for the single deployable application; D-03/04.
Trace: foundation / NFR only. Validated context: Lean Spec §16, §27; D-04.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-0/story-s2.md`
- `docs/lean-spec.md` §16, §27; D-04

## Out of Scope

Queue worker, production deployment, scheduler behavior.

## Dependencies / Preconditions

E0-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

# Story E0-S1: PHP Project Skeleton

> Status: todo
> Priority: Core Must
> Depends on: none

## WHAT — ต้องสร้างอะไร

Composer application, modular directories, front controller, lightweight routing and Twig response; only a health page, no domain capabilities.

## Acceptance Criteria

- AC-1: Composer install and PHPUnit bootstrap succeed in PHP 8.5.
- AC-2: GET /health traverses front controller and returns escaped HTML; unknown path returns 404.
- AC-3: Controllers receive dependencies by constructor from bootstrap, without a container or globals.

## HOW — Constraints / Implementation Boundaries

Nginx-facing public/index.php → Router → Controller → Twig; manual constructor wiring; no SQL in controllers or business logic in templates.

### Expected files / areas

composer.json, public/index.php, bootstrap/, src/Http/, templates/, tests/

### Tests required

HTTP GET /health and 404; unit routing.
Verification maps to AC-1 through AC-3 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Establish explicit PHP request lifecycle and modular foundation; D-02/03/06/07/08.
Trace: foundation / NFR only. Validated context: Lean Spec §14.1, §16, §18–19; D-02, D-03, D-06–08.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-0/story-s1.md`
- `docs/lean-spec.md` §14.1, §16, §18–19; D-02, D-03, D-06–08

## Out of Scope

DB connection, Docker services, authentication.

## Dependencies / Preconditions

none. Validated Lean Spec v0.3 and Project Context are available.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

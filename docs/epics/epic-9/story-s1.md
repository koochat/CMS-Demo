# Story E9-S1: Online Scan Candidate Deployment

> Status: todo
> Priority: Core Must
> Depends on: E1-S5B, E1-S1B, E2-S3, E4-S2, E4-S5, E4-S8, E5-S3, E6-S3, E7-S2, E8-S1, E8-S3

## WHAT — ต้องสร้างอะไร

Deploy the complete Core implementation as an online security-scan candidate with Nginx, PHP-FPM, PostgreSQL, scheduler and persistent local storage.

## Acceptance Criteria

- AC-1: Accessible online environment serves CMS/public HTTPS routes and Core demo flow.
- AC-2: DB migrations run; scheduler triggers CLI activation/expiration, and assets persist across application restarts.
- AC-3: Runtime secrets and secure cookies are configured outside versioned code.
- AC-4: Deployed candidate identifies its exact build and provides the reachable endpoint for the later E8-S2 security scan.

## HOW — Constraints / Implementation Boundaries

Core Compose services only; no queue worker. Candidate completion requires a reachable, reproducible build and smoke checks, not the later E8-S2 scan or final-demo signoff.

### Expected files / areas

compose.yaml, docker/, config/, docs/deployment/, tests/smoke/

### Tests required

Deployed candidate HTTP smoke, migration/scheduler/storage persistence and recorded build identifier.
Verification maps to AC-1 through AC-4 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Online demonstration of complete Core system.
Trace: foundation / NFR only. Validated context: Lean Spec §16, §24.1, §27, §13 NFR-03.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-9/story-s1.md`
- `docs/lean-spec.md` §16, §24.1, §27, §13 NFR-03

## Out of Scope

Production-scale HA, Kubernetes, Stretch queue.

## Dependencies / Preconditions

E1-S5B, E1-S1B, E2-S3, E4-S2, E4-S5, E4-S8, E5-S3, E6-S3, E7-S2, E8-S1, E8-S3. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

# Story E1-S1C: First Admin Provisioning

> Status: todo
> Priority: Core Must
> Depends on: E1-S2, E1-S6, E1-S7, E2-S1, E1-S4

## WHAT — ต้องสร้างอะไร

Provide a one-time, non-public CLI entry point to provision the first active Admin on an empty installation.

## Acceptance Criteria

- AC-1: With no Admin present, operator provisions initial Admin with unique username/email and securely hashed password; seeded Admin role grants include User.Manage, Role.Manage, Audit.View and EmergencyOverride.Execute subject to normal permission precedence.
- AC-2: A second invocation never resets the Admin password, escalates another account, or modifies existing users.
- AC-3: Credentials are supplied outside source control, never printed or logged; provisioning is recorded in append-only audit with system actor.
- AC-4: Provisioned Admin completes regular MFA enrollment before reaching protected CMS routes.

## HOW — Constraints / Implementation Boundaries

CLI runs through application services and repositories within a transaction; no public self-registration or MFA bypass.

### Expected files / areas

bin/, src/Modules/Identity/, tests/integration/, docs/deployment/

### Tests required

CLI empty-install, repeat and rollback; real password + TOTP enrollment/login smoke with no protected access before MFA; audit integration.
Verification maps to AC-1 through AC-4 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Separates deployment bootstrap from Admin HTTP management; FR-01/02, D-09/10/16.
Trace: foundation / NFR only. Validated context: Lean Spec §1.2 Admin, §4 FR-01–04, §8.1, §9, §12.1, §20, §25; D-09/10/16.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-1/story-s1c.md`
- `docs/lean-spec.md` §1.2 Admin, §4 FR-01–04, §8.1, §9, §12.1, §20, §25; D-09/10/16

## Out of Scope

HTTP Admin user CRUD, public signup, recovery codes.

## Dependencies / Preconditions

E1-S2, E1-S6, E1-S7, E2-S1, E1-S4. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

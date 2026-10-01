# MOL CMS Demo — Core Story Planning Remediation v0.3

> Source: Lean Spec v0.3 VALIDATED baseline; owner-approved dependency/identity remediation dated 2026-09-30; Project Context; targeted review CORE-REV-01..11 CLOSED and subsequent planning review PASS. Planning/status artifact only; no application code.

## 1. Story Planning Result

**REMEDIATION PLANNING REVIEW: PASS — E2-S1 DONE — NEXT TARGET: E1-S1b**

- Core Epics: 10 (E0–E9)
- Core Stories: 43
- Roadmap items split: 4 (E1-S1, E1-S5, E1-S6, E9-S1)
- Stories merged: 0
- Planning review block: closed; relevant targeted independent planning review PASS.
- E0-S4: done; independently reviewed, committed and pushed at `f7692362b72ae3409941f16e0f1f5570e23fada7`.
- E2-S1: done; Independent Review PASS after targeted remediation; E2S1-REV-01 CLOSED; committed, pushed and post-push verified at `7e15d4003c34937243d0d94b5866e9f57f6b4f84` (`HEAD == origin/main`).
- E1-S1: done previously. Next separate Guided Development target: E1-S1b (`docs/epics/epic-1/story-s1b.md`), todo / NEXT / NOT STARTED; E2-S1 is satisfied, with other listed prerequisites retained for verification in that session.

## 2. Story Sharding Review

| Original roadmap item(s) | Decision | Reason |
|---|---|---|
| E0-S1 → E0-S1 | KEEP | — |
| E0-S2 → E0-S2 | KEEP | — |
| E0-S3 → E0-S3 | KEEP | — |
| E0-S4 → E0-S4 | KEEP | — |
| E2-S1 → E2-S1 | REORDER | Audit writer precedes failed login and every audited mutation. |
| E1-S1 → E1-S1 | SPLIT | Identity model separated from Admin HTTP and first-Admin CLI. |
| E1-S2 → E1-S2 | KEEP | — |
| E1-S3 → E1-S3 | KEEP | — |
| E1-S4 → E1-S4 | KEEP | — |
| E1-S5 → E1-S5A | SPLIT | Email OTP registration/challenge separated from Admin MFA reset. |
| E1-S6 → E1-S6 | SPLIT | Deterministic Core role grant seed and evaluation. |
| E1-S7 → E1-S7 | KEEP | — |
| E1-S1 → E1-S1C | SPLIT | First-Admin provisioning separated from Admin HTTP management (CORE-REV-10). |
| E1-S6 → E1-S6B | SPLIT | Admin role grant management separated from seed/evaluation (CORE-REV-08). |
| E1-S1 → E1-S1B | SPLIT | Admin HTTP account lifecycle after provisioning. |
| E1-S5 → E1-S5B | SPLIT | MFA reset uses User.Manage with explicit Deny test. |
| E2-S2 → E2-S2 | KEEP | — |
| E2-S3 → E2-S3 | KEEP | — |
| E3-S1 → E3-S1 | KEEP | — |
| E3-S2 → E3-S2 | KEEP | — |
| E3-S3 → E3-S3 | KEEP | — |
| E6-S1 → E6-S1 | REORDER | Storage precedes upload and block media selection. |
| E6-S2 → E6-S2 | REORDER | Upload precedes block media selection. |
| E3-S4 → E3-S4 | KEEP | — |
| E6-S3 → E6-S3 | REORDER | Usage protection follows block reference persistence. |
| E4-S1 → E4-S1 | KEEP | — |
| E4-S2 → E4-S2 | KEEP | — |
| E4-S3 → E4-S3 | KEEP | — |
| E4-S4 → E4-S4 | KEEP | — |
| E4-S5 → E4-S5 | KEEP | — |
| E4-S6 → E4-S6 | KEEP | — |
| E4-S7 → E4-S7 | KEEP | — |
| E4-S8 → E4-S8 | KEEP | — |
| E5-S1 → E5-S1 | REORDER | Cross-locale lifecycle verification precedes fallback. |
| E7-S1 → E7-S1 | REORDER | Public pages precede resolver and HTTP locale wiring. |
| E5-S2 → E5-S2 | REORDER | Resolver precedes HTTP locale wiring. |
| E7-S2 → E7-S2 | REORDER | HTTP localization follows resolver. |
| E5-S3 → E5-S3 | KEEP | — |
| E8-S1 → E8-S1 | KEEP | — |
| E8-S2 → E8-S2 | REORDER | Deployed security scan after candidate; changed builds are redeployed and rescanned. |
| E8-S3 → E8-S3 | KEEP | — |
| E9-S1 → E9-S1 | SPLIT | Completed online scan candidate after all Core implementation surfaces. |
| E9-S1 → E9-S2 | SPLIT | Final online verification after security scan, same build (CORE-REV-01). |

## 3. Core Dependency Order

The approved dependency ordering is retained below as planning history. Current checkpoint: `E0-S4 → E2-S1` is complete and the Audit prerequisite for Identity follow-up work is satisfied. E1-S1 is already complete; E1-S1b is the next separate implementation target, not E1-S1.

E0-S1 → E0-S2 → E0-S3 → E0-S4 → E2-S1 → E1-S1 → E1-S2 → E1-S3 → E1-S4 → E1-S5A → E1-S6 → E1-S7 → E1-S1C → E1-S6B → E1-S1B → E1-S5B → E2-S2 → E2-S3 → E3-S1 → E3-S2 → E3-S3 → E6-S1 → E6-S2 → E3-S4 → E6-S3 → E4-S1 → E4-S2 → E4-S3 → E4-S4 → E4-S5 → E4-S6 → E4-S7 → E4-S8 → E5-S1 → E7-S1 → E5-S2 → E7-S2 → E5-S3 → E8-S1 → E8-S3 → E9-S1 → E8-S2 → E9-S2

Independent after prerequisites: E6-S1 after E0-S3; E2-S2 and E3-S1 after their stated gates; E8-S1 and E8-S3 after their UI/workflow prerequisites. Follow each file’s Depends on list; this ordering is a valid topological schedule, not a forced serialization.

## 4. Core Story Pack

All files below are also available at the matching `docs/epics/epic-N/story-*.md` paths inside the accompanying ZIP.

### E0-S1

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


### E0-S2

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


### E0-S3

# Story E0-S3: Configuration & PDO

> Status: todo
> Priority: Core Must
> Depends on: E0-S2

## WHAT — ต้องสร้างอะไร

Read validated environment settings and provide a PDO PostgreSQL connection to repositories through manual wiring.

## Acceptance Criteria

- AC-1: Missing required DB config fails with a diagnostic without disclosing a secret.
- AC-2: PDO connects to Compose PostgreSQL; failed connection cannot expose credentials.
- AC-3: A repository receives the PDO instance from bootstrap without creating its own connection.

## HOW — Constraints / Implementation Boundaries

Parameterized PDO operations; environment secrets are not committed; SQL stays in Repository/Infrastructure.

### Expected files / areas

config/, bootstrap/, src/Infrastructure/Database/, tests/integration/

### Tests required

Integration connection and invalid-config checks.
Verification maps to AC-1 through AC-3 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Single, inspectable data access boundary; D-04/05/08.
Trace: foundation / NFR only. Validated context: Lean Spec §16–18, §20; D-04/05/08.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-0/story-s3.md`
- `docs/lean-spec.md` §16–18, §20; D-04/05/08

## Out of Scope

Migration runner, schema, domain CRUD.

## Dependencies / Preconditions

E0-S2. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E0-S4

# Story E0-S4: SQL Migration Runner

> Status: done
> Completion commit: f7692362b72ae3409941f16e0f1f5570e23fada7
> Priority: Core Must
> Depends on: E0-S3

## WHAT — ต้องสร้างอะไร

PHP CLI runner with SQL files and schema_migrations tracking.

## Acceptance Criteria

- AC-1: First run applies ordered pending migrations and records success.
- AC-2: Second run leaves schema and migration ledger unchanged.
- AC-3: On a failing transactional migration, no success record or partial schema changes remain.

## HOW — Constraints / Implementation Boundaries

Use PostgreSQL transactions where operations allow; SQL migration files rather than framework migration tooling.

### Expected files / areas

bin/, migrations/, src/Infrastructure/Database/, tests/integration/

### Tests required

Integration on real PostgreSQL: initial, repeat, failed transaction.
Verification maps to AC-1 through AC-3 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Reliable handwritten SQL schema evolution; D-15.
Trace: foundation / NFR only. Validated context: Lean Spec §25–26; D-15.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-0/story-s4.md`
- `docs/lean-spec.md` §25–26; D-15

## Out of Scope

User or content schema beyond minimal migration ledger.

## Dependencies / Preconditions

E0-S3. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

- Implemented, independently reviewed, committed and pushed: `f7692362b72ae3409941f16e0f1f5570e23fada7` (`feat: add E0-S4 SQL migration runner`). The E0-S4 prerequisite for E2-S1 is satisfied.

### E2-S1

# Story E2-S1: Audit Write Foundation

> Status: done
> Completion commit: 7e15d4003c34937243d0d94b5866e9f57f6b4f84
> Priority: Core Must
> Depends on: E0-S4

## WHAT — ต้องสร้างอะไร

Append-only audit storage and application writer shared by subsequent identity, auth and workflow stories. Establish the final `actor_user_id BIGINT` scalar contract before the users table exists; E1-S1 completes referential linkage.

## Acceptance Criteria

- AC-1: Write and read records for user (`actor_user_id BIGINT` required), anonymous (`actor_user_id` null and optional attempted principal), and system (`actor_user_id` null).
- AC-2: Record action, target, timestamp, relevant before/after, reason, and correlation metadata.
- AC-3: No application update/delete operation exists; attempted update/delete through app is denied.
- AC-4: Transactional domain action and its required audit record either both persist or both roll back.
- AC-5: The E2-S1 schema intentionally leaves nullable `actor_user_id BIGINT` without a User foreign key because `users` does not yet exist; its type and actor nullability constraints permit E1-S1 to add a delete-restricting foreign key without changing the column contract.

## HOW — Constraints / Implementation Boundaries

Immutable application API; actor type drives required ID fields; no automatic purge; database write boundary can join caller transaction. E2-S1 must not create a users table, User repository, or User foreign key. A user actor requires a syntactically valid BIGINT ID at this stage; existence enforcement begins when E1-S1 completes the foreign key.

### Expected files / areas

migrations/, src/Modules/Audit/, tests/integration/

### Tests required

Integration: actor variants and BIGINT/nullability constraints, append, denied mutation, rollback, and schema compatibility for the later E1-S1 foreign key.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Foundation needed before identity linkage, login failure and all later audited mutations; FR-53/54/56/57, D-16. Planning review passed for the accepted ordering `E0-S4 → E2-S1 → Identity follow-up work`; E0-S4 and E2-S1 are done. E1-S1 was completed previously; the next implementation target is E1-S1b.
Trace: foundation / NFR only. Validated v0.3 baseline: Lean Spec §12, §12.1–12.2, §17, §26; D-16. Reviewed remediation additions: §15 Identity Schema Contract and §28.1 R-IDENT-01/R-IDENT-05/R-ORDER-01.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-2/story-s1.md`
- `docs/lean-spec.md` v0.3 baseline §12, §12.1–12.2, §17, §26 and D-16; reviewed remediation §15 Identity Schema Contract and §28.1 R-IDENT-01/R-IDENT-05/R-ORDER-01

## Out of Scope

Users table, User foreign key, identity repository, Admin query, export, notifications.

## Dependencies / Preconditions

E0-S4. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

- Planning remediation targeted independent review: PASS; approved dependency and identity decisions retained.
- Implementation completed, locally verified, independently reviewed, remediated, committed, pushed and post-push verified: `HEAD == origin/main` at `7e15d4003c34937243d0d94b5866e9f57f6b4f84` (`feat: add E2-S1 audit write foundation`).
- Initial Independent Implementation Review: PASS WITH CHANGES (0 BLOCKER, 0 MAJOR, 1 MINOR, 0 NOTE). E2S1-REV-01 concerned a rollback test that could fail at the domain INSERT without reaching the required Audit write.
- Targeted Independent Re-review: PASS — E2S1-REV-01 CLOSED; final finding counts: 0 BLOCKER, 0 MAJOR, 0 MINOR, 0 NOTE. The remediated test proves domain insertion inside the caller transaction, separately requires Audit failure with SQLSTATE `23514` and `audit_log_actor_identity_check`, confirms the transaction remains active, then explicitly rolls back and verifies both row counts are zero.
- Post-remediation verification: Audit transaction suite 2/2 PASS (10 assertions); E2-S1 targeted suite 11/11 PASS (56 assertions); full project suite 31/31 PASS (124 assertions); `git diff --check` PASS.
- Delivered: PostgreSQL `audit_log`, actor-dependent nullable `actor_user_id BIGINT`, approved event/payload/correlation fields, parameter-bound SQL and a write-only application Audit API participating in caller-owned transactions. Domain mutation and required Audit can commit or roll back together; test/database reads do not introduce an application query API. No Users, Roles, Identity repositories, User foreign key, E1 behavior, Audit update/delete/query/export API or notifications were delivered by E2-S1.
- E2-S1 dependency is satisfied for Identity follow-up work. Next separate Guided Development target: `docs/epics/epic-1/story-s1b.md`; implementation has not started.

### E1-S1

# Story E1-S1: User Identity Model

> Status: done
> Priority: Core Must
> Depends on: E2-S1
> Execution checkpoint: COMPLETED PREVIOUSLY (next separate Guided Development target: E1-S1b)

## WHAT — ต้องสร้างอะไร

Persist User and Core Role identity/association schema, account state, normalized principal behavior and the completed Audit-to-User reference; no authentication or user-management HTTP yet.

## Acceptance Criteria

- AC-1: `users.id` is a PostgreSQL BIGINT generated identity primary key. Persist and retrieve an active User and an inactive User without caller-assigned IDs.
- AC-2: Username and email are both required and non-empty. The persistence boundary trims each value before storage and preserves the trimmed entered value, including letter case.
- AC-3: Username and email uniqueness is case-insensitive. Repository lookup by either principal trims the lookup value and uses the same case-insensitive comparison, while returning the preserved stored value. Case-only duplicates and duplicates differing only by surrounding trimmable whitespace are rejected.
- AC-4: Account state persists as `is_active BOOLEAN NOT NULL DEFAULT TRUE`; an explicitly inactive User remains inactive after reload. Deactivation preserves the User row; deactivation behavior and its Audit event belong to a later account-management story.
- AC-5: Persist exactly the Core Role identities Admin, Editor and Approver in `roles`. Every persisted User has exactly one Role through a non-null `users.role_id` foreign key; a missing or nonexistent Role is rejected. Demo v1 has no multi-role association.
- AC-6: Audit `actor_user_id` remains BIGINT. E1-S1 adds referential linkage from Audit `actor_user_id` to `users.id` using `RESTRICT` or equivalent `NO ACTION` delete behavior. After this migration, a user-actor Audit row referencing a nonexistent User is rejected, while anonymous/system rows retain null `actor_user_id`.
- AC-7: Deactivating a User does not remove the User or break existing Audit references; attempting to delete a referenced User cannot be used to resolve Audit linkage.

## HOW — Constraints / Implementation Boundaries

Relational storage; repository SQL uses parameter binding. Username/email trimming uses the PHP persistence boundary, and database uniqueness plus repository lookup use the same PostgreSQL case-insensitive comparison while retaining the trimmed entered value. E1-S1 owns only Role identity/association schema; permission tables, grant evaluation and grant management remain in later authorization stories. Subsequent User state and Role-assignment mutations must audit, but those mutation use cases are not implemented here.

### Expected files / areas

migrations/, src/Modules/Identity/, tests/integration/

### Tests required

Integration: generated BIGINT identity; required/non-empty trimmed principals; preserved case; case-insensitive duplicate rejection and repository lookup; active-state default/round trip; exactly-one-Role enforcement; Audit foreign-key linkage, nonexistent-user rejection and delete restriction.
Verification maps to AC-1 through AC-7 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Stable, deterministic account model on which authentication, authorization, admin management and append-only actor linkage depend; FR-01/02. The dependency/identity planning remediation passed targeted independent review. E1-S1 was completed previously and is not the next implementation target; E1-S1b is next.
Trace: foundation / NFR only. Validated v0.3 baseline: Lean Spec §4 FR-01–02, §15 Identity, §17, §25; D-04/05. Reviewed remediation additions: §15 Identity Schema Contract and §28.1 R-IDENT-01..05/R-ORDER-01.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-1/story-s1.md`
- `docs/lean-spec.md` v0.3 baseline §4 FR-01–02, §15 Identity, §17, §25 and D-04/05; reviewed remediation §15 Identity Schema Contract and §28.1 R-IDENT-01..05/R-ORDER-01

## Out of Scope

Password persistence/checking, login, session lifecycle, MFA, permission/grant persistence or evaluation, user-management HTTP/UI, audited activation/deactivation use cases, Audit query/export, multi-role users.

## Dependencies / Preconditions

E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

- Owner decisions recorded 2026-09-30: BIGINT generated User identity; required trimmed case-preserving/case-insensitive username and email; Boolean active state; exactly one persisted Core Role per User; E1-S1 completion of delete-restricting Audit linkage. Planning remediation targeted independent review: PASS. E1-S1 was completed previously; its technical contract is retained without reopening the Story.

### E1-S2

# Story E1-S2: Password Authentication

> Status: todo
> Priority: Core Must
> Depends on: E1-S1, E2-S1

## WHAT — ต้องสร้างอะไร

Password verification and login initiation, recording success/failure, without granting an authenticated session before MFA.

## Acceptance Criteria

- AC-1: Valid active credentials enter a pending-MFA state; no authorized CMS session exists.
- AC-2: Wrong credentials and inactive accounts fail without disclosing which field failed.
- AC-3: Failed login writes anonymous audit with attempted principal; accepted password writes an auditable event.
- AC-4: Repeated failed attempts trigger rate limit; stored passwords use secure hashing.
- AC-5: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Password → MFA → regenerate session → authenticated; parameter-bound repository SQL and audit writer.

### Expected files / areas

src/Modules/Identity/, src/Http/, templates/auth/, tests/

### Tests required

Unit password/rate logic; HTTP success/failure/inactive; integration audit.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Secure entry point to FR-05 and NFR-03; D-09.
Trace: foundation / NFR only. Validated context: Lean Spec §4 FR-05, §12.2, §20, §13 NFR-03; D-09.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-1/story-s2.md`
- `docs/lean-spec.md` §4 FR-05, §12.2, §20, §13 NFR-03; D-09

## Out of Scope

MFA verification, full session access, password recovery.

## Dependencies / Preconditions

E1-S1, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E1-S3

# Story E1-S3: Server-side Session Lifecycle

> Status: todo
> Priority: Core Must
> Depends on: E1-S2, E2-S1

## WHAT — ต้องสร้างอะไร

Pending-MFA and authenticated server sessions, renewal on successful MFA, logout and cookie security.

## Acceptance Criteria

- AC-1: A password-only session cannot access protected CMS routes.
- AC-2: When the MFA verifier calls completion, session ID regenerates and authorizes the account; old session identifier no longer grants access.
- AC-3: Logout invalidates the session; Secure/HttpOnly/SameSite cookie attributes are present.
- AC-4: Inactive user cannot regain access using a previously issued session.
- AC-5: The central completion operation called after verified TOTP or Email OTP writes a distinct Login success audit event as authenticated user when it creates a fully authorized session; password acceptance and MFA attempts alone never write Login success.
- AC-6: Logout is a CSRF-protected state-changing browser request: missing or invalid token leaves the existing session intact and does not persist logout; valid token invalidates it.

## HOW — Constraints / Implementation Boundaries

Session data stays server-side; browser stores only cookie; authentication completion is called by MFA story, never by password step.

### Expected files / areas

src/Modules/Identity/, src/Http/, config/, tests/

### Tests required

HTTP pre/post MFA, TOTP/Email completion contract, Login success audit once, CSRF logout, regeneration and inactive account; integration audit transaction.
Verification maps to AC-1 through AC-6 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Prevent password-only access and session fixation; FR-05, NFR-03, D-09.
Trace: foundation / NFR only. Validated context: Lean Spec §12.1–12.2, §13 NFR-03, §20, §26; D-09/16.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-1/story-s3.md`
- `docs/lean-spec.md` §12.1–12.2, §13 NFR-03, §20, §26; D-09/16

## Out of Scope

JWT, MFA enrollment and OTP transports.

## Dependencies / Preconditions

E1-S2, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E1-S4

# Story E1-S4: TOTP MFA

> Status: todo
> Priority: Core Must
> Depends on: E1-S3, E2-S1

## WHAT — ต้องสร้างอะไร

TOTP enrollment and verification as registered primary or backup method; complete the session only after a valid challenge.

## Acceptance Criteria

- AC-1: Password-verified pending-MFA user may enroll TOTP and must confirm a valid code before full CMS access.
- AC-2: Correct code for password-verified user completes session; wrong/replayed/expired code does not.
- AC-3: OTP attempts are rate-limited, and setup/verification events are audited without recording OTP secrets.
- AC-4: User can mark registered method primary while leaving backup capability for E1-S5.
- AC-5: Successful TOTP challenge invokes E1-S3 session completion; integration verifies distinct Login success audit in addition to TOTP/MFA audit.
- AC-6: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

TOTP secret is not rendered after enrollment; MFA recovery is backup method or Admin reset only.

### Expected files / areas

src/Modules/Identity/, templates/auth/, tests/

### Tests required

Unit time window and replay/attempt policy; HTTP enrollment and challenge; audit integration.
Verification maps to AC-1 through AC-6 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Second factor to complete password login; FR-05/06, D-10.
Trace: foundation / NFR only. Validated context: Lean Spec §9, §20, §12.2, §13 NFR-03; D-10.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-1/story-s4.md`
- `docs/lean-spec.md` §9, §20, §12.2, §13 NFR-03; D-10

## Out of Scope

Email OTP, recovery codes, lost-device workflow.

## Dependencies / Preconditions

E1-S3, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E1-S5A

# Story E1-S5A: Email OTP Backup

> Status: todo
> Priority: Core Must
> Depends on: E1-S4, E2-S1

## WHAT — ต้องสร้างอะไร

Email OTP registration, delivery and challenge as primary or backup MFA method.

## Acceptance Criteria

- AC-1: Registered user can configure TOTP and Email OTP as primary/backup methods.
- AC-2: Valid Email OTP after password check completes session; wrong, expired or reused OTP fails.
- AC-3: OTP send/verify is rate-limited and backup use is audited; OTP value is not stored in plaintext or logged.
- AC-4: If configured primary method is unavailable, registered backup method works without a lost-device recovery workflow.
- AC-5: Successful Email OTP challenge invokes E1-S3 session completion; integration verifies distinct Login success audit and backup usage audit where relevant.
- AC-6: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

External Email OTP delivery is necessary for MFA; it is distinct from Stretch notifications and must not use a queue.

### Expected files / areas

src/Modules/Identity/, src/Infrastructure/Email/, templates/auth/, tests/

### Tests required

Unit token expiry/reuse; HTTP primary/backup; integration audit and delivery adapter.
Verification maps to AC-1 through AC-6 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

FR-06 MFA continuity without Stretch infrastructure; D-10/14.
Trace: foundation / NFR only. Validated context: Lean Spec §9, §12.2, §13 NFR-03; D-10.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-1/story-s5a.md`
- `docs/lean-spec.md` §9, §12.2, §13 NFR-03; D-10

## Out of Scope

Notification inbox, email notification jobs, recovery codes, Admin reset.

## Dependencies / Preconditions

E1-S4, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E1-S6

# Story E1-S6: Role Permissions

> Status: todo
> Priority: Core Must
> Depends on: E1-S3, E1-S1

## WHAT — ต้องสร้างอะไร

Admin/Editor/Approver role permissions and default-deny authorization for protected operations.

## Acceptance Criteria

- AC-1: Versioned default grant seed on a new installation: Admin = User.Manage, Role.Manage, Audit.View, EmergencyOverride.Execute; Editor = Content.Create, Content.Edit, Content.Submit, Content.Withdraw, Content.Preview, Archive.Request, Restore.Request, Media.Upload, Media.Manage; Approver = Content.Preview, Content.Approve, Content.Reject, Archive.Approve, Restore.Approve. Exact Resource.Action grants are readable and everything unlisted is default deny.
- AC-2: Missing permission denies access even when logged in.
- AC-3: Unauthenticated or pending-MFA request is denied.
- AC-4: Role changes are audited and take effect on later authorization checks.
- AC-5: Role grant matrix permits Admin account/audit management, Editor create/edit/submit and archive/restore requests, Approver review/approval of revision/archive/restore, while denying those operations to roles without the listed grant; self-approval remains governed by workflow rules.
- AC-6: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Role permission applies only after authentication; permission checks in application/controller boundary, never Twig.

### Expected files / areas

migrations/, src/Modules/Identity/, src/Http/, tests/

### Tests required

Unit default deny/role allow; integration deterministic seeded grant matrix and audit-ready role assignment; HTTP Admin/Editor/Approver action checks.
Verification maps to AC-1 through AC-6 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Baseline authorization and role model; FR-01/04, D-03.
Trace: foundation / NFR only. Validated context: Lean Spec §1.2 Users, §4 FR-01–04/10–11/20–24/53–56, §8.1, §12.2, §15 Identity; D-03/16.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-1/story-s6.md`
- `docs/lean-spec.md` §1.2 Users, §4 FR-01–04/10–11/20–24/53–56, §8.1, §12.2, §15 Identity; D-03/16

## Out of Scope

Per-user overrides, break-glass bypass.

## Dependencies / Preconditions

E1-S3, E1-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E1-S7

# Story E1-S7: User Permission Overrides

> Status: todo
> Priority: Core Must
> Depends on: E1-S6

## WHAT — ต้องสร้างอะไร

Per-user Allow/Deny evaluation layered over role permissions.

## Acceptance Criteria

- AC-1: User Deny wins over User Allow and role grant.
- AC-2: User Allow grants when not denied, even if role has no grant.
- AC-3: Role grant applies when no user rule; absent rule denies.
- AC-4: Permission changes are authorized and audited with relevant before/after.
- AC-5: Authorized Admin can set/revoke a user-specific Allow or Deny using a protected management action; tests show explicit User Deny defeats an otherwise seeded Admin/Editor/Approver role grant.
- AC-6: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Normal precedence exactly User Deny > User Allow > Role Permission > Default Deny. Admin override management requires User.Manage via that same precedence; every change audits relevant before/after.

### Expected files / areas

migrations/, src/Modules/Identity/, src/Http/, templates/admin/permissions/, tests/

### Tests required

Unit all precedence combinations; integration persistence and audit; HTTP denied operation.
Verification maps to AC-1 through AC-6 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Deterministic least-privilege control; FR-03/04, D-03.
Trace: FR-03, FR-04. Validated context: Lean Spec §8.1, §12.2; D-03.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-1/story-s7.md`
- `docs/lean-spec.md` §8.1, §12.2; D-03

## Out of Scope

Emergency action bypass semantics, role editor UI.

## Dependencies / Preconditions

E1-S6. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E1-S1C

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


### E1-S6B

# Story E1-S6B: Admin Role Grant Management

> Status: todo
> Priority: Core Must
> Depends on: E1-S6, E1-S1C, E1-S7, E2-S1

## WHAT — ต้องสร้างอะไร

Authenticated Admin can view and change Core Role Permission grants, while preserving default deny and audit.

## Acceptance Criteria

- AC-1: Admin whose normal permission evaluation grants Role.Manage views Core role grants and adds/removes Resource.Action grants for Admin/Editor/Approver; each mutation is audited with before/after.
- AC-2: Editor, Approver, pending-MFA and Admin with explicit User Deny: Role.Manage cannot change grants.
- AC-3: Subsequent authorization reflects the persisted grant change; a missing grant remains default deny.
- AC-4: State-changing browser request rejects invalid/missing CSRF token.

## HOW — Constraints / Implementation Boundaries

First Admin comes from E1-S1C. Role grants start from deterministic E1-S6 seed; user overrides still take precedence.

### Expected files / areas

src/Modules/Identity/, src/Http/, templates/admin/roles/, tests/

### Tests required

HTTP Admin allow/deny/CSRF and role-grant changes; integration persistence and audit.
Verification maps to AC-1 through AC-4 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Completes Admin role/permission management without bloating foundational role evaluation; FR-01/03.
Trace: FR-01, FR-03. Validated context: Lean Spec §1.2 Admin, §4 FR-01/03, §8.1, §12.2, §15 Identity; D-03/16.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-1/story-s6b.md`
- `docs/lean-spec.md` §1.2 Admin, §4 FR-01/03, §8.1, §12.2, §15 Identity; D-03/16

## Out of Scope

User CRUD, emergency bypass and user-specific overrides UI.

## Dependencies / Preconditions

E1-S6, E1-S1C, E1-S7, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E1-S1B

# Story E1-S1B: Admin User Management

> Status: todo
> Priority: Core Must
> Depends on: E1-S7, E1-S5A, E2-S1, E1-S1C, E1-S6B
> Execution checkpoint: NEXT / NOT STARTED (E2-S1 satisfied; ready for fresh-context guided development; retain and verify the other listed prerequisites in that separate session)

## WHAT — ต้องสร้างอะไร

Admin-facing create/edit/deactivate user and assign role using the authenticated CMS; first-Admin provisioning is in E1-S1C.

## Acceptance Criteria

- AC-1: Authorized Admin creates user, updates account fields, activates/deactivates and assigns Admin/Editor/Approver.
- AC-2: Unauthorized user cannot manage users.
- AC-3: Deactivation blocks further authentication/session access.
- AC-4: Each account/role mutation is audited with actor and before/after.
- AC-5: Newly created users receive the selected role’s seeded Core grants and remain subject to user-specific Deny/Allow; first-Admin provisioning is exclusively E1-S1C.
- AC-6: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Check User.Manage; keep provisioning credentials out of repository; admin reset belongs to E1-S5B.

### Expected files / areas

src/Modules/Identity/, src/Http/, templates/admin/users/, tests/

### Tests required

HTTP authorized/denied create/edit/deactivate/role assignment; integration deactivation and audit.
Verification maps to AC-1 through AC-6 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Completes the explicitly required Admin user lifecycle absent from the original roadmap; FR-01/02.
Trace: FR-01, FR-02, FR-07. Validated context: Lean Spec §4 FR-01–02/07, §9, §12.2, §15 Identity; D-10/16.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-1/story-s1b.md`
- `docs/lean-spec.md` §4 FR-01–02/07, §9, §12.2, §15 Identity; D-10/16

## Out of Scope

First-Admin provisioning, public registration, MFA reset and notification.

## Dependencies / Preconditions

E1-S7, E1-S5A, E2-S1, E1-S1C, E1-S6B. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS

### E1-S5B

# Story E1-S5B: Admin MFA Reset

> Status: todo
> Priority: Core Must
> Depends on: E1-S1B, E1-S5A

## WHAT — ต้องสร้างอะไร

Authorized Admin resets a user’s registered MFA, allowing safe re-enrollment on next password sign-in.

## Acceptance Criteria

- AC-1: Only Admin whose normal permission evaluation grants User.Manage may reset a target user’s MFA; an explicit User Deny: User.Manage blocks reset even for Admin.
- AC-2: Reset invalidates prior registered MFA methods and forces re-enrollment before CMS access.
- AC-3: Reset is auditable with actor, target and before/after (without secrets).
- AC-4: Non-Admin and denied Admin cannot perform reset.
- AC-5: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

MFA Reset uses only User.Manage plus Admin role, subject to User Deny > User Allow > Role Permission > Default Deny. Recovery is registered backup or Admin reset only.

### Expected files / areas

src/Modules/Identity/, src/Http/, templates/admin/users/, tests/

### Tests required

HTTP Admin allow/explicit User Deny/non-Admin denial; integration invalidation, re-enrollment and audit.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Completes FR-07 without mixing enrollment and Admin management; D-10/16.
Trace: FR-07. Validated context: Lean Spec §9, §12.2, §8.1; D-10/16.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-1/story-s5b.md`
- `docs/lean-spec.md` §9, §12.2, §8.1; D-10/16

## Out of Scope

Email notification jobs, public recovery flow.

## Dependencies / Preconditions

E1-S1B, E1-S5A. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E2-S2

# Story E2-S2: Audit Admin Query

> Status: todo
> Priority: Core Must
> Depends on: E1-S7, E2-S1

## WHAT — ต้องสร้างอะไร

Authorized Admin list/filter/detail view for audit records.

## Acceptance Criteria

- AC-1: Admin with Audit.View can list records and filter by available actor, action, target and time fields.
- AC-2: A selected record shows relevant before/after, reason and request metadata; no edit/delete control.
- AC-3: Unauthorized or pending-MFA user cannot view audit.
- AC-4: Queries cannot alter stored records.
- AC-5: Admin with Audit.View searches by exact target ID or partial attempted principal and receives matching records only; search combines with actor/action/time filters without changing stored audit rows.

## HOW — Constraints / Implementation Boundaries

Read-only repository; role check uses final precedence; user/anonymous/system actor rendering.

### Expected files / areas

src/Modules/Audit/, src/Http/, templates/admin/audit/, tests/

### Tests required

Integration exact target and partial attempted-principal search combined with filters; HTTP permission and detail.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Makes the immutable trail inspectable; FR-55, D-16.
Trace: FR-55. Validated context: Lean Spec §12, §12.1, §15 Audit; D-16.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-2/story-s2.md`
- `docs/lean-spec.md` §12, §12.1, §15 Audit; D-16

## Out of Scope

Export, audit purge, dashboard.

## Dependencies / Preconditions

E1-S7, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E2-S3

# Story E2-S3: Audit Export

> Status: todo
> Priority: Core Must
> Depends on: E2-S2

## WHAT — ต้องสร้างอะไร

Export filtered audit data from the authorized Admin view.

## Acceptance Criteria

- AC-1: Admin with Audit.View exports exactly the selected search and filter result set in an explicitly labeled tabular file.
- AC-2: Escaping prevents exported values from being interpreted as spreadsheet formulas.
- AC-3: Unauthorized request is denied; export never mutates the audit trail.

## HOW — Constraints / Implementation Boundaries

Reuse read-only query and authorization semantics; preserve timestamps and actor fields.

### Expected files / areas

src/Modules/Audit/, src/Http/, tests/

### Tests required

HTTP export permission/filter; integration record integrity.
Verification maps to AC-1 through AC-3 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Completes audit search/filter/export capability; FR-55.
Trace: FR-55. Validated context: Lean Spec §4 FR-55, §12, §15 Audit.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-2/story-s3.md`
- `docs/lean-spec.md` §4 FR-55, §12, §15 Audit

## Out of Scope

Automated purge, external analytics.

## Dependencies / Preconditions

E2-S2. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E3-S1

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


### E3-S2

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


### E3-S3

# Story E3-S3: Revision Persistence

> Status: todo
> Priority: Core Must
> Depends on: E3-S2, E2-S1

## WHAT — ต้องสร้างอะไร

Persist locale-bound revisions with title, slug, display window, workflow state and JSONB block snapshot.

## Acceptance Criteria

- AC-1: Draft revision saves and reloads localized metadata, display times and independent JSONB snapshot.
- AC-2: New revision on published content leaves Active Revision unchanged.
- AC-3: Attempt to modify an Active Revision is rejected; draft creation/edit is audited.
- AC-4: Each revision belongs to one locale; invalid windows are rejected.
- AC-5: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Revision-level title/slug/window; immutable Active revision; relational metadata and JSONB blocks.

### Expected files / areas

migrations/, src/Modules/Content/, tests/integration/

### Tests required

Integration snapshot round trip, ownership, active immutability; unit window validation.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Revision history without live editing; FR-14/17, D-11/17.
Trace: FR-14, FR-17. Validated context: Lean Spec §5–7, §21, §12.2; D-11/17.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-3/story-s3.md`
- `docs/lean-spec.md` §5–7, §21, §12.2; D-11/17

## Out of Scope

Block editor UI, approval, SEO fields.

## Dependencies / Preconditions

E3-S2, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E6-S1

# Story E6-S1: Storage Abstraction

> Status: todo
> Priority: Core Must
> Depends on: E0-S3

## WHAT — ต้องสร้างอะไร

StorageInterface and LocalStorage implementation for content assets using configured persistent volume.

## Acceptance Criteria

- AC-1: Storage contract stores, reads and removes asset bytes through an opaque reference.
- AC-2: Local implementation retains bytes across runtime recreation with configured volume.
- AC-3: Calling domain does not construct filesystem paths or assume local disk.

## HOW — Constraints / Implementation Boundaries

Core LocalStorage; no direct filesystem dependency in business rules.

### Expected files / areas

src/Modules/Media/, src/Infrastructure/Storage/, config/, compose.yaml, tests/

### Tests required

Unit storage contract; integration write/read/delete and volume smoke.
Verification maps to AC-1 through AC-3 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Decouples asset lifecycle from local paths; D-12.
Trace: foundation / NFR only. Validated context: Lean Spec §22, §27; D-12.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-6/story-s1.md`
- `docs/lean-spec.md` §22, §27; D-12

## Out of Scope

Upload UI, S3/MinIO, advanced media folders.

## Dependencies / Preconditions

E0-S3. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E6-S2

# Story E6-S2: Basic Media Upload

> Status: todo
> Priority: Core Must
> Depends on: E6-S1, E1-S7, E2-S1

## WHAT — ต้องสร้างอะไร

Authorized basic image/file upload with alt text, caption and metadata.

## Acceptance Criteria

- AC-1: Authorized upload stores accepted file and persists metadata, alt text and caption.
- AC-2: Invalid type/size/content and unauthorized upload are rejected without asset record or stored bytes.
- AC-3: Successful media creation/edit/removal is audited.
- AC-4: Read of asset uses storage reference, not path derived from user input.
- AC-5: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Input validation and parameter binding; Media.Upload permission; no media reference deletion policy until E6-S3.

### Expected files / areas

migrations/, src/Modules/Media/, src/Http/, templates/admin/media/, tests/

### Tests required

HTTP valid/invalid/unauthorized upload; integration storage rollback and audit.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Minimal media support required by content; FR-09/39 and NFR-03.
Trace: FR-09, FR-39. Validated context: Lean Spec §11, §12.2, §13 NFR-03, §22; D-12.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-6/story-s2.md`
- `docs/lean-spec.md` §11, §12.2, §13 NFR-03, §22; D-12

## Out of Scope

Asset folders/tags, usage reference, notification.

## Dependencies / Preconditions

E6-S1, E1-S7, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E3-S4

# Story E3-S4: Core Block Editor

> Status: todo
> Priority: Core Must
> Depends on: E3-S3, E6-S2

## WHAT — ต้องสร้างอะไร

Draft Page revision editor for Rich Text, Image, Download and CTA blocks with add/delete/reorder.

## Acceptance Criteria

- AC-1: Editor adds, deletes and reorders four core block types; saved order and content round-trip in revision JSONB snapshot.
- AC-2: Invalid block type or invalid media reference is rejected.
- AC-3: Saving draft does not mutate Active Revision or another locale.
- AC-4: Rich Text and CTA output is escaped/sanitized at rendering boundary.
- AC-5: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Each Revision owns JSONB block snapshot; media selection uses asset IDs; no arbitrary layout builder.

### Expected files / areas

src/Modules/Content/, src/Http/, templates/admin/content/, tests/

### Tests required

HTTP add/remove/reorder and unauthorized edit; integration JSONB round-trip/immutability.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Complete minimum Page editor without optional capabilities; FR-33–35, D-11/17.
Trace: FR-33, FR-34, FR-35. Validated context: Lean Spec §4 FR-33–35, §21, §11; D-11.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-3/story-s4.md`
- `docs/lean-spec.md` §4 FR-33–35, §21, §11; D-11

## Out of Scope

Hero/Gallery, Shared Block, visual diff, SEO.

## Dependencies / Preconditions

E3-S3, E6-S2. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E6-S3

# Story E6-S3: Media Usage Protection

> Status: todo
> Priority: Core Must
> Depends on: E3-S4, E6-S2

## WHAT — ต้องสร้างอะไร

Persist media usage references from revision blocks; block deletion updates usage and asset deletion respects references.

## Acceptance Criteria

- AC-1: Media detail lists content identities using asset.
- AC-2: Referenced asset deletion is rejected with no bytes or metadata removed.
- AC-3: Removing last reference through draft edit permits deletion only when no other revision/content still references asset.
- AC-4: Revision write and usage reference update commit or roll back together.
- AC-5: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

References include revision history where still referenced; transaction across content/media persistence.

### Expected files / areas

migrations/, src/Modules/Media/, src/Modules/Content/, tests/integration/

### Tests required

Integration shared usage, historic revision, rollback and deletion gate.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Prevent broken downloads and images; FR-40, D-11/12.
Trace: FR-40. Validated context: Lean Spec §11, §21, §17; D-11/12.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-6/story-s3.md`
- `docs/lean-spec.md` §11, §21, §17; D-11/12

## Out of Scope

Folder/tag taxonomy, shared blocks.

## Dependencies / Preconditions

E3-S4, E6-S2. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E4-S1

# Story E4-S1: Draft & Submit Workflow

> Status: todo
> Priority: Core Must
> Depends on: E3-S3, E1-S7, E2-S1

## WHAT — ต้องสร้างอะไร

Authorized Draft → Pending Approval transition on one locale revision.

## Acceptance Criteria

- AC-1: Editor saves Draft and submits it; state becomes Pending Approval with submission record.
- AC-2: Unauthorized user and invalid source state cannot submit.
- AC-3: Transition and audit commit together; active revision remains unchanged.
- AC-4: TH submit does not change EN state.
- AC-5: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Workflow service owns transition; transaction includes revision and audit; no SQL in service.

### Expected files / areas

src/Modules/Workflow/, src/Modules/Content/, src/Http/, tests/

### Tests required

Unit valid/invalid transition; integration transactional audit; HTTP submit permission.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

First reviewable workflow step; FR-10, D-17/20.
Trace: FR-10. Validated context: Lean Spec §6.1, §12.2, §17, §15 Workflow; D-17.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-4/story-s1.md`
- `docs/lean-spec.md` §6.1, §12.2, §17, §15 Workflow; D-17

## Out of Scope

Reject, Withdraw, Approval, optional visual diff.

## Dependencies / Preconditions

E3-S3, E1-S7, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E4-S2

# Story E4-S2: Withdraw & Reject

> Status: todo
> Priority: Core Must
> Depends on: E4-S1

## WHAT — ต้องสร้างอะไร

Editor withdraws Pending Approval; authorized reviewer rejects Pending Approval with standard reason plus optional text.

## Acceptance Criteria

- AC-1: Withdraw Pending Approval returns revision to Draft; approved/scheduled/active revision cannot withdraw.
- AC-2: Reject Pending Approval requires a selected standard reason and accepts optional explanation; revision returns Draft.
- AC-3: Unauthorized or already decided requests fail without mutation.
- AC-4: Both actions and reasons are audited transactionally.
- AC-5: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Withdraw only Pending Approval; standard reason selection; no after-approval cancellation.

### Expected files / areas

src/Modules/Workflow/, src/Http/, templates/admin/workflow/, tests/

### Tests required

Unit transition matrix; HTTP reason validation/permissions; integration atomic audit.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Bounded return paths for editorial review; FR-11–13.
Trace: FR-11, FR-12, FR-13. Validated context: Lean Spec §6.1, §6.5, §12.2, §15 Workflow.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-4/story-s2.md`
- `docs/lean-spec.md` §6.1, §6.5, §12.2, §15 Workflow

## Out of Scope

Approve, cancel scheduled approval, visual diff.

## Dependencies / Preconditions

E4-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E4-S3

# Story E4-S3: Approval & Separation of Duties

> Status: todo
> Priority: Core Must
> Depends on: E4-S1, E1-S7, E2-S1

## WHAT — ต้องสร้างอะไร

Normal Approver approval decision with ownership check and pending scheduled/activation handoff.

## Acceptance Criteria

- AC-1: Authorized Approver may approve Pending Approval revision created and last edited by another user.
- AC-2: Creator or latest editor cannot approve own revision, even if role grants Content.Approve.
- AC-3: Approving future Display From yields Approved Scheduled and does not replace current Active revision.
- AC-4: Approved Scheduled already present for locale blocks another future approval; invalid/unauthorized approvals leave state untouched.
- AC-5: Approval decision is audited atomically.
- AC-6: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Approval ≠ Activation; one Approved Scheduled per locale; no cancellation after approval; activation behavior delegated E4-S4.

### Expected files / areas

src/Modules/Workflow/, src/Modules/Content/, src/Http/, tests/

### Tests required

Unit self-approval/transition; integration one-scheduled concurrency and audit; HTTP permission.
Verification maps to AC-1 through AC-6 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Separation of duties and safe scheduling; FR-11/18/24, D-18/21.
Trace: FR-11, FR-18, FR-24. Validated context: Lean Spec §6.1–6.5, §8, §12.2; D-18/21.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-4/story-s3.md`
- `docs/lean-spec.md` §6.1–6.5, §8, §12.2; D-18/21

## Out of Scope

Break-glass, scheduling runner, visual diff.

## Dependencies / Preconditions

E4-S1, E1-S7, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E4-S4

# Story E4-S4: Revision Activation

> Status: todo
> Priority: Core Must
> Depends on: E4-S3, E3-S2

## WHAT — ต้องสร้างอะไร

Atomic immediate or due scheduled activation of locale revision and replacement of old Active pointer.

## Acceptance Criteria

- AC-1: Approval with Display From ≤ now < Display Until may activate immediately.
- AC-2: Future-approved revision leaves old Active publicly selectable until due; due activation points locale to new revision and sets old Active to Superseded.
- AC-3: Superseded is used only for replaced Active revision; Approved Scheduled never becomes Superseded without activation.
- AC-4: Retry/concurrent activation cannot create multiple active pointers; each actual activation gets a separate Revision activation audit record, distinct from Approval: authenticated user actor for immediate approval-triggered activation and system actor for scheduler-driven activation.
- AC-5: Active slug is the only canonical slug for that locale.

## HOW — Constraints / Implementation Boundaries

Atomic pointer/state/audit; one approved scheduled; no postapproval cancel; expose due activation CLI callable by scheduler without Stretch queue.

### Expected files / areas

src/Modules/Workflow/, src/Modules/Content/, bin/, tests/

### Tests required

Unit windows/transition; integration immediate user-actor and scheduled system-actor activation audit distinct from approval, pointer swap/concurrency; CLI due activation.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Keep old revision visible until replacement is eligible; FR-15/18/27, D-21.
Trace: FR-14, FR-15, FR-18, FR-27. Validated context: Lean Spec §5–7, §10.1, §24.1; D-17/20/21.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-4/story-s4.md`
- `docs/lean-spec.md` §5–7, §10.1, §24.1; D-17/20/21

## Out of Scope

Public route fallback, expiration, queue.

## Dependencies / Preconditions

E4-S3, E3-S2. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E4-S5

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


### E4-S6

# Story E4-S6: Archive Workflow

> Status: todo
> Priority: Core Must
> Depends on: E4-S3, E4-S4, E2-S1

## WHAT — ต้องสร้างอะไร

Content-level Archive request/decision including approval or rejection.

## Acceptance Criteria

- AC-1: Editor requests archive and authorized Approver approves or rejects request.
- AC-2: Approved archive hides all TH/EN public revisions and fallback, while content/revisions remain stored.
- AC-3: Normal Approver cannot approve Archive for Content they created or edited most recently; creator and latest-editor cases are denied, even when they are not the requester. Emergency exception belongs to E4-S8.
- AC-4: Archive request, decision and effective state are audited transactionally.
- AC-5: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Archive.Request authorizes Editor request; Archive.Approve authorizes normal Approver decision, additionally denying Content creator/latest editor. Archive is Content-level; E4-S8 is the only break-glass exception.

### Expected files / areas

migrations/, src/Modules/Workflow/, src/Modules/Content/, src/Http/, tests/

### Tests required

Unit creator/latest-editor denial; integration both locales and atomic audit; HTTP role restrictions.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Prevent any public route serving archived identity; FR-20, D-22.
Trace: FR-20. Validated context: Lean Spec §1.2 Approver, §4 FR-20/24, §5, §8.3, §10.2, §12.2; D-18/22.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-4/story-s6.md`
- `docs/lean-spec.md` §1.2 Approver, §4 FR-20/24, §5, §8.3, §10.2, §12.2; D-18/22

## Out of Scope

Restore, automatic deletion, per-locale archive.

## Dependencies / Preconditions

E4-S3, E4-S4, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E4-S7

# Story E4-S7: Restore Workflow

> Status: todo
> Priority: Core Must
> Depends on: E4-S6

## WHAT — ต้องสร้างอะไร

Content-level Restore request/decision, re-evaluating each locale’s public eligibility.

## Acceptance Criteria

- AC-1: Editor requests restore for archived content; authorized Approver approves or rejects.
- AC-2: Approved restore lifts Content-level archive; each locale shows only an Active revision whose Display From ≤ now < Display Until. If an Approved Scheduled revision became eligible during archive, restore atomically invokes E4-S4 due activation before deciding visibility; a revision already past Display Until stays hidden/Expired.
- AC-3: Rejection keeps both locales archived.
- AC-4: Request, decision and change are audited atomically.
- AC-5: Normal Approver cannot approve Restore for Content they created or edited most recently; both creator and latest-editor cases are denied and emergency exception is reserved to E4-S8.
- AC-6: If restore request triggers due activation, write distinct Revision activation audit with authenticated user actor within the restore transaction; restore decision audit remains separate.
- AC-7: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Restore.Request authorizes Editor request; Restore.Approve authorizes normal Approver decision, additionally denying Content creator/latest editor. At restore, evaluate each locale with E4-S4 due activation and window rule; archive/restore are Content-level.

### Expected files / areas

src/Modules/Workflow/, src/Modules/Content/, src/Http/, tests/

### Tests required

Unit creator/latest-editor denial; integration archived eligible Approved Scheduled activation versus expired hidden state and atomic audit; HTTP permission/decision.
Verification maps to AC-1 through AC-7 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Recover preserved identity without bypassing display rules; FR-21, D-22.
Trace: FR-21. Validated context: Lean Spec §1.2 Approver, §4 FR-21/24, §5, §6.3–6.4, §8.3, §10.2, §12.2; D-18/22.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-4/story-s7.md`
- `docs/lean-spec.md` §1.2 Approver, §4 FR-21/24, §5, §6.3–6.4, §8.3, §10.2, §12.2; D-18/22

## Out of Scope

New revision approval, break-glass, per-locale archive.

## Dependencies / Preconditions

E4-S6. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E4-S8

# Story E4-S8: Emergency Override

> Status: todo
> Priority: Core Must
> Depends on: E4-S3, E4-S6, E4-S7, E1-S7, E2-S1

## WHAT — ต้องสร้างอะไร

Admin break-glass approval decision path with explicit permission, mandatory reason and append-only audit.

## Acceptance Criteria

- AC-1: Only Admin whose normal evaluation grants EmergencyOverride.Execute may execute; explicit user Deny blocks Admin.
- AC-2: Override can bypass normal approval permission, Approver requirement and self-approval only.
- AC-3: Missing reason, failed validation or failed audit aborts entire action.
- AC-4: Audit includes actor, action, target, time, reason, before/after and request correlation.
- AC-5: Exercise revision, Archive and Restore approval separately: for each action, authorized Admin may bypass normal Approver role, action approval permission and creator/latest-editor prohibition; mandatory reason, domain validation, audit and transaction still cannot be bypassed.
- AC-6: State-changing browser request rejects a missing or invalid CSRF token without persisting a mutation.

## HOW — Constraints / Implementation Boundaries

Never bypass validation, transaction integrity or audit; same domain transitions and archive/restore ownership.

### Expected files / areas

src/Modules/Identity/, src/Modules/Workflow/, src/Http/, tests/

### Tests required

Unit denied Admin and explicit User Deny matrix; integration/HTTP action matrix for revision/Archive/Restore, mandatory reason, audit failure rollback and validation failure.
Verification maps to AC-1 through AC-6 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Controlled exception for approval emergencies; FR-22/23, D-19.
Trace: FR-22, FR-23. Validated context: Lean Spec §8.1–8.3, §12, §15 Workflow; D-19.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-4/story-s8.md`
- `docs/lean-spec.md` §8.1–8.3, §12, §15 Workflow; D-19

## Out of Scope

General superuser mode, direct mutation of audit, bypass of data validation.

## Dependencies / Preconditions

E4-S3, E4-S6, E4-S7, E1-S7, E2-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E5-S1

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


### E7-S1

# Story E7-S1: Public Content Rendering

> Status: todo
> Priority: Core Must
> Depends on: E4-S5, E4-S6, E3-S4, E1-S3

## WHAT — ต้องสร้างอะไร

Public Home/List/Detail using only visible active content; safe block rendering.

## Acceptance Criteria

- AC-1: Anonymous user can load Home, Listing and Detail for visible content.
- AC-2: Draft/Pending/Scheduled/Expired/Archived revisions are absent from listing and detail; no active public revision returns no content.
- AC-3: Rich Text, Image, Download, CTA render safely with escaped user-controlled output.
- AC-4: Content type and revision data come from public read model without CMS permissions.

## HOW — Constraints / Implementation Boundaries

Publication eligibility checked at request time; active pointer only; no dependency on Category/Tag/Menu/Search.

### Expected files / areas

src/Modules/PublicSite/, src/Modules/Content/, templates/public/, tests/

### Tests required

HTTP home/list/detail and hidden-state matrix; integration active read.
Verification maps to AC-1 through AC-4 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

End-to-end public surface for Core demo; FR-47, D-06/07/21.
Trace: FR-47. Validated context: Lean Spec §4 FR-47, §6–7, §10.2, §15 Public Site, §19.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-7/story-s1.md`
- `docs/lean-spec.md` §4 FR-47, §6–7, §10.2, §15 Public Site, §19

## Out of Scope

Locale prefix/fallback, search/filter, SEO, menus.

## Dependencies / Preconditions

E4-S5, E4-S6, E3-S4, E1-S3. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E5-S2

# Story E5-S2: EN→TH Fallback Resolver

> Status: todo
> Priority: Core Must
> Depends on: E5-S1, E7-S1

## WHAT — ต้องสร้างอะไร

Public read resolver for missing requested EN Active revision using TH Active revision slug; returns fallback notice signal.

## Acceptance Criteria

- AC-1: EN Active with matching EN slug resolves EN.
- AC-2: EN absent and TH Active with matching TH slug resolves TH under /en/ with fallback signal.
- AC-3: Slug from Draft/Pending/Approved Scheduled/Expired/Superseded/history never resolves fallback.
- AC-4: Neither locale Active or archived content resolves no public content.
- AC-5: EN has any Active revision and requested slug does not match EN Active, even if slug matches current TH Active: return no content and no fallback. Historical TH slug is likewise not a route source.

## HOW — Constraints / Implementation Boundaries

Only requested Active or fallback Active slug; preserve requested locale prefix; eligibility obeys display window/archive.

### Expected files / areas

src/Modules/PublicSite/, src/Modules/Content/, tests/

### Tests required

Unit slug/state matrix; integration archived/expired routes.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Deterministic language fallback with visible notice; FR-28/29, D-20/21/22.
Trace: FR-28, FR-29. Validated context: Lean Spec §10.1–10.2, §5; D-20/21/22.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-5/story-s2.md`
- `docs/lean-spec.md` §10.1–10.2, §5; D-20/21/22

## Out of Scope

HTTP route templates, redirects, search fallback.

## Dependencies / Preconditions

E5-S1, E7-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E7-S2

# Story E7-S2: Core Public Localization

> Status: todo
> Priority: Core Must
> Depends on: E7-S1, E5-S2

## WHAT — ต้องสร้างอะไร

HTTP /th/... and /en/... routes, active slug links and rendered fallback notice using E5-S2 resolver.

## Acceptance Criteria

- AC-1: TH and EN active revisions produce their locale-prefixed canonical detail URLs.
- AC-2: /en/{type}/{TH active slug} renders TH when EN lacks Active, with clear fallback notice and no redirect.
- AC-3: Inactive/historical slugs return no content; archive hides both locale routes.
- AC-4: Home/list links use active revision slugs and requested prefix; no localized URL is built from draft.
- AC-5: When EN has Active slug A but request /en/... uses current TH Active slug B, return no content/no fallback rather than TH; HTTP regression covers this and inactive/historical slugs.

## HOW — Constraints / Implementation Boundaries

Route resolver is E5-S2; no public slug from inactive revision; no SEO dependency.

### Expected files / areas

src/Modules/PublicSite/, src/Http/, templates/public/, tests/

### Tests required

HTTP locale route matrix including fallback notice and nonredirect.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Exposes deterministic multilingual public experience; FR-26–29.
Trace: FR-26, FR-27, FR-28, FR-29. Validated context: Lean Spec §4 FR-26–29, §10.1, §15 Public Site; D-20/21.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-7/story-s2.md`
- `docs/lean-spec.md` §4 FR-26–29, §10.1, §15 Public Site; D-20/21

## Out of Scope

Search, metadata, menu, per-locale archive.

## Dependencies / Preconditions

E7-S1, E5-S2. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E5-S3

# Story E5-S3: Protected Preview

> Status: todo
> Priority: Core Must
> Depends on: E3-S4, E4-S1, E1-S7

## WHAT — ต้องสร้างอะไร

Authenticated preview of Draft/Pending revision with independent locale and no public indexing.

## Acceptance Criteria

- AC-1: Authorized Editor or Approver previews specified Draft/Pending revision including core blocks.
- AC-2: Anonymous, password-only, unauthorized user and guessed revision URL cannot preview.
- AC-3: Preview does not change active pointer or make draft publicly listable.
- AC-4: Output identifies preview state and locale clearly.

## HOW — Constraints / Implementation Boundaries

Use session authorization; do not resolve preview through public Active slug routing.

### Expected files / areas

src/Modules/PublicSite/, src/Http/, templates/admin/preview/, tests/

### Tests required

HTTP allowed/denied preview; integration no public visibility.
Verification maps to AC-1 through AC-4 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Allows review before publishing without leaking unpublished material; FR-32.
Trace: FR-32. Validated context: Lean Spec §4 FR-32, §10, §15 Public Site, §20.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-5/story-s3.md`
- `docs/lean-spec.md` §4 FR-32, §10, §15 Public Site, §20

## Out of Scope

Public draft route, visual diff, SEO preview.

## Dependencies / Preconditions

E3-S4, E4-S1, E1-S7. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E8-S1

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


### E8-S2

# Story E8-S2: Security Hardening

> Status: todo
> Priority: Core Must
> Depends on: E1-S5B, E4-S8, E6-S3, E7-S2, E9-S1

## WHAT — ต้องสร้างอะไร

Close gaps across implemented Core flows and run fixed security checks before demo.

## Acceptance Criteria

- AC-1: Protected state-changing requests reject missing/invalid CSRF token.
- AC-2: Login/OTP rate limits, Secure/HttpOnly/SameSite cookie, regenerated sessions, prepared SQL, authorization, upload validation and output escaping pass recorded checks.
- AC-3: Run composer audit, the project security checklist and OWASP ZAP baseline against the E9-S1 deployed candidate build; if remediation changes code, redeploy that build and rerun the complete gate against the changed deployed build. No unresolved High/Critical finding remains.
- AC-4: Override checks reason, permission, transaction and audit.
- AC-5: If security remediation changes runtime/application/configuration or public UI/templates, record the new deployed build identifier and mark affected earlier E8-S3 performance and E8-S1 accessibility evidence as stale for E9-S2 re-verification.

## HOW — Constraints / Implementation Boundaries

Security gate scans the E9-S1 deployed build; every changed build is redeployed and rescanned. Runtime/application code or performance-relevant configuration changes invalidate performance evidence; public UI/template or accessibility-relevant output changes invalidate affected accessibility evidence. E9-S2 checks final evidence freshness.

### Expected files / areas

src/Http/, src/Modules/, templates/, tests/, docs/quality/

### Tests required

HTTP CSRF/permission regression; checklist; composer audit; deployed ZAP scan after E9-S1.
Verification maps to AC-1 through AC-5 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Fixed NFR-03 security gate; not a substitute for each feature’s security AC.
Trace: foundation / NFR only. Validated context: Lean Spec §13 NFR-03, §17, §20, §26.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-8/story-s2.md`
- `docs/lean-spec.md` §13 NFR-03, §17, §20, §26

## Out of Scope

Third-party SSO, production HA, queue.

## Dependencies / Preconditions

E1-S5B, E4-S8, E6-S3, E7-S2, E9-S1. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


### E8-S3

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


### E9-S1

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


### E9-S2

# Story E9-S2: Final Online Demo Verification

> Status: todo
> Priority: Core Must
> Depends on: E9-S1, E8-S2

## WHAT — ต้องสร้างอะไร

Verify the online demo after the deployed security gate on the exact build that will be demonstrated.

## Acceptance Criteria

- AC-1: Final deployed build identifier matches the build that passed E8-S2 composer audit, deployed ZAP baseline and security checklist; it is also covered by current E8-S1 accessibility and E8-S3 performance evidence.
- AC-2: If E8-S2 or later remediation changes runtime/application code or performance-relevant configuration, redeploy and rerun E8-S3 fixed public and CMS load profiles against final build before signoff; if it changes public UI/templates or accessibility-relevant output, rerun affected E8-S1 checks. Redeploy and rerun E8-S2 security gate after any build change.
- AC-3: Public and CMS smoke, DB migration, scheduler and persistent media pass on final build; no unresolved High/Critical finding.
- AC-4: Signoff evidence maps one final build identifier to the passing security, accessibility and performance gates; stale or mismatched evidence blocks completion, and a rerun does not reopen completed stories as dependencies.

## HOW — Constraints / Implementation Boundaries

Complete after E9-S1 and E8-S2; check evidence on exact final deployed build. Carry forward E8-S1/E8-S3 only when changes cannot invalidate their measured surfaces; otherwise rerun affected gates here. No story-completion cycle.

### Expected files / areas

docs/deployment/, tests/smoke/

### Tests required

Verify build identity and evidence freshness; rerun E8-S3 fixed profiles after relevant runtime/app/config changes and affected E8-S1 checks after public UI changes; final deployed end-to-end smoke and linked E8-S2 scan evidence.
Verification maps to AC-1 through AC-4 as applicable; assert negative paths and persistence invariants, not just happy paths.

## WHY — Business / Architecture Rationale

Close final Core Demo Gate without circular completion conditions; NFR-03.
Trace: foundation / NFR only. Validated context: Lean Spec §2, §13 NFR-01–03, §27, §32.

## CONTEXT BUDGET

- `docs/03-project-context.md`
- `docs/epics/epic-9/story-s2.md`
- `docs/lean-spec.md` §2, §13 NFR-01–03, §27, §32

## Out of Scope

New feature work, production HA, Secondary/Stretch.

## Dependencies / Preconditions

E9-S1, E8-S2. Run earlier story verification gates and retain schema/audit behavior.

## Verification Gate

Run the specified relevant unit, integration, HTTP or CLI checks in a repeatable environment; pass every AC, including failure paths; record outputs and submit the artifact plus code changes to independent implementation review.

## FINDINGS


## 5. FR → Story Traceability Matrix

| Core Must FR | Story ID(s) |
|---|---|
| FR-01 | E1-S6B, E1-S1B |
| FR-02 | E1-S1B |
| FR-03 | E1-S7, E1-S6B |
| FR-04 | E1-S7 |
| FR-05 | E1-S2, E1-S3, E1-S4, E1-S5A |
| FR-06 | E1-S4, E1-S5A |
| FR-07 | E1-S1B, E1-S5B |
| FR-08 | E3-S1 |
| FR-09 | E6-S2 |
| FR-10 | E4-S1 |
| FR-11 | E4-S2, E4-S3 |
| FR-12 | E4-S2 |
| FR-13 | E4-S2 |
| FR-14 | E3-S3, E4-S4 |
| FR-15 | E4-S4 |
| FR-17 | E3-S3, E4-S5 |
| FR-18 | E4-S3, E4-S4 |
| FR-19 | E4-S5 |
| FR-20 | E4-S6 |
| FR-21 | E4-S7 |
| FR-22 | E4-S8 |
| FR-23 | E4-S8 |
| FR-24 | E4-S3 |
| FR-25 | E3-S2, E5-S1 |
| FR-26 | E7-S2 |
| FR-27 | E4-S4, E7-S2 |
| FR-28 | E5-S2, E7-S2 |
| FR-29 | E5-S2, E7-S2 |
| FR-32 | E5-S3 |
| FR-33 | E3-S4 |
| FR-34 | E3-S4 |
| FR-35 | E3-S4 |
| FR-39 | E6-S2, E6-S3 |
| FR-40 | E6-S3 |
| FR-47 | E7-S1 |
| FR-53 | E2-S1 |
| FR-54 | E2-S1 |
| FR-55 | E2-S2, E2-S3 |
| FR-56 | E2-S1, E1-S2, E4-S4, E4-S6, E4-S7, E4-S8, E6-S2 |
| FR-57 | E2-S1 |

## 6. Targeted Review Findings

The independent v0.2 targeted re-review confirmed CORE-REV-01..11 CLOSED. The v0.3 regression remediation and the owner-approved dependency/identity addendum in §§9–11 subsequently passed the relevant targeted independent planning review. The original remediation descriptions are retained below:

| Finding | v0.3 reviewed remediation |
|---|---|
| CORE-RR-01 | E1-S1C explicitly depends on E1-S4, so its real TOTP enrollment and login smoke can pass without relying on report ordering; E1-S6B inherits the prerequisite. |
| CORE-RR-02 | E8-S1/E8-S3 record build evidence; E8-S2 identifies invalidation from code/UI changes; E9-S2 reruns affected quality gates on the final deployed build and blocks stale evidence. |

### Earlier findings (confirmed closed by v0.2 review)

| Finding | Implemented closure |
|---|---|
| CORE-REV-01 | E9-S1 complete scan candidate depends on every Core application surface; E8-S2 scans deployed build and rescans fixes; E9-S2 verifies same final build. |
| CORE-REV-02 | E4-S7 restores eligible Approved Scheduled via due activation, never expired revision. |
| CORE-REV-03 | E4-S5 CLI test activates due successor while old Active remains in display window. |
| CORE-REV-04 | E4-S6/S7 deny creator and latest editor; both Context Budgets include §1.2 and FR-24. |
| CORE-REV-05 | E4-S8 tests revision, Archive and Restore approval override matrix. |
| CORE-REV-06 | E5-S2/E7-S2 deny current TH Active fallback when EN already Active with mismatched slug. |
| CORE-REV-07 | E1-S3 records Login success only after MFA; E4-S4 records immediate and scheduled activation separately from approval. |
| CORE-REV-08 | E1-S6 seeds concrete role grants; E1-S6B manages grants; E1-S7 manages overrides; E1-S5B reset uses User.Manage with Deny. |
| CORE-REV-09 | E2-S2 searches exact target ID or partial attempted principal; E2-S3 exports searched/filtered selection. |
| CORE-REV-10 | E1-S1C provisions first Admin via one-time CLI; E1-S1B stays HTTP account lifecycle. |
| CORE-REV-11 | E1-S3 logout requires valid CSRF token and tests unchanged session on failure. |

## 7. Risks / Open Planning Findings

Owner choices resolved the previously open dependency and identity decisions; the relevant targeted independent planning review passed. E2-S1 subsequently completed implementation and independent implementation review, including remediation and targeted re-review of E2S1-REV-01 (CLOSED). No E2-S1 review finding remains open.

## 8. Final Consistency Check

- All 40 Core Must FRs mapped (see matrix); all ten Core epics represented.
- No Core story depends on Secondary/Stretch; explicit dependency graph is acyclic.
- E1-S1C now has direct TOTP implementation prerequisite.
- Core fallback uses only Active revision slugs and only when requested locale has no Active revision.
- One Approved Scheduled per locale; no cancellation after approval; due activation precedes old revision expiry when eligible.
- Final security scan uses deployed candidate; later runtime/application changes invalidate prior performance evidence, and public UI changes invalidate affected accessibility evidence.
- Core Demo Gate includes MFA, audit, revisions, approval, scheduling/expiry, archive/restore, multilingual fallback, preview, public site, quality and deployment.

CORE STORY PLANNING: TARGETED INDEPENDENT REVIEW PASS

## 9. Owner-Approved Dependency and Identity Decisions — 2026-09-30

These owner-approved decisions subsequently passed targeted independent planning review. The decisions are preserved; the former planning review block is closed.

| ID | Owner-approved decision | Artifact consequence |
|---|---|---|
| RID-01 | `users.id` is a PostgreSQL BIGINT generated identity; Audit `actor_user_id` uses BIGINT. | E2-S1 establishes the Audit scalar contract; E1-S1 creates the generated User identity. |
| RID-02 | Username is required/non-empty, trimmed before persistence, stored with trimmed entered case preserved, and case-insensitive for uniqueness and lookup. | E1-S1 must reject case-only/trim-equivalent duplicates and expose matching repository lookup semantics for E1-S2. |
| RID-03 | Email has the same required, trim, preservation and case-insensitive semantics as username. | E1-S1 provides one deterministic email identity contract for E1-S2 and E1-S5A. |
| RID-04 | State is `is_active BOOLEAN NOT NULL DEFAULT TRUE`; deactivation never deletes identity, and timing belongs to later Audit behavior. | E1-S1 persists the binary state only; E1-S1B owns the audited mutation use case. |
| RID-05 | Every Demo v1 User has exactly one Core Role: Admin, Editor or Approver. Multi-role users are excluded unless a future validated artifact changes this contract. | E1-S1 rejects missing/multiple role association. |
| RID-06 | Roles use a `roles` table and non-null `users.role_id` FK. E1-S1 owns Role identity/association only. | E1-S6 and E1-S6B retain permission/grant ownership. |
| RID-07 | E2-S1 may create nullable `actor_user_id BIGINT` before users exist; `user` requires it and `anonymous`/`system` require null. E1-S1 adds a delete-restricting FK to `users.id`. | Final schema rejects nonexistent user actors and preserves linkage through deactivation. |
| RORD-01 | Approved order is `E0-S4 → E2-S1 → E1-S1`. | Planning review PASS; E0-S4 and E2-S1 are done, satisfying the Audit prerequisite for Identity follow-up work. E1-S1 was completed previously; E1-S1b is the next implementation target. |

## 10. Requirement / Decision Traceability

| Requirement or constraint | Decision / Story coverage | Verification target |
|---|---|---|
| Lean Spec FR-01; Core roles Admin/Editor/Approver | RID-05/06; E1-S1 AC-5; later grant behavior remains E1-S6/E1-S6B | Exactly three Core Role identities; every User has one valid `role_id`; no multi-role association |
| Lean Spec FR-02; create/edit/deactivate/assign Role | RID-02–06 establish the E1-S1 persistence contract; mutation/UI remains E1-S1B | E1-S1 has no HTTP/UI or audited mutation scope; E1-S1B consumes the contract |
| Lean Spec FR-05; username/email login | RID-02/03; E1-S1 AC-2/3; authentication remains E1-S2 | Required principals, trim/preserve round trip, case-insensitive uniqueness and lookup |
| Lean Spec §12.1 actor rules | RID-01/07; E2-S1 AC-1/5; E1-S1 AC-6/7 | User ID required for user actor; null for anonymous/system; nonexistent User rejected after E1-S1 |
| Lean Spec §12.2 User activation/deactivation audit | RID-04; E1-S1 AC-4/7; mutation remains E1-S1B | Deactivation preserves identity/linkage; later mutation records timing in Audit |
| D-04 PostgreSQL; D-05 PDO + handwritten SQL | RID-01–07; both target Stories | PostgreSQL constraints and parameter-bound Repository SQL only |
| D-15 custom SQL migration runner | RORD-01; E2-S1 then E1-S1 | E2 column exists before User table; E1 adds compatible FK without type change |
| D-16 append-only Audit | RID-07; E2-S1 AC-3/4; E1-S1 AC-6/7 | No Audit update/delete API; delete restriction prevents broken actor linkage |
| ≤1-month personal-learning demo | BIGINT identity, Boolean state, exactly-one-Role design | No UUID/distributed-ID machinery, status taxonomy or multi-role model |
| Scope guardrails | Explicit Out of Scope in E1-S1/E2-S1 | No password/login/session/MFA, user HTTP/UI, permission evaluation, Audit query/export or content work |

## 11. Targeted Independent Re-Review Package

Historical review package: the inputs, checks and expected outcome below describe the candidate submission before review. The relevant independent planning review subsequently returned PASS; they do not describe a current pending review or Development block.

### Review inputs

1. `docs/lean-spec.md`: v0.3 validated baseline history plus v0.4 remediation-candidate status, identity decisions and reordered roadmap.
2. `docs/03-project-context.md`: compact candidate identity/Audit contract and development block.
3. `docs/epics/epic-2/story-s1.md`: pre-User Audit scalar/nullability contract.
4. `docs/epics/epic-1/story-s1.md`: complete User/Role/principal/state/FK contract.
5. This remediation artifact: decision record, traceability and review instructions.

### Required reviewer checks

- **Dependency ordering:** Confirm the roadmap and Story dependencies consistently express `E0-S4 → E2-S1 → E1-S1`; confirm no artifact treats that candidate order as Development-authorized before review passes.
- **Identity completeness:** Confirm E1-S1 resolves User PK, required principals, trim/preserve/case-insensitive semantics, active representation, exact-one-Role cardinality, Role persistence and Audit compatibility without leaving business/schema choices to Dev.
- **Audit compatibility:** Confirm E2-S1 can precede `users`, E1-S1 can add the FK without scalar conversion, actor nullability remains correct, nonexistent user actors are rejected after E1-S1, and deletion cannot sever historical linkage.
- **No scope creep:** Confirm E1-S1 contains no password authentication, login, session, MFA, permission/grant evaluation, user-management HTTP/UI, Audit query/export, content behavior or later Epic functionality.
- **Validated-baseline consistency:** Confirm PostgreSQL, PDO + handwritten Repository SQL, custom SQL migrations, Layered Modular Monolith, manual constructor injection and existing E0 behavior remain unchanged.
- **Downstream compatibility:** Confirm E1-S2 can use the principal lookup contract; E1-S5A has required email; E1-S6/E1-S6B retain grant ownership; E1-S1B retains audited lifecycle/Role-assignment behavior; E2-S1 remains append-only.
- **Implementation readiness:** Confirm each AC has a deterministic positive/negative verification target and no unresolved material decision remains in E1-S1 or its E2-S1 linkage prerequisite.
- **Regression findings:** Independently verify CORE-RR-01/02 and effects of this addendum; do not rely on this artifact's self-assessment.

### Expected independent outcome record

The reviewer must record PASS or findings for each check above. Only an independent PASS may authorize the candidate order and E1-S1 for subsequent Development planning. This remediation does not self-validate.

## 12. Addendum Changelog and Status

### 2026-09-30 — Owner-approved identity/dependency remediation candidate

- Recorded RID-01..07 and RORD-01.
- Synchronized the Lean Spec candidate, Project Context, standalone E2-S1/E1-S1 Stories and embedded Story copies.
- Added requirement/decision traceability and the targeted independent re-review package.
- Preserved the v0.3 validated baseline and earlier CORE-REV closure history.
- Performed artifact remediation only; no application source, migration or implementation file is part of this change.

### 2026-10-01 — Workflow state synchronization

- Recorded the supplied targeted independent planning review PASS; approved remediation decisions remain unchanged.
- E0-S4 is done at `f7692362b72ae3409941f16e0f1f5570e23fada7`.
- E2-S1 is done at `7e15d4003c34937243d0d94b5866e9f57f6b4f84` (`feat: add E2-S1 audit write foundation`), committed, pushed and post-push verified with `HEAD == origin/main`.
- Initial implementation review PASS WITH CHANGES (one MINOR) was followed by remediation and targeted independent re-review PASS; E2S1-REV-01 CLOSED; final counts: 0 BLOCKER, 0 MAJOR, 0 MINOR, 0 NOTE.
- E2-S1 prerequisite satisfied; E1-S1 retained as previously completed; E1-S1b is the next separate Guided Development target and remains todo / NOT STARTED. Its other listed prerequisites remain unchanged and require verification in that session.
- Status synchronization only; no approved technical contract changed and no implementation started.

**REMEDIATION STATUS: TARGETED INDEPENDENT PLANNING REVIEW PASS — E2-S1 DONE — NEXT TARGET: E1-S1b**

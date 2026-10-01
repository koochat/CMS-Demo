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

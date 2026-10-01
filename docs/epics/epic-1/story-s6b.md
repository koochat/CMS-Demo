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

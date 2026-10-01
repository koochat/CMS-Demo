# Project Context — MOL CMS Demo
> Source: docs/lean-spec.md v0.3 VALIDATED baseline + reviewed v0.4 remediation | Remediation status: targeted independent review PASS | Flow: LEAN | Target: personal learning demo ≤ 1 month
## Purpose
- ฝึก Business/Product thinking + PHP โดยไม่ใช้ full-stack framework.
- เป็น CMS จำลองสำหรับเว็บไซต์กระทรวงแรงงาน 1 เว็บไซต์ ไม่ใช่ระบบราชการจริง.
- Core flow: Auth → MFA → Permission → Audit → Content → Revision → Approval → Activation → Public → Archive/Restore.
## Locked Stack
- PHP 8.5 + Composer; server-rendered HTML.
- PostgreSQL; PDO + handwritten SQL ใน Repository/Infrastructure เท่านั้น.
- Twig templates; lightweight router; PHPUnit.
- Nginx + PHP-FPM + Docker Compose.
- Server-side session; ไม่ใช้ JWT สำหรับ CMS.
- Manual constructor injection; ห้าม DI container/service locator/global dependencies.
- Content blocks: relational metadata + JSONB revision snapshot.
- File access ผ่าน StorageInterface; Core ใช้ LocalStorage.
- Search = PostgreSQL FTS เฉพาะ Stretch.
- PostgreSQL job queue = Stretch; Core expiration ใช้ scheduler + PHP CLI โดยตรง.
## Architecture
- Layered Modular Monolith.
- Flow: Front Controller → Router → Controller → Application Service → Domain/Repository → Twig.
- Modules: Identity & Access, Content, Workflow, Media, Audit, Public Site.
- Taxonomy/Menu = Secondary; Notification = Stretch.
- Controller/Application Service ห้ามมี SQL.
- Business rules ห้ามอยู่ใน Router/Twig/Repository.
## Authorization
- Normal precedence: User Deny > User Allow > Role Permission > Default Deny.
- Roles: Admin / Editor / Approver.
- Demo v1 has exactly one Core Role per User; every User references one persisted Role through non-null `users.role_id`.
- E1-S1 owns Role identity/association schema only; permission and grant behavior belongs to later authorization stories.
- Approver ห้าม approve งานที่ตนสร้างหรือแก้ล่าสุด.
- Break-glass ต้องเป็น Admin + ผ่าน permission `EmergencyOverride.Execute`.
- Emergency Override bypass approval/self-approval ได้ แต่ห้าม bypass validation, transaction, reason หรือ audit.
## Content / Revision
- Content-level: identity, type, archive/restore.
- Locale-level: TH/EN + active public revision pointer + publication state.
- Revision-level: workflow status, title, slug, SEO, display window, JSONB blocks.
- Active revision ห้ามแก้ตรง; ต้องสร้าง revision ใหม่.
- Approval ≠ Activation; revision เดิมแสดงจน revision ใหม่ถึง Display From.
- หนึ่ง Locale มี Approved Scheduled revision ได้สูงสุด 1 ตัว.
- Demo v1 ไม่มี cancellation หลัง approval; Withdraw ได้เฉพาะ Pending Approval.
- Active revision ที่ถูก revision ใหม่แทน → Superseded.
- เลย Display Until และไม่มี revision ถัดไป → Locale = Expired.
- Expired locale สร้าง revision ใหม่และกลับมา Live ได้.
- Archive/Restore เป็น Content-level และกระทบทุก Locale.
## Localization
- TH/EN มี revision + approval lifecycle แยกกัน; URLs ใช้ `/th/...` และ `/en/...`.
- ถ้า requested locale ไม่มี Active revision ให้ fallback จาก Active revision ของอีก locale.
- Fallback ใช้ slug ของ fallback locale Active revision ภายใต้ requested locale prefix.
- ห้ามใช้ Draft/Pending/Scheduled/Expired/Superseded/history slug เพื่อ public fallback routing.
- Fallback ต้องมี notice; Archive แล้วห้าม fallback.
## Security / Audit
- MFA: TOTP + Email OTP; Primary + Backup. Recovery = Backup method หรือ Admin reset เท่านั้น.
- Secure/HttpOnly/SameSite cookies, CSRF, password hashing, session regeneration, rate limit, prepared statements, upload validation.
- Audit เป็น append-only; Admin ก็แก้/ลบไม่ได้.
- Actor types: user / anonymous / system; failed login ใช้ anonymous + attempted principal.
- Audit workflow, auth, MFA, permission, archive/restore, activation/expiration และ emergency override.

## Identity / Audit Remediation Contract
- Accepted dependency order is `E0-S4 → E2-S1 → Identity follow-up work`; E0-S4 and E2-S1 are done, so the E2-S1 prerequisite is satisfied. The approved dependency/identity decisions remain unchanged.
- `users.id` is a PostgreSQL `BIGINT` generated identity; Audit `actor_user_id` uses `BIGINT`.
- Username and email are required and non-empty, trimmed before persistence, stored with trimmed entered case preserved, and case-insensitive for uniqueness and later authentication lookup.
- Account state is `is_active BOOLEAN NOT NULL DEFAULT TRUE`; deactivation preserves the User row and Audit linkage.
- E2-S1 creates nullable `actor_user_id` and enforces actor nullability rules. E1-S1 later adds the delete-restricting foreign key to `users.id`; subsequent application behavior cannot create user-actor rows for nonexistent Users.
## Current Workflow State
- E0-S4: done; implemented, independently reviewed, committed and pushed at `f7692362b72ae3409941f16e0f1f5570e23fada7`.
- E2-S1: done; implemented, verified, independently reviewed and remediated. Targeted Independent Re-review PASS; E2S1-REV-01 CLOSED; no remaining findings.
- E2-S1 completion commit: `7e15d4003c34937243d0d94b5866e9f57f6b4f84` (`feat: add E2-S1 audit write foundation`); committed, pushed and post-push verified with `HEAD == origin/main`.
- E1-S1 (`docs/epics/epic-1/story-s1.md`): done previously; do not reopen.
- Next implementation target: E1-S1b (`docs/epics/epic-1/story-s1b.md`), todo / NEXT / NOT STARTED; ready for its separate fresh-context Guided Development session. E2-S1 is satisfied; the other listed prerequisites remain part of that session's precondition verification.
## Scope Guardrails
- ห้ามเริ่ม Secondary/Stretch ก่อน Core Demo Gate ผ่าน.
- Search/Queue/Notification/Dashboard/Related Content ห้ามเป็น Core dependency.
- Category/Tag/Menu/SEO/Visual Diff ห้าม block Core publishing.
- เจอ requirement/architecture decision ใหม่ระหว่าง Dev: หยุดและกลับไปแก้ artifact ก่อน implement.

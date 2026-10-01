# Lean Spec: MOL CMS Demo

> Version: 0.4-remediation-candidate
> Status: Owner-approved remediation — targeted independent planning review PASS
> Validated baseline history: v0.3; dependency/identity remediation subsequently passed targeted independent review
> Flow: LEAN
> Project type: Personal learning / portfolio demo
> Target duration: ≤ 1 month
> Disclaimer: เป็นระบบจำลองเพื่อการเรียนรู้ ไม่ใช่ระบบอย่างเป็นทางการของกระทรวงแรงงาน

---

# 1. ปัญหา + ผู้ใช้ + ความสำเร็จ

## 1.1 Problem

โปรเจกต์นี้สร้างขึ้นเพื่อฝึกทักษะสองด้านพร้อมกัน:

1. Business / Product thinking สำหรับระบบ CMS ที่มี workflow และ business rules ใกล้เคียงระบบใช้งานจริง
2. การพัฒนา Web Application ด้วย PHP โดยไม่ใช้ Full-stack Framework เพื่อให้เข้าใจ HTTP lifecycle, routing, authentication, authorization, database, session, background processing, testing และ deployment

Domain ที่ใช้จำลองคือ **CMS สำหรับเว็บไซต์กระทรวงแรงงานหนึ่งเว็บไซต์**

ระบบต้องมีความสมจริงพอที่จะสาธิตกระบวนการตั้งแต่สร้าง Content จนถึงเผยแพร่ต่อประชาชน พร้อม Revision, Approval, Audit Trail และ Permission Control

## 1.2 Users

### Admin

รับผิดชอบ:

- User Management
- Role / Permission Management
- MFA Reset
- Audit Log
- Emergency Override
- การดูแลระบบโดยรวม

### Editor

รับผิดชอบ:

- สร้างและแก้ไข Content
- สร้าง Revision
- จัดการ Media / File
- Submit Content for Approval
- Withdraw งานที่ยังรอ Approval
- ขอ Archive / Restore

### Approver

รับผิดชอบ:

- Review Content
- ดู Revision Diff เมื่อ capability นี้ถูก implement
- Approve / Reject
- Review Archive / Restore Request
- ตรวจผลกระทบของ Shared Block เมื่อ capability นี้ถูก implement

Approver ไม่สามารถ Approve งานที่ตนเองเป็นผู้สร้างหรือเป็นผู้แก้ไขล่าสุดได้ ยกเว้นกรณี Admin ใช้ Emergency Override ตามกฎใน §8

---

# 2. Success Criteria

ภายใน 1 เดือน ระบบต้องสามารถ Demo core flow แบบ end-to-end ได้อย่างน้อยดังนี้:

Admin สร้าง User
→ Editor Login + MFA
→ Editor สร้าง Content
→ Save Draft
→ Submit for Approval
→ Approver Review
→ Approve
→ Content แสดงบน Public Website ตาม Display Window
→ Editor สร้าง Revision ใหม่
→ Approver Approve Revision ใหม่
→ Revision ใหม่ขึ้นแทน Revision เดิมตาม Activation Rule
→ Editor ขอ Archive / Restore
→ Approver อนุมัติ
→ Admin ตรวจ Audit Trail ย้อนหลังได้

ผู้พัฒนาต้องสามารถอธิบายได้ด้วยตนเองว่า:

- Business Rule หลักทำงานอย่างไร
- แต่ละ Module รับผิดชอบอะไร
- Request เดินผ่าน PHP Application อย่างไร
- Authentication / Session / Permission ทำงานอย่างไร
- Revision และ Approval ถูกเก็บอย่างไร
- PostgreSQL ถูกใช้งานอย่างไร
- Scheduled Processing ทำงานอย่างไร
- Audit Trail ถูกสร้างและตรวจสอบอย่างไร

---

# 3. Scope Priority

เพื่อรักษาเป้าหมาย ≤ 1 เดือน แบ่ง scope เป็น 3 ระดับ:

### Core Must

ต้องผ่านก่อนถือว่า Demo สำเร็จ:

Authentication
→ MFA
→ Authorization
→ Audit Write/Read
→ Content
→ Revision
→ Approval
→ Publication Activation
→ Scheduling / Expiration
→ Archive / Restore
→ Multilingual Core
→ Public Rendering
→ Online Deployment

### Secondary / Should

ทำหลัง Core Must หาก capacity ยังเหลือ:

- Advanced Media Library
- Category Tree
- Tag Master
- Menu Builder
- SEO Metadata
- Revision Visual Diff

### Stretch

ทำเฉพาะเมื่อ Core + Secondary ที่เลือกไว้เสร็จ:

- Shared Blocks
- Notification
- Background Job Queue
- Dashboard
- Related Content
- Public Search

---

# 4. Functional Requirements

| ID | Requirement | Priority |
|---|---|---|
| FR-01 | ระบบต้องรองรับ User Role: Admin, Editor, Approver | Must |
| FR-02 | Admin ต้องสามารถสร้าง แก้ไข ปิดใช้งาน User และกำหนด Role ได้ | Must |
| FR-03 | ระบบต้องรองรับ Permission ราย User แบบ Allow / Deny เพิ่มเติมจาก Role | Must |
| FR-04 | Normal permission precedence ต้องเป็น User Deny > User Allow > Role Permission > Default Deny | Must |
| FR-05 | CMS ต้อง Login ด้วย Username/Email + Password + MFA | Must |
| FR-06 | MFA ต้องรองรับ TOTP และ Email OTP โดยกำหนด Primary + Backup Method ได้ | Must |
| FR-07 | Admin สามารถ Reset MFA ได้ และต้องถูก Audit | Must |
| FR-08 | ระบบต้องรองรับ Page, News, Announcement และ Banner โดยใช้ Content model ร่วมและแยกด้วย Content Type | Must |
| FR-09 | ระบบต้องรองรับ Media/File ขั้นพื้นฐานสำหรับ Content | Must |
| FR-10 | Editor สามารถ Draft → Submit for Approval ได้ | Must |
| FR-11 | Pending Approval สามารถ Approve / Reject / Withdraw ได้ | Must |
| FR-12 | Editor Withdraw ได้เฉพาะก่อนมี Approve / Reject decision | Must |
| FR-13 | Reject ต้องเลือก Standard Reason และสามารถเพิ่มข้อความอธิบายได้ | Must |
| FR-14 | Published Content ห้ามแก้ไข Revision ที่กำลังเผยแพร่โดยตรง ต้องสร้าง Revision ใหม่ | Must |
| FR-15 | Approved Revision ใหม่ต้องแทนที่ Revision เดิมตาม Publication Activation Rule ใน §6 | Must |
| FR-16 | Approver สามารถเห็น Visual Diff ระหว่าง Revision ใหม่กับ Published Revision | Should |
| FR-17 | Revision สามารถกำหนด Display From และ Display Until ได้ | Must |
| FR-18 | Approval ไม่ได้แปลว่า Revision ต้องขึ้น Public ทันที การขึ้น Public ต้องเป็นไปตาม Activation Rule | Must |
| FR-19 | เมื่อ Active Public Revision เลย Display Until และไม่มี Revision ถัดไปที่พร้อม Activate ให้ Locale เปลี่ยนเป็น Expired | Must |
| FR-20 | การ Archive เป็น Content-level action และต้องผ่าน Approval | Must |
| FR-21 | Archived Content สามารถ Restore ผ่าน Approval ได้ | Must |
| FR-22 | Admin ที่มี `EmergencyOverride.Execute` สามารถ Break-glass Approval Action ได้ | Must |
| FR-23 | Emergency Override ต้องบังคับกรอกเหตุผลและ Audit ทุกครั้ง | Must |
| FR-24 | Normal Approver ห้าม Approve Content ที่ตนเองเป็นผู้สร้างหรือแก้ไขล่าสุด | Must |
| FR-25 | Content รองรับ TH และ EN โดยแต่ละ Locale มี Revision / Approval lifecycle แยกกัน | Must |
| FR-26 | Public URL ใช้ prefix `/th/...` และ `/en/...` | Must |
| FR-27 | Slug เป็น Revision-level localized data; เมื่อ Locale มี Active Revision ให้ Active Revision นั้นเป็น canonical source ของ public slug | Must |
| FR-28 | ถ้า requested Locale ไม่มี Active Public Revision แต่ fallback Locale มี Active Revision ระบบต้อง resolve fallback โดยใช้ Active Revision slug ของ fallback Locale ภายใต้ requested Locale prefix และแสดง fallback content โดยไม่ Redirect | Must |
| FR-29 | ระบบต้องแจ้งผู้ใช้เมื่อกำลังแสดง Fallback Language | Must |
| FR-30 | SEO Title, Meta Description, Open Graph และ Social Image รองรับแยก TH / EN | Should |
| FR-31 | SEO Title ที่ว่างสามารถ fallback จาก Content Title | Should |
| FR-32 | Editor / Approver สามารถ Preview Draft/Pending Revision ได้โดย Public User เข้าไม่ได้ | Must |
| FR-33 | Page Content รองรับ Block-based Editor | Must |
| FR-34 | Core block ขั้นต้นประกอบด้วย Rich Text, Image, Download และ CTA; Hero/Gallery สามารถเพิ่มเป็น Secondary | Must |
| FR-35 | Block สามารถเพิ่ม ลบ และเรียงลำดับได้ | Must |
| FR-36 | ระบบรองรับ Shared Block ที่สร้างครั้งเดียวและอ้างอิงจากหลายหน้า | Stretch |
| FR-37 | Shared Block ที่ Published แล้วต้องใช้ Revision + Approval | Stretch |
| FR-38 | ก่อน Approve Shared Block ต้องแสดง Usage Impact | Stretch |
| FR-39 | Media ขั้นพื้นฐานต้องมี Alt Text, Caption, Metadata และ Usage Reference; Folder/Tag เป็น Secondary | Must |
| FR-40 | Media/File ที่ยังถูก Content อ้างอิงอยู่ห้ามลบ | Must |
| FR-41 | Category รองรับ Tree หลายระดับ | Should |
| FR-42 | Content หนึ่งรายการสามารถอยู่หลาย Category ได้ | Should |
| FR-43 | Tag เป็น Flat Taxonomy และเลือกจาก Tag Master | Should |
| FR-44 | Related Content แนะนำจาก Category/Tag และ Editor Pin เองได้ | Stretch |
| FR-45 | Menu รองรับ Internal Link, External URL, File Download และ Parent Heading | Should |
| FR-46 | Menu รองรับ Parent/Child Tree | Should |
| FR-47 | Public Site ต้องมี Home, Content Listing และ Content Detail ที่เพียงพอสำหรับ Core Demo | Must |
| FR-48 | Public Site รองรับ Search / Filter | Stretch |
| FR-49 | Search ฝั่ง EN สามารถพบ TH fallback content ได้ | Stretch |
| FR-50 | CMS Dashboard แสดง Content Status, Pending Approval และ Activity | Stretch |
| FR-51 | ระบบมี In-app และ Email Notification | Stretch |
| FR-52 | Notification รองรับ unread/read และ link กลับไปยัง resource | Stretch |
| FR-53 | Audit Trail ต้องเป็น Append-only | Must |
| FR-54 | ไม่มี Role ใดรวมถึง Admin สามารถแก้หรือลบ Audit Log ได้ | Must |
| FR-55 | Admin สามารถ Search / Filter / Export Audit Log ได้ | Must |
| FR-56 | Audit ต้องครอบคลุม Login, MFA, Permission, Content, Approval, Archive, Restore และ Override | Must |
| FR-57 | Audit Log ไม่มี Automatic Purge ใน Demo Scope | Must |

---

# 5. Ownership Model

| Concept | Ownership | Rule |
|---|---|---|
| Content ID | Content-level | ตัวตนหลักของ resource |
| Content Type | Content-level | Page / News / Announcement / Banner |
| Archive / Restore State | Content-level | Archive แล้วทุก Locale ถูกซ่อนจาก Public |
| Locale | Locale-level | TH / EN |
| Active Public Revision Pointer | Locale-level | ชี้ Revision ที่ Public ใช้งานอยู่ |
| Publication State | Locale-level | Unpublished / Scheduled / Live / Expired |
| Revision Workflow State | Revision-level | Draft / Pending Approval / Approved Scheduled / Active / Rejected / Superseded |
| Title | Revision-level | แยก TH / EN |
| Slug | Revision-level | Active Revision ของ Locale เป็น canonical public slug; ถ้า requested Locale ไม่มี Active Revision และใช้ language fallback ให้ใช้ slug ของ fallback Locale's Active Revision ภายใต้ requested Locale prefix |
| SEO Metadata | Revision-level | แยกตาม Locale / Revision |
| Display From | Revision-level | กำหนด earliest activation time |
| Display Until | Revision-level | กำหนด public expiry time |
| Blocks | Revision-level | JSONB snapshot |
| Approval Decision | Revision-level | ผูกกับ Revision ที่ถูก Review |

Archive เป็น **Content-level action** เสมอ

ถ้า Content ถูก Archive:

- TH และ EN ไม่แสดงบน Public Site
- Revision history ยังอยู่
- Locale lifecycle ไม่ถูกลบ

เมื่อ Restore:

- Content กลับเป็น Active
- แต่แต่ละ Locale จะแสดงได้เฉพาะเมื่อมี Active/Approved Revision ที่ยังอยู่ใน Display Window
- Restore ไม่ทำให้ Revision ที่ Expired กลับมา Public อัตโนมัติ

---

# 6. Publication & Revision State Machine

## 6.1 Main Revision Workflow

Draft
→ Pending Approval
→ Approved Scheduled / Active

Alternate:

Pending Approval
→ Withdraw
→ Draft

Pending Approval
→ Reject
→ Draft

Active
→ Superseded เมื่อ Revision ใหม่ Activate

## 6.2 Approval vs Activation

**Approval** และ **Public Activation** เป็นคนละเหตุการณ์

ตัวอย่าง:

Revision A กำลัง Active และแสดงบน Public Site

Revision B ถูก Approve วันที่ 24 ก.ย.

แต่:

`Display From = 1 ต.ค. 08:00`

ผลคือ:

24–30 ก.ย.
→ Revision A ยังเป็น Active Public Revision

Revision B
→ `Approved Scheduled`

เมื่อถึง 1 ต.ค. 08:00:

Revision B
→ `Active`

Revision A
→ `Superseded`

ระบบจึงไม่ทำให้ Content หายจาก Public Site เพียงเพราะ Revision ใหม่ถูก Approve ล่วงหน้า

## 6.3 Immediate Activation

ถ้า Revision ได้รับ Approve และ:

`Display From <= current time`

และ:

`Display Until > current time`

Revision ใหม่สามารถ Activate ทันที

Active Revision เดิมจะกลายเป็น Superseded

## 6.4 Expiration

เมื่อ Active Revision ผ่าน `Display Until`:

- Revision นั้นไม่แสดงบน Public อีก
- ถ้ามี Approved Scheduled Revision ที่ถึง Display From แล้ว ให้ Activate Revision นั้น
- ถ้าไม่มี Revision ถัดไปที่ eligible ให้ Locale Publication State = `Expired`

Content identity ยังไม่ถูก Archive

Expired Locale สามารถ:

- สร้าง Revision ใหม่
- Submit / Approve Revision ใหม่
- กลับมา Live เมื่อ Revision ใหม่ Activate
- เข้า Content-level Archive flow ได้

## 6.5 Pending Future Revision Constraint

เพื่อจำกัด complexity ของ Demo v1:

หนึ่ง Locale สามารถมี **Approved Scheduled Revision ที่ยังไม่ Activate ได้สูงสุด 1 Revision**

เมื่อ Locale มี Approved Scheduled Revision อยู่แล้ว:

- ห้าม Approve future revision ตัวใหม่ของ Locale เดียวกัน
- Approved Scheduled Revision ต้องรอจนถึง `Display From` และ Activate ตามปกติ
- Demo v1 **ไม่รองรับ Withdraw หรือ Cancel หลัง Revision ได้รับ Approval แล้ว**
- `Withdraw` รองรับเฉพาะสถานะ `Pending Approval`
- `Superseded` เกิดเฉพาะกับ Active Revision เดิม เมื่อ Revision ใหม่ Activate

ดังนั้น transition ที่รองรับคือ:

`Draft → Pending Approval → Approved Scheduled → Active`

หรือ:

`Draft → Pending Approval → Active`

และ:

`Pending Approval → Withdraw → Draft`

`Pending Approval → Reject → Draft`

`Active → Superseded`

ไม่มี transition:

`Approved Scheduled → Withdraw`

หรือ:

`Approved Scheduled → Superseded`

ใน Demo v1

---

# 7. Display Lifecycle

Publication State ระดับ Locale:

`Unpublished → Scheduled → Live → Expired`

ตัวอย่าง:

Revision ถูก Approve วันที่ 24 ก.ย.

Display From:

1 ต.ค. 08:00

Display Until:

15 ต.ค. 23:59

ถ้าไม่มี Active Revision เดิม:

24 ก.ย. – 30 ก.ย.
→ Locale = Scheduled
→ ยังไม่แสดงบน Public

1 ต.ค. 08:00
→ Locale = Live

หลัง 15 ต.ค. 23:59
→ Locale = Expired

ถ้ามี Active Revision เดิมอยู่ ให้ใช้กฎ §6.2 และ Revision เดิมยังแสดงจน Revision ใหม่ Activate

---

# 8. Authorization & Emergency Override

## 8.1 Normal Permission Evaluation

Normal permission ใช้ precedence:

1. User-specific Deny
2. User-specific Allow
3. Role Permission
4. Default Deny

Permission อยู่ในรูป:

`Resource.Action`

ตัวอย่าง:

- News.Create
- News.Edit
- News.Submit
- Content.Approve
- Content.Archive
- Media.Upload
- User.Manage
- Audit.View

## 8.2 Emergency Override Permission

Emergency Override ใช้ permission แยก:

`EmergencyOverride.Execute`

เฉพาะ User ที่:

- มี Role = Admin
- และผ่าน normal permission evaluation ของ `EmergencyOverride.Execute`

จึงใช้ Break-glass ได้

ดังนั้นถ้า Admin ถูกกำหนด:

`User-specific Deny: EmergencyOverride.Execute`

Admin คนนั้นจะใช้ Override ไม่ได้

## 8.3 Break-glass Semantics

เมื่อผ่าน `EmergencyOverride.Execute` แล้ว Emergency Override สามารถ bypass:

- normal approval permission ของ action นั้น
- self-approval restriction
- normal Approver requirement

แต่ไม่ bypass:

- mandatory reason
- audit logging
- input validation
- transaction integrity

ทุก Emergency Override ต้องเก็บ:

- Admin ผู้ใช้งาน
- Action
- Target
- Timestamp
- Reason
- Before / After
- Correlation / Request information

---

# 9. MFA Rules

ระบบรองรับ:

- TOTP
- Email OTP

ผู้ใช้กำหนด:

- Primary MFA Method
- Backup MFA Method

คำว่า **MFA Recovery** ใน Demo v1 หมายถึงเพียง:

1. ใช้ Backup MFA Method ที่ลงทะเบียนไว้
2. หรือ Admin MFA Reset

Demo v1 **ไม่ทำ**:

- Recovery Codes
- Dedicated Lost-device Recovery Workflow
- Identity Proofing Process ภายนอก

Admin MFA Reset ต้องถูก Audit

---

# 10. Multilingual Rules

แต่ละ Locale มี Revision และ Workflow ของตนเอง

ตัวอย่างที่ valid:

| TH | EN |
|---|---|
| Live | Draft |
| Live | Pending Approval |
| Expired | Live |

TH และ EN ไม่ต้อง Approve พร้อมกัน

## 10.1 Fallback

เมื่อ request อยู่ใน locale ที่ร้องขอ เช่น:

`/en/...`

ระบบพิจารณาตามลำดับ:

1. ถ้า EN มี Active Public Revision และ slug ตรงกับ request → แสดง EN
2. ถ้า EN ไม่มี Active Public Revision แต่ TH มี Active Public Revision → ระบบอนุญาต fallback เฉพาะเมื่อ request slug ตรงกับ **TH Active Revision slug**
3. เมื่อ fallback สำเร็จ → render TH Active Revision พร้อม Fallback Notice
4. requested locale prefix ยังคงเป็น `/en/`
5. ถ้าทั้ง EN และ TH ไม่มี Active Public Revision → ไม่แสดง Content

ตัวอย่าง:

TH Active Revision:

`slug = ค่าแรงขั้นต่ำ`

Canonical TH URL:

`/th/news/ค่าแรงขั้นต่ำ`

EN ไม่มี Active Revision

Fallback URL:

`/en/news/ค่าแรงขั้นต่ำ`

จะ render TH Active Revision พร้อมข้อความแจ้งว่า English version ยังไม่มีและกำลังแสดงภาษาไทยแทน

### Fallback Route Constraint

Demo v1 ไม่ใช้ Draft, Pending, Scheduled, Expired, Superseded หรือ historical revision เพื่อ resolve fallback URL

ดังนั้น public route resolution มี source เดียวที่ deterministic:

**Active Revision ของ requested locale หรือ Active Revision ของ fallback locale**

## 10.2 Archive Interaction

เพราะ Archive เป็น Content-level:

ถ้า Content ถูก Archive
→ ทั้ง `/th/...` และ `/en/...` ต้องไม่แสดง

จึงไม่มีกรณี EN ถูก Archive แยกจาก TH ใน Demo v1

---

# 11. Media / File Rules

Core Must รองรับ:

- Upload
- Basic metadata
- Alt Text
- Caption
- Usage Reference
- Deletion protection

Asset ที่ยังถูก Content อ้างอิงอยู่:

→ ห้ามลบ

ระบบต้องสามารถบอกได้ว่า asset ถูกใช้อยู่ที่ Content ใด

Secondary capability:

- Folder
- Asset Tag
- Advanced Media Organization

---

# 12. Audit Rules

Audit Log เป็น Append-only

ไม่มี Role ใด รวมถึง Admin สามารถ:

- Edit
- Delete
- Rewrite

Audit record อย่างน้อยประกอบด้วย:

- Actor Type
- Actor User ID ถ้ามี
- Attempted Principal ถ้ามี
- Action
- Target Type
- Target ID
- Timestamp
- Before / After ที่เหมาะสม
- Reason ถ้ามี
- Request / Correlation information

## 12.1 Actor Types

รองรับ:

### `user`

ใช้เมื่อ request มี authenticated user

`actor_user_id` ต้องมีค่า

### `anonymous`

ใช้กับเหตุการณ์ก่อน authentication เช่น failed login

`actor_user_id = null`

และสามารถเก็บ:

`attempted_principal = username/email ที่ใช้พยายาม login`

### `system`

ใช้กับ:

- Scheduler
- Expiration process
- System-maintenance action

`actor_user_id = null`

## 12.2 Required Audit Events

อย่างน้อย:

- Login success
- Login failure
- MFA setup
- Backup MFA usage
- MFA reset
- User activation/deactivation
- Role / Permission change
- Content create/edit
- Revision creation
- Submit
- Withdraw
- Approve
- Reject
- Revision activation
- Expiration
- Archive
- Restore
- Emergency Override
- Media/File management

Audit Log ไม่มี Automatic Purge ใน Demo v1

---

# 13. Non-Functional Requirements

## NFR-01 — Accessibility

Public Website ตั้งเป้า:

**WCAG 2.2 Level AA**

Core verification ครอบคลุม:

- Semantic HTML
- Keyboard Navigation
- Visible Focus
- Form Labels
- Alt Text
- Color Contrast
- Screen-reader friendly structure

## NFR-02 — Performance

Target:

- Public Website p95 ≤ 500 ms
- CMS p95 ≤ 800 ms

วัดบน **Designated Demo Environment**

### Fixed Demo Dataset

อย่างน้อย:

- 1,000 Content identities
- TH/EN data ตาม fixture ที่กำหนด
- Revision history หลาย revision สำหรับชุดทดสอบ
- Category/Tag ไม่จำเป็นต้องเปิดใช้ถ้ายังอยู่ Secondary scope

### Public Test Profile

- 10 concurrent virtual users
- Warm application
- Test duration อย่างน้อย 5 นาที
- Request mix:
  - 20% Homepage
  - 40% Content Listing
  - 40% Content Detail

Search ไม่รวมใน Core performance gate เพราะเป็น Stretch

### CMS Test Profile

- 5 concurrent authenticated virtual users
- Warm application
- Test durationอย่างน้อย 5 นาที
- Request mix:
  - Content list
  - Content detail
  - Edit form load
  - Core workflow request ตาม fixture ที่กำหนด

External Email latency ไม่รวมใน p95 target

## NFR-03 — Security

ระบบต้องใช้:

- Secure Cookie
- HttpOnly
- SameSite
- CSRF Protection
- Secure Password Hashing
- Session ID Regeneration
- Login Rate Limiting
- OTP Rate Limiting
- Prepared Statements / Parameter Binding
- File Upload Validation
- Authorization ทุก protected operation
- MFA
- Output Escaping

Final Security Gate ใช้ fixed checks:

1. `composer audit`
2. OWASP ZAP baseline scan ต่อ deployed Demo
3. Project security checklist สำหรับ:
   - Authentication
   - Session
   - Authorization
   - CSRF
   - File Upload
   - XSS / Output Escaping
   - SQL Injection
   - Emergency Override
4. ไม่มี unresolved finding ระดับ High / Critical ก่อน Final Demo

---

# 14. Architecture Sketch

## 14.1 Architecture Style

**Layered Modular Monolith**

Application เดียว Deploy เดียว

แยก Module ตาม Business Capability

Request flow:

Browser
→ Nginx
→ PHP-FPM
→ `public/index.php`
→ Router
→ Controller
→ Application Service
→ Domain / Repository
→ PostgreSQL
→ Twig
→ HTML Response

---

# 15. Modules

## Identity & Access

รับผิดชอบ:

- User
- Role
- Permission
- Password
- Session
- MFA
- Authentication
- Authorization
- Emergency Override eligibility

### Identity Schema Contract — Reviewed Remediation

The following owner-approved contract passed targeted independent planning review. Its approved decisions are unchanged by the current status synchronization:

- `users.id` is a PostgreSQL `BIGINT` generated identity primary key.
- Username and email are both required and non-empty.
- Username and email are trimmed before persistence; the trimmed entered value, including letter case, is preserved.
- Username and email uniqueness and later authentication lookup are case-insensitive using the same normalization semantics.
- Account state is persisted as `is_active BOOLEAN NOT NULL DEFAULT TRUE`.
- Deactivation changes `is_active` and never deletes the User identity. Historical deactivation timing belongs to Audit once the audited mutation is implemented.
- Demo v1 has exactly one Core Role per User. Core Role identities are Admin, Editor and Approver; multi-role users are outside Demo v1 unless a future validated artifact changes this contract.
- Role identities are persisted in `roles`; every User has a non-null `users.role_id` foreign key. E1-S1 owns Role identity and association schema only; permissions and grants remain owned by later authorization stories.
- Audit `actor_user_id` uses the same `BIGINT` scalar type as `users.id`. E2-S1 may create the nullable column before `users` exists; E1-S1 completes the foreign key with delete-restricting semantics.
- Audit actor rules remain: `user` requires `actor_user_id`; `anonymous` and `system` require it to be null. After E1-S1, application behavior must not create user-actor Audit rows for nonexistent Users.

## Content

รับผิดชอบ:

- Content identity
- Content Type
- Locale
- Revision
- Block Snapshot
- SEO Metadata
- Public Revision Pointer

## Workflow

รับผิดชอบ:

- Submit
- Withdraw
- Approve
- Reject
- Activation
- Archive
- Restore
- Emergency Override execution

## Media

รับผิดชอบ:

- Image/File
- Metadata
- Usage Reference
- Storage abstraction

## Taxonomy

Secondary capability:

- Category
- Tag

## Menu

Secondary capability:

- Menu Tree
- Link Types

## Notification

Stretch:

- In-app Notification
- Email Notification
- Notification jobs

## Audit

รับผิดชอบ:

- Append-only Audit write
- Audit query/read/export

## Public Site

รับผิดชอบ:

- Public Rendering
- Locale fallback
- Preview
- Public URL resolution
- Optional Search

---

# 16. Technical Stack

Core:

- PHP 8.5
- Composer
- PostgreSQL
- PDO
- Twig
- Lightweight Router
- PHPUnit
- Nginx
- PHP-FPM
- Docker Compose
- Server-side Session

Core ไม่ใช้:

- Laravel
- Symfony Full Stack
- ORM
- JWT สำหรับ CMS Session
- Redis
- RabbitMQ
- Elasticsearch / OpenSearch

PostgreSQL-backed Job Queue เป็น **Stretch infrastructure** ไม่ใช่ Core dependency

---

# 17. Data Access

ใช้:

**PDO + Handwritten SQL ใน Repository**

กติกา:

- Controller ห้ามมี SQL
- Application Service ห้ามมี SQL
- SQL อยู่ใน Repository / Infrastructure
- User input ต้องใช้ parameter binding
- Use Case ที่เปลี่ยนหลาย aggregate/repository ต้องใช้ Database Transaction

---

# 18. Dependency Injection

ใช้:

**Manual Constructor Injection**

Bootstrap ประกอบ dependency graph เช่น:

PDO
→ Repository
→ Application Service
→ Controller

ห้ามใช้:

- Global dependency
- Service Locator
- Class สร้าง Database Connection เอง
- DI Container ใน Demo v1

---

# 19. View Layer

ใช้ Twig

Twig รับผิดชอบ:

- Layout
- Template inheritance
- Partial / Component
- Escaped Output

Business Logic ต้องไม่อยู่ใน Template

---

# 20. Authentication Architecture

ใช้ **Server-side Session**

Flow:

Password Authentication
→ MFA Verification
→ Regenerate Session ID
→ Authenticated Session
→ Authorization Context

Browser เก็บเฉพาะ Session Cookie

ไม่ใช้ JWT สำหรับ CMS

---

# 21. Content Data Model Strategy

ใช้:

**Hybrid Relational + JSONB**

Relational สำหรับ:

- Content identity
- Locale
- Revision metadata
- Workflow state
- Public Revision Pointer
- Media Reference
- Approval History
- Audit Log
- Category/Tag เมื่อเปิดใช้ Secondary scope

JSONB สำหรับ:

- Block Editor Snapshot

แต่ละ Revision มี Block Snapshot ของตนเอง

Active Revision ห้ามถูกแก้โดยตรง

---

# 22. File Storage

ใช้ Storage Abstraction

ตัวอย่าง:

`StorageInterface`

Core Implementation:

`LocalStorage`

อนาคตสามารถเพิ่ม:

- S3
- MinIO
- S3-compatible provider

Business Logic ห้ามผูกกับ filesystem path โดยตรง

---

# 23. Search

Public Search เป็น **Stretch**

เมื่อทำ Stretch ใช้:

**PostgreSQL Full-Text Search**

Search Target:

- Title
- Content
- Category
- Tag

ยังไม่ใช้ Elasticsearch / OpenSearch

---

# 24. Scheduled Processing & Queue

## 24.1 Core Scheduler

Core Must **ไม่พึ่ง Job Queue**

Expiration ใช้:

Cron / Scheduler
→ PHP CLI Command
→ PostgreSQL transaction/update

ตัวอย่าง command concept:

`php bin/console content:expire`

หรือ equivalent CLI entry point ที่โปรเจกต์กำหนด

Scheduler รับผิดชอบ:

- ตรวจ Active Revision ที่เลย Display Until
- Activate eligible Scheduled Revision
- เปลี่ยน Locale เป็น Expired เมื่อไม่มี Revision ถัดไป

ดังนั้น Scheduler สามารถทำงานได้ก่อนมี Background Queue

## 24.2 Stretch Job Queue

PostgreSQL-backed Job Queue ทำเฉพาะ Stretch เช่น:

- Email Notification
- Notification processing
- Retryable asynchronous jobs

Job State:

- pending
- processing
- completed
- failed

รองรับ:

- Retry Count
- Last Error
- Scheduled Time

---

# 25. Database Migration

ใช้ SQL Migration Files เช่น:

`001_create_users.sql`

`002_create_permissions.sql`

`003_create_contents.sql`

Custom PHP Migration Runner จะ:

1. อ่าน migration files
2. ตรวจ `schema_migrations`
3. รันเฉพาะ migration ที่ยังไม่เคยรัน
4. ใช้ transaction เมื่อ PostgreSQL operation รองรับ
5. บันทึก migration ที่สำเร็จ

ไม่ใช้ Framework Migration Tool

---

# 26. Testing Strategy

ใช้ PHPUnit

## Unit Tests

เน้น:

- Permission precedence
- Emergency Override permission
- Self-approval prevention
- Approval transition
- Future activation
- Revision replacement
- Expiration
- Withdraw
- Archive / Restore
- Locale fallback

## Integration Tests

ใช้ PostgreSQL จริงสำหรับ:

- Repository
- Migration
- Transaction
- Revision activation
- Scheduler
- Audit persistence

## HTTP / Feature Tests

Core flow เช่น:

Login
→ MFA
→ Create Content
→ Submit
→ Approve
→ Activate
→ Public Render
→ New Revision
→ Archive / Restore
→ Audit inspection

ทุก Story ต้องผ่าน deterministic tests ที่เกี่ยวข้องก่อน Review Gate

---

# 27. Deployment

Core Docker Compose services **by completion of the Core Must scheduler flow**:

- nginx
- php-fpm
- postgres
- scheduler

Story ownership:

- E0-S2 establishes the initial Docker Compose runtime with `nginx`, `php-fpm`, and `postgres` only.
- E4-S5 introduces the `scheduler` Compose/runtime integration together with the direct PHP CLI scheduler behavior defined in §24.1.
- No scheduler service shell or scheduler behavior is required before E4-S5.
- The Core scheduler remains independent of the Stretch Job Queue per D-23.

Local File Storage ใช้ Docker Volume

ถ้า Stretch Queue ถูก implement เพิ่ม:

- worker

Demo ต้อง Deploy ออนไลน์ได้อย่างน้อย 1 Environment

---

# 28. Key Decisions

| ID | Decision | เลือก | เหตุผล |
|---|---|---|---|
| D-01 | Workflow Type | LEAN | หลาย module + audit แต่ project ≤1 เดือน |
| D-02 | PHP Framework | No Full Framework | เป้าหมายคือเรียนรู้ PHP internals |
| D-03 | Architecture | Layered Modular Monolith | แยก capability โดยไม่เพิ่ม distributed complexity |
| D-04 | Database | PostgreSQL | Relational + JSONB + future FTS |
| D-05 | Data Access | PDO + handwritten SQL | เห็น persistence behavior ชัด |
| D-06 | Frontend | Server-rendered PHP | เน้น PHP มากกว่า SPA infrastructure |
| D-07 | Template | Twig | Escaping/layout โดยไม่ใช้ full framework |
| D-08 | DI | Manual Constructor Injection | ทำให้ dependency graph ชัด |
| D-09 | Authentication | Server-side Session | เหมาะกับ server-rendered CMS |
| D-10 | MFA | TOTP + Email OTP | Primary + Backup; recovery = backup/reset |
| D-11 | Content Storage | Relational + JSONB | Metadata/query relational, block snapshot flexible |
| D-12 | File Storage | Storage abstraction | Local ก่อน รองรับ S3-compatible ภายหลัง |
| D-13 | Search | PostgreSQL FTS | Stretch; ไม่เพิ่ม search infrastructure |
| D-14 | Queue | PostgreSQL-backed | Stretch เท่านั้น; Core scheduler ไม่พึ่ง queue |
| D-15 | Migration | Custom SQL runner | ฝึก schema และ PHP CLI |
| D-16 | Audit | Append-only | ประวัติตรวจสอบย้อนหลังได้ |
| D-17 | Published Editing | Revision only | ป้องกัน live content ถูกแก้ตรง |
| D-18 | Approval | Separation of Duties | Normal Approver ห้าม approve งานตัวเอง |
| D-19 | Emergency Flow | Explicit Break-glass Permission | Bypass approval/self-approval ได้เมื่อมี permission + reason + audit |
| D-20 | Localization | Independent TH/EN lifecycle | ไม่บังคับ translation พร้อมกัน |
| D-21 | Revision Activation | Approval ≠ Activation | Revision เดิมแสดงต่อจน Revision ใหม่ถึง Display From |
| D-22 | Archive Ownership | Content-level | Archive/Restore กระทบทุก Locale |
| D-23 | Expiration Execution | Direct Scheduler | Must flow ไม่ขึ้นกับ Stretch Queue |

## 28.1 Owner-Approved Remediation Decisions — Independent Review PASS

These decisions amend the v0.3 planning baseline and have passed targeted independent re-review. The original dependency/identity decisions below are retained; current execution status is recorded in §34.

| ID | Decision | Owner-approved decision | Consequence |
|---|---|---|---|
| R-IDENT-01 | User identifier | PostgreSQL `BIGINT` generated identity | Audit `actor_user_id` uses the same scalar type |
| R-IDENT-02 | Login principals | Username and email are required, non-empty, trimmed before persistence, case-preserving in storage, and case-insensitive for uniqueness/lookup | Duplicate case variants are rejected; later authentication must use identical comparison semantics |
| R-IDENT-03 | Account state | `is_active BOOLEAN NOT NULL DEFAULT TRUE` | Deactivation preserves the User row; timing is represented by later Audit events |
| R-IDENT-04 | Role model | Exactly one Admin, Editor or Approver Role per User | `roles` plus non-null `users.role_id`; no Demo v1 multi-role behavior |
| R-IDENT-05 | Audit linkage | E2-S1 creates nullable `actor_user_id BIGINT`; E1-S1 adds a delete-restricting FK to `users.id` | E2-S1 precedes E1-S1 without losing final referential integrity |
| R-ORDER-01 | Foundation order | `E0-S4 → E2-S1 → E1-S1` | Planning review PASS; E0-S4 and E2-S1 are done and the Audit prerequisite for Identity follow-up work is satisfied. E1-S1 was completed previously; the next target is E1-S1b |

---

# 29. Revised Story Roadmap

Current execution checkpoint: E0-S4 and E2-S1 are done; E1-S1 was completed previously. The next separate Guided Development target is E1-S1b at `docs/epics/epic-1/story-s1b.md` (todo / NEXT / NOT STARTED). E2-S1 is satisfied; retain and verify the other prerequisites listed in that Story. The approved dependency order remains `E0-S4 → E2-S1 → Identity follow-up work`.

Story ด้านล่างยังเป็น planning-level roadmap ต้องถูก Scrum Master สร้างเป็น self-contained story files ก่อน Dev

แต่ละ story ต้องมุ่งให้ใกล้เคียงหนึ่ง focused session

## Core Must

### E0-S1 — PHP Project Skeleton

สร้าง Composer project, folder structure, front controller และ bootstrap ขั้นต่ำ

### E0-S2 — Docker Runtime

สร้าง Docker Compose สำหรับ Nginx + PHP-FPM + PostgreSQL

### E0-S3 — Configuration & PDO

สร้าง environment config และ PostgreSQL PDO connection

### E0-S4 — SQL Migration Runner

Status: done — independently reviewed, committed and pushed at `f7692362b72ae3409941f16e0f1f5570e23fada7`.

สร้าง `schema_migrations` และ custom migration CLI

### E2-S1 — Audit Write Foundation

Status: done — Independent Review PASS after targeted remediation; E2S1-REV-01 CLOSED; committed, pushed and post-push verified at `7e15d4003c34937243d0d94b5866e9f57f6b4f84`.

สร้าง append-only Audit writer และ Actor model

### E1-S1 — User Identity Model

Status: done previously — retained as completed; E1-S1b is the next implementation target.

สร้าง User persistence, account active/inactive state, Core Role identity/association schema และ complete Audit user linkage

### E1-S2 — Password Authentication

สร้าง password login, hashing, failed-login handling

### E1-S3 — Server-side Session Lifecycle

สร้าง login session, regeneration, logout และ secure cookie

### E1-S4 — TOTP MFA

เพิ่ม TOTP enrollment / verification

### E1-S5 — Email OTP Backup & MFA Reset

เพิ่ม Email OTP backup และ Admin reset

### E1-S6 — Role Permissions

สร้าง Role Permission และ default deny

### E1-S7 — User Permission Overrides

เพิ่ม User Allow/Deny precedence

### E2-S2 — Audit Admin Query

สร้าง Audit list/filter/detail

### E2-S3 — Audit Export

เพิ่ม Audit export ขั้นพื้นฐาน

### E3-S1 — Content Identity

สร้าง Content identity + Content Type ร่วมสำหรับ Page/News/Announcement/Banner

### E3-S2 — Locale Foundation

สร้าง TH/EN locale records และ locale publication state

### E3-S3 — Revision Persistence

สร้าง Revision metadata และ JSONB block snapshot

### E3-S4 — Core Block Editor

รองรับ core block types และ ordering

### E4-S1 — Draft & Submit Workflow

สร้าง Draft → Pending Approval

### E4-S2 — Withdraw & Reject

เพิ่ม Withdraw และ Reject reason

### E4-S3 — Approval & Separation of Duties

เพิ่ม Approve และ self-approval prevention

### E4-S4 — Revision Activation

เพิ่ม Active Revision Pointer, Scheduled Activation และ Supersede rule

Semantic constraint:

- requested locale มี Active Revision → ใช้ requested locale Active Revision slug
- requested locale ไม่มี Active Revision แต่ fallback locale มี → ใช้ fallback locale Active Revision slug ภายใต้ requested locale prefix
- ห้ามใช้ inactive/historical revision slug เพื่อ resolve fallback

Demo v1 ไม่รองรับ cancellation หลัง approval:

- ห้าม Approve scheduled revision ตัวถัดไปของ locale เดียวกันเมื่อมี Approved Scheduled Revision อยู่
- Scheduled Revision ต้อง Activate ตาม `Display From`
- Withdraw ใช้ได้เฉพาะ Pending Approval
- Superseded ใช้กับ Active Revision ที่ถูก Active Revision ใหม่แทนที่เท่านั้น

### E4-S5 — Display Expiration Scheduler

เพิ่ม CLI scheduler สำหรับ Display Until / Expired lifecycle

### E4-S6 — Archive Workflow

เพิ่ม Archive Request / Approve / Reject

### E4-S7 — Restore Workflow

เพิ่ม Restore Request / Approve / Reject

### E4-S8 — Emergency Override

เพิ่ม `EmergencyOverride.Execute`, mandatory reason และ audit

### E5-S1 — TH/EN Independent Workflow

เชื่อม Revision/Approval lifecycle แยกตาม Locale

### E5-S2 — EN→TH Fallback

เพิ่ม Public fallback rule และ fallback notice

Acceptance scenarios อย่างน้อย:

1. EN Active + matching EN slug → EN content
2. EN ไม่มี Active, TH Active + TH slug ภายใต้ `/en/` → TH fallback
3. EN ไม่มี Active, request ใช้ slug จาก inactive EN revision → ไม่ใช้ revision นั้นเป็น fallback route source
4. TH/EN ไม่มี Active → no public content

### E5-S3 — Protected Preview

เพิ่ม Draft/Pending preview สำหรับ authorized user

### E6-S1 — Storage Abstraction

สร้าง `StorageInterface` + LocalStorage

### E6-S2 — Basic Media Upload

เพิ่ม upload + metadata + alt/caption

### E6-S3 — Media Usage Protection

เพิ่ม Usage Reference และห้ามลบ asset ที่ถูกใช้งาน

### E7-S1 — Public Content Rendering

สร้าง Public Home/List/Detail ขั้นต่ำ

### E7-S2 — Core Public Localization

เชื่อม `/th/...` `/en/...`, active slug และ fallback ตาม §10.1

### E8-S1 — Accessibility Core Verification

ตรวจ Core Public UI ต่อ WCAG 2.2 AA checklist

### E8-S2 — Security Hardening

เพิ่ม CSRF, rate limit, upload validation และ fixed security gate

### E8-S3 — Performance Verification

สร้าง fixed fixture + load profile และตรวจ NFR-02

### E9-S1 — Online Demo Deployment

Deploy core services และ verify deployed configuration

## Secondary / Should

### S-S1 — Revision Visual Diff

เพิ่ม comparison ระหว่าง Active กับ Pending Revision

### S-S2 — Category Tree

เพิ่ม hierarchical categories

### S-S3 — Multi-category Assignment

ผูก Content ได้หลาย Category

### S-S4 — Tag Master

เพิ่ม flat Tag taxonomy

### S-S5 — Menu Tree

เพิ่ม Parent/Child Menu

### S-S6 — Menu Link Types

เพิ่ม Internal / External / File / Heading

### S-S7 — SEO Metadata

เพิ่ม localized SEO / OG metadata

### S-S8 — Advanced Media Organization

เพิ่ม Folder / Tag สำหรับ assets

## Stretch

### ST-S1 — Shared Block Foundation

สร้าง Shared Block reference model

### ST-S2 — Shared Block Revision & Approval

เพิ่ม revision/approval lifecycle

### ST-S3 — Shared Block Usage Impact

แสดง impacted pages ก่อน Approve

### ST-S4 — PostgreSQL Job Queue

สร้าง async job foundation

### ST-S5 — In-app Notification

เพิ่ม notification inbox

### ST-S6 — Email Notification

เพิ่ม asynchronous email delivery

### ST-S7 — CMS Dashboard

เพิ่ม statistics / pending work / activity

### ST-S8 — Public Search

เพิ่ม PostgreSQL Full-Text Search

### ST-S9 — Search Locale Fallback

เพิ่ม EN search ที่รองรับ TH fallback

### ST-S10 — Related Content

เพิ่ม Category/Tag recommendation + manual pin

---

# 30. Story Dependency Rules

- Stretch Story ห้ามเป็น dependency ของ Core Must
- PostgreSQL Job Queue ห้ามเป็น dependency ของ Expiration
- Search ห้ามเป็น dependency ของ Public Rendering
- SEO ห้ามเป็น dependency ของ TH/EN Core flow
- Menu/Taxonomy ห้าม block Core Content publishing flow
- Revision Diff ห้าม block Approval; Approver สามารถ review full revision data ก่อน Visual Diff ถูก implement
- Shared Block ห้ามถูกใช้ใน Core Demo ก่อน Shared Block stories ผ่านครบ

---

# 31. Out of Scope — Demo v1

- Multi-site CMS
- CMS แยกตามกรม
- External Government SSO
- Laravel / Symfony Full Stack
- Microservices
- Redis
- RabbitMQ / Kafka
- Elasticsearch / OpenSearch
- Kubernetes
- Production-scale HA
- Long-term Audit Retention / Purge Policy
- Recovery Codes
- Dedicated Lost-device Identity Recovery
- Arbitrary Page Layout Builder
- Native Mobile App
- Real Government Data Integration
- Per-locale Archive
- Multiple future Approved Scheduled Revisions ต่อ Locale

---

# 32. Scope Control Rule

ห้ามเริ่ม Secondary/Stretch หาก Core Demo Gate ยังไม่ผ่าน

Core Demo Gate:

Authentication
→ MFA
→ Authorization
→ Audit
→ Content Identity
→ Revision
→ Approval
→ Activation
→ Display Scheduling
→ Expiration
→ Archive / Restore
→ Multilingual Core
→ Preview
→ Public Render
→ Security / Accessibility / Performance Gate
→ Online Deployment

ถ้า Core มี scope pressure ให้ลด acceptance depth ของ Secondary capabilityก่อน ห้ามเพิ่ม feature ใหม่เข้า Core

---

# 33. Review Finding Closure Mapping

| Finding | Final Status / Remediation |
|---|---|
| LS-REV-01 | CLOSED — แยก Approval / Activation และกำหนด Revision replacement / Expiration |
| LS-REV-02 / LS-REV-02R | CLOSED — Ownership matrix + deterministic fallback slug จาก fallback locale Active Revision |
| LS-REV-03 | CLOSED — `EmergencyOverride.Execute` + deterministic precedence |
| LS-REV-04 | CLOSED — Core scheduler แยกจาก Stretch Queue |
| LS-REV-05 | CLOSED — Must / Should / Stretch realigned และ roadmap re-sharded |
| LS-REV-06 | CLOSED — Fixed performance profile + fixed security gate |
| LS-REV-07 | CLOSED — Recovery = Backup MFA / Admin Reset เท่านั้น |
| LS-REV-08 | CLOSED — actor types user / anonymous / system |
| LS-RR-01 | CLOSED — ไม่มี cancellation หลัง approval; Withdraw เฉพาะ Pending Approval |

---

# 34. Validation

- Independent Lean Spec Review: NOT READY → remediated
- Targeted Independent Lean Spec Re-Review: NOT READY → remediated
- Final Targeted Closure Check: PASS
- BLOCKER: 0
- MAJOR: 0
- MINOR: 0
- All findings LS-REV-01..08, LS-REV-02R, LS-RR-01: CLOSED

**LEAN SPEC v0.3 BASELINE GATE: PASS**

Reviewed remediation / current workflow status:

- Owner decisions for the E1-S1 identity contract and `E0-S4 → E2-S1 → E1-S1` ordering: RECORDED
- Targeted independent re-review of the amended dependency and identity contract: PASS
- E0-S4: done; independently reviewed, committed and pushed at `f7692362b72ae3409941f16e0f1f5570e23fada7`
- E2-S1: done; Independent Review PASS after targeted remediation; E2S1-REV-01 CLOSED; final finding counts: 0 BLOCKER, 0 MAJOR, 0 MINOR, 0 NOTE
- E2-S1 completion commit: `7e15d4003c34937243d0d94b5866e9f57f6b4f84` (`feat: add E2-S1 audit write foundation`); committed, pushed and post-push verified with `HEAD == origin/main`
- E2-S1 dependency for Identity follow-up work: SATISFIED
- E1-S1: done previously; next separate Guided Development target: E1-S1b (`docs/epics/epic-1/story-s1b.md`), todo / NEXT / NOT STARTED; retain and verify its other listed prerequisites in that session

**REMEDIATION PLANNING REVIEW: PASS — E2-S1 DONE — NEXT TARGET: E1-S1b**

---

# 35. Changelog

## Workflow state synchronization — 2026-10-01

- Recorded the supplied independent planning review PASS and E0-S4 / E2-S1 completion evidence.
- Closed E2S1-REV-01 after targeted remediation and independent re-review; recorded the pushed E2-S1 commit.
- Preserved completed E1-S1 and identified E1-S1b as the next separate Guided Development target, without implementation or technical contract changes.

## 0.4-remediation-candidate — 2026-09-30

Historical candidate submission (targeted independent review subsequently passed; see current status in §34):

- Reordered the planning roadmap to `E0-S4 → E2-S1 → E1-S1`.
- Defined PostgreSQL `BIGINT` generated User identity and matching Audit actor-user type.
- Required trimmed, non-empty username and email with preserved entered case and case-insensitive uniqueness/lookup.
- Fixed persisted account state as `is_active BOOLEAN NOT NULL DEFAULT TRUE` with no deletion on deactivation.
- Fixed Demo v1 cardinality at exactly one Core Role per User using `roles` and non-null `users.role_id`.
- Assigned Role identity/association schema to E1-S1 while retaining permission/grant behavior in later authorization stories.
- Required E1-S1 to complete delete-restricting Audit-to-User referential linkage after E2-S1 establishes the Audit column.
- At candidate submission, Development remained blocked until targeted independent re-review passed; that planning review block is now closed.

## 0.3 — 2026-09-24

Validated following final targeted closure check:

- Defined deterministic EN→TH fallback slug resolution
- Fallback routing uses only fallback locale Active Revision slug under requested locale prefix
- Explicitly excluded inactive/historical revision slugs from fallback route resolution
- Removed undefined Approved Scheduled exit semantics
- Demo v1 does not support cancellation after approval
- Withdraw remains valid only from Pending Approval
- Superseded occurs only when an Active Revision is replaced during activation
- Final targeted closure check PASS; all findings closed

Status:

**Validated**

## 0.2 — 2026-09-24

Remediated following Independent Lean Spec Review:

- Clarified Published Revision activation semantics
- Added Content / Locale / Revision ownership model
- Defined deterministic Emergency Override precedence
- Removed Must dependency on Stretch Job Queue
- Realigned Must / Should / Stretch scope
- Re-sharded initial Story Roadmap
- Added deterministic Performance / Security verification profile
- Clarified MFA Recovery scope
- Clarified unauthenticated/system Audit actors

## 0.1 — 2026-09-24

Initial Lean Spec draft from requirement discovery and architecture decision session.

# CSIT314 – Developer Guide

Foundation is already built. This project has **two shared user stories** — login and logout — that work for all four roles. Each teammate now builds their role-specific use cases on top of this foundation.

---

## 1. The two shared user stories

### User Story #1 — Login

> *As a user (Platform Manager / User Admin / Fund Raiser / Donee), I want to log in with my credentials so that I can access my dashboard.*

**Main flow**
1. User visits `http://localhost/CSIT314/` → sees the shared login form.
2. User enters username + password, clicks **Login**.
3. `index.php` loops through `$loginPages = [loginPMPage, loginUAPage, loginFRPage, loginDNPage]`.
4. Each boundary calls its controller, which calls its entity, which queries the `users` table filtered by its profile.
5. First one that authenticates wins — sets `$_SESSION`, returns a dashboard URL.
6. `index.php` redirects the user to that dashboard.
7. On failure → error `"Invalid username or password."` shown below the form.

**BCE flow**
```
index.php  ──►  loginXXPage.login()  ──►  loginXXController.login()  ──►  XX::login()
                    (Boundary)                 (Control)                    (Entity)
```

### User Story #2 — Logout

> *As a user (any role), I want to log out securely so that I can protect my account when I'm done working.*

**Main flow**
1. Logged-in user clicks the **Logout** button on their dashboard.
2. A confirmation modal appears ("Logout Confirmation — Are you sure?").
3. User clicks **Yes**.
4. `logout.php` runs `LogoutPage::requestLogout()`, which destroys the session.
5. User is redirected to `index.php?logged_out=1` — login page shows `"Successfully logged out."` under the title.

**Alt flow**
- User clicks **Cancel** in the modal → modal closes, session remains active, user stays on their dashboard.

**BCE flow**
```
logout.php  ──►  LogoutPage.requestLogout()  ──►  LogoutController.logout()  ──►  Session.destroy()
                     (Boundary)                       (Control)                     (Entity)
```

Logout is **shared across all roles** — one `LogoutPage`, one `LogoutController`, one `Session` entity.

---

## 2. Project structure

```
CSIT314/
├── index.php                    ← login entry + dispatcher (shared)
├── logout.php                   ← logout entry (shared)
│
├── dashboard_pm.php             ← role-specific dashboards (one per role)
├── dashboard_ua.php
├── dashboard_fr.php
├── dashboard_dn.php
│
├── boundary/                    ← UI layer
│   ├── loginPMPage.php          ← login boundary per role
│   ├── loginUAPage.php
│   ├── loginFRPage.php
│   ├── loginDNPage.php
│   ├── LogoutPage.php           ← logout boundary (shared)
│   └── views/
│       ├── login.view.php       ← shared login HTML
│       ├── dashboard_pm.view.php
│       ├── dashboard_ua.view.php
│       ├── dashboard_fr.view.php
│       └── dashboard_dn.view.php
│
├── control/                     ← use-case logic
│   ├── loginPMController.php
│   ├── loginUAController.php
│   ├── loginFRController.php
│   ├── loginDNController.php
│   └── LogoutController.php     ← shared
│
├── entity/                      ← domain + DB
│   ├── PlatformManager.php
│   ├── UserAdmin.php
│   ├── FundRaiser.php
│   ├── Donee.php
│   └── Session.php              ← shared (logout)
│
├── config/
│   └── DBConnection.php         ← mysqli singleton
│
├── sql/
│   └── schema.sql               ← run once in phpMyAdmin
│
└── README.md
```

**BCE rule of thumb**

| Layer | Answers the question | Lives in |
|---|---|---|
| **Boundary** | "What does the user see / click?" | `boundary/` + `boundary/views/` |
| **Control** | "What use-case is being performed?" | `control/` |
| **Entity** | "What domain object is involved and how does it persist?" | `entity/` |

Boundary → Controller → Entity → DB. Do not skip layers.

---

## 3. Naming conventions

| Thing | Convention | Example |
|---|---|---|
| Role-specific entity | PascalCase, domain noun | `PlatformManager`, `Donee` |
| Role-specific controller | `login<XX>Controller`, `<action><XX>Controller` | `loginDNController`, `createAccountUAController` |
| Role-specific boundary | `login<XX>Page`, `<action><XX>Page` | `loginDNPage`, `viewUsersUAPage` |
| Shared class (not per-role) | PascalCase | `LogoutPage`, `LogoutController`, `Session` |
| Root entry file | `snake_case.php` — role suffix | `dashboard_dn.php` |
| View file | `snake_case.view.php` inside `boundary/views/` | `dashboard_dn.view.php` |
| DB profile value | lowercase snake | `'donee'`, `'fund_raiser'`, `'user_admin'` |

**Role abbreviations:**
| Abbrev | Role slug | Entity class |
|---|---|---|
| PM | `platform_manager` | `PlatformManager` |
| UA | `user_admin` | `UserAdmin` |
| FR | `fund_raiser` | `FundRaiser` |
| DN | `donee` | `Donee` |

---

## 4. Session contract

After successful login, these session keys are set by the controller:

```php
$_SESSION['user_id']  = <int>       // primary key from users table
$_SESSION['username'] = <string>    // the logged-in username
$_SESSION['profile']  = '<profile>' // 'platform_manager' | 'user_admin' | 'fund_raiser' | 'donee'
```

Dashboard guards check `$_SESSION['profile']` and redirect back to `index.php` if the wrong profile.

Logout clears all session state via `Session::destroy()`.

---

## 5. Adding a role-specific use case (what you actually need to build)

Login and logout are done. Your job is to implement the **role-specific use cases** from your user stories. Example: *"As a Platform Manager, I want to view all user accounts."*

For each new use case, follow the same BCE pattern:

### Step 1 — Entity method (if new data operation)

Open `entity/<YourRole>.php` and add a method for the data operation:

```php
public function fetchAll(): array {
    $result = $this->db->query("SELECT id, username, profile FROM users");
    return $result->fetch_all(MYSQLI_ASSOC);
}
```

### Step 2 — Controller: `control/<action><XX>Controller.php`

One controller per use case. It calls the entity method and returns data to the boundary:

```php
class viewUsersPMController {
    public function listUsers(): array {
        $db = DBConnection::getInstance();
        return (new PlatformManager($db))->fetchAll();
    }
}
```

### Step 3 — Boundary: `boundary/<action><XX>Page.php`

One boundary per use case:

```php
class viewUsersPMPage {
    public function display(): void {
        $users = (new viewUsersPMController())->listUsers();
        include __DIR__ . '/views/view_users_pm.view.php';
    }
}
```

### Step 4 — View: `boundary/views/<action>_<xx>.view.php`

Pure HTML with `<?= $var ?>` holes. Copy styling from `dashboard_pm.view.php` to keep the look consistent.

### Step 5 — Entry file: `<action>_<xx>.php` at project root

```php
<?php
session_start();
// autoload ...
if (($_SESSION['profile'] ?? null) !== 'platform_manager') {
    header('Location: index.php'); exit;
}
(new viewUsersPMPage())->display();
```

### Step 6 — Link it from your dashboard

Add a button / card in your `boundary/views/dashboard_<xx>.view.php` linking to the new entry file.

---

## 6. Rules to keep the project consistent

- **Do NOT** put HTML inside controller or entity files. Views only live in `boundary/views/`.
- **Do NOT** write SQL outside `entity/` files. Controllers and boundaries never touch the DB directly.
- **Do NOT** duplicate the login view. Every role uses `boundary/views/login.view.php`.
- **Do NOT** touch the shared logout BCE (`LogoutPage`, `LogoutController`, `Session`) — logout already works for every role.
- **Do NOT** use `password_hash` / `password_verify`. Passwords are stored plain for this project — use `hash_equals($stored, $input)`.
- **Always** use prepared statements (`$db->prepare(...)->bind_param(...)`). No string concatenation into SQL.
- **Always** escape output in views with `htmlspecialchars(...)`.
- **Always** start every root `.php` file with `session_start();` before anything else.
- **Always** guard role-specific entry files (check `$_SESSION['profile']` matches).

---

## 7. Environment setup

1. XAMPP running (Apache + MySQL)
2. Project folder: `C:\xampp\htdocs\CSIT314\`
3. Import DB: phpMyAdmin → Import → select `sql/schema.sql` → Go
4. Seed extra test users via SQL tab (all four profiles are seeded by `schema.sql`):
   ```sql
   INSERT INTO users (name, username, email, phone_number, password, profile) VALUES
   ('Admin One',    'admin1', 'admin1@example.com', '98000001', 'admin123', 'user_admin'),
   ('FundRaiser 1', 'fr1',    'fr1@example.com',    '98000002', 'fr123',    'fund_raiser'),
   ('Donee One',    'donee1', 'donee1@example.com', '98000003', 'donee123', 'donee');
   ```
5. Open `http://localhost/CSIT314/`
6. Login with any seeded user.

If `schema.sql` changes, drop and re-import:
```sql
DROP DATABASE csit314;
```

---

## 8. Common pitfalls

- **"Class not found"** → filename must match class name exactly. The autoloader in `index.php` looks in `boundary/`, `control/`, `entity/`, `config/`.
- **Dashboard keeps redirecting to index** → `$_SESSION['profile']` doesn't match the dashboard's guard check.
- **Login always fails** → confirm the `profile` value in the DB row matches exactly what your entity's SQL filters on.
- **Modal doesn't appear / changes not showing** → Apache/browser caching; hard refresh (Ctrl+F5).
- **Logout redirects to wrong page** → `LogoutPage::requestLogout()` returns `index.php?logged_out=1` — don't change it, the query param triggers the success message.

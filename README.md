# CSIT314 – Developer Guide

How to add your role (Donee, Fund Raiser, User Admin) to this project.

---

## 1. Project structure

```
CSIT314/
├── index.php                ← unified login entry + dispatcher
├── dashboard_pm.php         ← role-specific dashboard (copy this pattern)
├── logout.php
│
├── boundary/                ← UI layer (pages + views)
│   ├── loginPMPage.php
│   └── views/
│       └── login.view.php   ← shared login HTML (do not duplicate)
│
├── control/                 ← use-case / application logic
│   └── loginPMController.php
│
├── entity/                  ← domain objects + DB access
│   └── PlatformManager.php
│
├── config/
│   └── DBConnection.php     ← mysqli singleton
│
└── sql/
    └── schema.sql           ← run once in phpMyAdmin
```

**BCE rule of thumb**

| Layer | Answers the question | Lives in |
|---|---|---|
| **Boundary** | "What does the user see / click?" | `boundary/` + `boundary/views/` |
| **Control** | "What use-case is being performed?" | `control/` |
| **Entity** | "What domain object is involved and how does it persist?" | `entity/` |

The boundary calls the controller. The controller calls the entity. The entity talks to the DB. Do not skip layers.

---

## 2. Naming conventions

| Thing | Convention | Example |
|---|---|---|
| Entity class | PascalCase, domain noun | `Donee`, `FundRaiser`, `UserAdmin` |
| Controller class | camelCase, `login<ROLE>Controller` for login, `<action><ROLE>Controller` for others | `loginDNController`, `createAccountUAController` |
| Boundary class | camelCase, `login<ROLE>Page` / `<action><ROLE>Page` | `loginDNPage`, `dashboardDNPage` |
| Root entry file | `snake_case.php` — role suffix | `dashboard_dn.php`, `dashboard_fr.php` |
| View file | `snake_case.view.php` inside `boundary/views/` | `dashboard_dn.view.php` |
| DB role value | lowercase snake | `'donee'`, `'fund_raiser'`, `'user_admin'` |

**Role abbreviations used in filenames:**
- PM = platform_manager
- DN = donee
- FR = fund_raiser
- UA = user_admin

---

## 3. How the login flow works

```
index.php                        ← shows the login form (shared view)
   │
   │  on POST, loops through $loginPages = ['loginPMPage', 'loginDNPage', ...]
   │  first one that returns a dashboard URL wins
   ▼
boundary/loginXXPage.php         ← calls its controller, returns dashboard path or null
   │
   ▼
control/loginXXController.php    ← calls entity, sets $_SESSION on success
   │
   ▼
entity/XX.php                    ← queries users WHERE role = '<role>'
```

Session on successful login:
```php
$_SESSION['user_id']  = <int>
$_SESSION['username'] = <string>
$_SESSION['role']     = '<role slug>'
```

---

## 4. Adding your role — checklist

Use the existing PM files as your template. Copy them, find-and-replace the role-specific bits.

### Step 1 — Entity: `entity/<Role>.php`

Copy `entity/PlatformManager.php`. Change:
- Class name → `Donee` / `FundRaiser` / `UserAdmin`
- SQL `role = 'platform_manager'` → your role slug

```php
class Donee {
    // ...same shape as PlatformManager...
    public function login(string $username, string $password): bool {
        $stmt = $this->db->prepare(
            "SELECT id, password FROM users WHERE username = ? AND role = 'donee' LIMIT 1"
        );
        // ...
    }
}
```

### Step 2 — Controller: `control/login<XX>Controller.php`

Copy `control/loginPMController.php`. Change:
- Class name → `loginDNController` / `loginFRController` / `loginUAController`
- Entity it `new`s → `Donee` / `FundRaiser` / `UserAdmin`
- `$_SESSION['role']` value → your role slug

### Step 3 — Boundary: `boundary/login<XX>Page.php`

Copy `boundary/loginPMPage.php`. Change:
- Class name
- Controller it uses
- Dashboard path it returns → `dashboard_dn.php` etc.

### Step 4 — Dashboard entry file: `dashboard_<xx>.php`

Copy `dashboard_pm.php`. Change:
- Role check in the guard → `!== 'donee'`
- Page title, welcome text

For now keep HTML inline like `dashboard_pm.php` does. If your dashboard grows, split into `boundary/dashboard<XX>Page.php` + `boundary/views/dashboard_<xx>.view.php`.

### Step 5 — Wire it into `index.php`

Uncomment your lines in these two arrays in `index.php`:

```php
$dashboards = [
    'platform_manager' => 'dashboard_pm.php',
    'donee'            => 'dashboard_dn.php',    // ← add yours
    ...
];

$loginPages = [
    'loginPMPage',
    'loginDNPage',                                // ← add yours
    ...
];
```

### Step 6 — Add a test user in the DB

```sql
INSERT INTO users (username, password, role) VALUES
('donee1', 'donee123', 'donee');
```

### Step 7 — Test

1. Log out if logged in → `http://localhost/CSIT314/logout.php`
2. Go to `http://localhost/CSIT314/`
3. Enter your test credentials → should land on your dashboard

---

## 5. Rules to keep the project consistent

- **Do NOT** put HTML inside controller or entity files. Views only live in `boundary/views/`.
- **Do NOT** write SQL outside `entity/` files. Controllers and boundaries never touch the DB directly.
- **Do NOT** duplicate the login view. Every role uses `boundary/views/login.view.php`.
- **Do NOT** use `password_hash` / `password_verify`. Passwords are stored plain for this project — use `hash_equals($stored, $input)`.
- **Always** use prepared statements (`$db->prepare(...)->bind_param(...)`). No string concatenation into SQL.
- **Always** escape output in views with `htmlspecialchars(...)`.
- **Always** start every root `.php` file with `session_start();` before anything else.

---

## 6. Environment setup

1. XAMPP running (Apache + MySQL)
2. Project folder: `C:\xampp\htdocs\CSIT314\`
3. Import DB: phpMyAdmin → Import → select `sql/schema.sql` → Go
4. Open `http://localhost/CSIT314/`
5. Default login: `manager` / `manager123`

If you changed `schema.sql` and re-import, drop the DB first:
```sql
DROP DATABASE csit314;
```

---

## 7. Common pitfalls

- **"Class not found"** → check the filename matches the class name exactly (case-sensitive on real servers). The autoloader in `index.php:5-14` looks in `boundary/`, `control/`, `entity/`, `config/`.
- **Dashboard keeps redirecting to index** → session role doesn't match the dashboard's guard check. Verify `$_SESSION['role']` matches what `dashboard_xx.php` expects.
- **Login always fails** → confirm the `role` in the DB row matches exactly what your entity's SQL filters on.
- **Changes not showing** → Apache caching; hard refresh (Ctrl+F5) or restart Apache from XAMPP.

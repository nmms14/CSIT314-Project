# csit314

Django web app for a fundraising platform, organized using a **Boundary–Control–Entity (BCE)** architecture.

## Prerequisites

- Python 3.11+
- `pip`

## Setup

1. **Clone the repo**

   ```bash
   git clone https://github.com/<your-org>/csit314.git
   cd csit314
   ```

2. **Create and activate a virtual environment**

   Windows (PowerShell):
   ```powershell
   python -m venv venv
   venv\Scripts\activate
   ```

   macOS / Linux:
   ```bash
   python3 -m venv venv
   source venv/bin/activate
   ```

3. **Install dependencies**

   ```bash
   pip install -r requirements.txt
   ```

4. **Apply database migrations**

   ```bash
   python manage.py migrate
   ```

5. **(Optional) Seed a default Platform Manager account**

   ```bash
   python manage.py seed_manager
   ```

   Creates a login you can use immediately:
   - **Email:** `manager@fundraising.com`
   - **Password:** `manager123`

## Running the app

```bash
python manage.py runserver
```

Then open http://127.0.0.1:8000/ in your browser.

### Routes

| Path          | Description                              |
| ------------- | ---------------------------------------- |
| `/`           | Landing page                             |
| `/login/`     | Login page                               |
| `/dashboard/` | Platform Manager dashboard (auth-gated)  |
| `/logout/`    | Log out the current session              |
| `/admin/`     | Django admin site                        |

## Project structure

```
csit314/
├── boundary/        # Boundary layer — views & templates (UI)
│   ├── templates/   # landing, login, dashboard HTML
│   └── views.py
├── control/         # Control layer — business logic
│   └── auth_manager.py
├── entity/          # Entity layer — domain models
│   └── models.py    # PlatformManager (custom user)
├── config/          # Django settings, URL config, WSGI/ASGI
├── db.sqlite3
└── manage.py
```

## Creating a Django superuser (for `/admin/`)

```bash
python manage.py createsuperuser
```

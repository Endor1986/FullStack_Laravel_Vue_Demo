<p align="center">
  <img alt="PHP" src="https://img.shields.io/badge/PHP-8.x-777BB4?logo=php&logoColor=white">
  <img alt="Laravel" src="https://img.shields.io/badge/Laravel-11-FF2D20?logo=laravel&logoColor=white">
  <img alt="Vue" src="https://img.shields.io/badge/Vue-3-42b883?logo=vue.js&logoColor=white">
  <img alt="Vite" src="https://img.shields.io/badge/Vite-5-646CFF?logo=vite&logoColor=white">
  <img alt="License" src="https://img.shields.io/badge/License-MIT-lightgrey.svg">
</p>

# Kursverwaltung – Demo (Laravel 11 + Vue 3)

Kleine End-to-End-App zur Demonstration von **API-Entwicklung** (Laravel 11, SQLite) und **Frontend** (Vue 3, Pinia, Vite).  
Funktionen: Kurse **anlegen**, **auflisten**, **suchen/filtern**, **löschen** – inkl. Validierung & Pagination.

---

## 🚀 Quickstart

### Backend (Laravel 11)
```bash
cd backend
# .env vorbereiten (SQLite)
copy .env.example .env                 # Windows
copy NUL database\database.sqlite
# .env: DB_CONNECTION=sqlite, DB_DATABASE=database/database.sqlite
php artisan key:generate
php artisan migrate
php artisan serve --host 127.0.0.1 --port 8000
```

### Frontend (Vite + Vue 3) – in neuem Terminal
```bash
cd frontend
npm install
npm run dev
```

- API: http://127.0.0.1:8000  
- Frontend: http://localhost:5173

---

## 📂 Projektstruktur
```
.
├── backend/
│   ├── app/
│   │   └── Http/Controllers/
│   │       ├── Controller.php
│   │       └── CourseController.php
│   ├── app/Http/Requests/StoreCourseRequest.php
│   ├── app/Models/Course.php
│   ├── database/migrations/*_create_courses_table.php
│   ├── routes/api.php
│   ├── config/cors.php
│   └── bootstrap/app.php        # api: __DIR__.'/../routes/api.php' eingebunden
└── frontend/
    ├── src/
    │   ├── api/http.ts
    │   ├── stores/courses.ts
    │   ├── components/
    │   │   ├── CourseForm.vue
    │   │   └── CourseList.vue
    │   └── App.vue / main.ts
    ├── vite.config.ts           # Proxy / Alias @ → src
    └── tsconfig.json            # paths: "@/*" → "src/*"
```

---

## 🔌 API-Überblick (Prefix `/api`)
| Methode   | Pfad              | Beschreibung                                                                                      |
|:---------:|-------------------|---------------------------------------------------------------------------------------------------|
| GET       | `/courses`        | Liste – Query: `q`, `active`, `per_page`, `sort`, `dir`                                          |
| POST      | `/courses`        | Kurs anlegen – Body: `title`, `starts_at`, `price_cents`, optional `description`, `is_active`    |
| GET       | `/courses/{id}`   | Kurs anzeigen                                                                                    |
| PUT/PATCH | `/courses/{id}`   | Kurs ändern                                                                                      |
| DELETE    | `/courses/{id}`   | Kurs löschen                                                                                     |
| GET       | `/ping`           | Health-Check → `{"ok": true}`                                                                     |

---

## ⚙️ Konfiguration (lokal)

**`.env` (Backend):**
```ini
APP_URL=http://127.0.0.1:8000
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

**Laravel-11 Hinweis:** In `bootstrap/app.php` müssen die API-Routen eingebunden sein:
```php
->withRouting(
    web: __DIR__.'/../routes/web.php',
    api: __DIR__.'/../routes/api.php',
    commands: __DIR__.'/../routes/console.php',
    health: '/up',
)
```

---

## 🧰 Troubleshooting

- **404 `/api/courses`**  
  Caches leeren & Routen prüfen:
  ```bash
  php artisan optimize:clear
  php artisan route:list
  ```
  Prüfe außerdem `bootstrap/app.php` (siehe oben).

- **CORS im Dev**  
  `config/cors.php` erlaubt `http://localhost:5173`. Backend nach Änderungen neu starten.

- **Alias `@` im Frontend**  
  In `vite.config.ts` `resolve.alias` → `@` zeigt auf `./src`, und `tsconfig.json` hat:
  ```json
  { "compilerOptions": { "baseUrl": ".", "paths": { "@/*": ["src/*"] } } }
  ```

---

## ✅ Status
- Backend & Frontend laufen lokal mit Hot-Reload.  
- CRUD-Flow funktionsfähig (manuell geprüft).  
- Geeignet als kompakte **Bewerbungs-/Demo-Referenz** für Full-Stack-Arbeitsweise.

---

## 📜 Lizenz
MIT – siehe `LICENSE`.

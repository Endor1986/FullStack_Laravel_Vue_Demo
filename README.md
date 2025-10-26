Kursverwaltung – Demo (Laravel 11 + Vue 3)

Eine kleine End-to-End-App zur Demonstration von API-Entwicklung (Laravel 11, SQLite) und Frontend (Vue 3, Pinia, Vite).
Funktionen: Kurse anlegen, auflisten, suchen/filtern, löschen – inkl. Validierung & Pagination.

🚀 Quickstart
# Backend (Laravel 11)
cd backend
php artisan serve --host 127.0.0.1 --port 8000

# Frontend (Vite + Vue 3) – in neuem Terminal
cd frontend
npm install
npm run dev


API: http://127.0.0.1:8000

Frontend: http://localhost:5173

📂 Projektstruktur
.
├── backend/
│   ├── app/
│   │   └── Http/Controllers/
│   │       ├── Controller.php
│   │       └── CourseController.php
│   ├── app/Http/Requests/StoreCourseRequest.php
│   ├── app/Models/Course.php
│   ├── database/migrations/20xx_xx_xx_xxxxxx_create_courses_table.php
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

🔌 API-Überblick (Prefix /api)

GET /courses – Liste (Query: q, active, per_page, sort, dir)

POST /courses – anlegen (Body: title, starts_at, price_cents, optional description, is_active)

GET /courses/{id} – anzeigen

PUT/PATCH /courses/{id} – ändern

DELETE /courses/{id} – löschen

GET /ping – Health-Check ({"ok":true})

⚙️ Konfiguration (lokal)

.env (Backend):

APP_URL=http://127.0.0.1:8000
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync


Einmalig:

cd backend
copy .env.example .env          # Windows
copy NUL database\database.sqlite
php artisan key:generate
php artisan migrate

🧰 Troubleshooting

404 /api/courses
In Laravel 11 muss bootstrap/app.php die API-Routen einbinden:

->withRouting(
    web: __DIR__.'/../routes/web.php',
    api: __DIR__.'/../routes/api.php',
    commands: __DIR__.'/../routes/console.php',
    health: '/up',
)


Dann:

php artisan optimize:clear
php artisan route:list


CORS im Dev
config/cors.php erlaubt http://localhost:5173. Backend nach Änderungen neu starten.

Alias @ im Frontend
In vite.config.ts:

resolve:{ alias:{ '@': require('path').resolve(__dirname,'./src') } }

✅ Status

Backend & Frontend laufen lokal mit Hot-Reload.

CRUD-Flow ist funktional und minimal getestet (manuell).

Geeignet als kompakte Bewerbungs-/Demo-Referenz für Full-Stack-Arbeitsweise.
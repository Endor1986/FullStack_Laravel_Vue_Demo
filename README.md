<p align="center">

&nbsp; <img alt="PHP" src="https://img.shields.io/badge/PHP-8.x-777BB4?logo=php\&logoColor=white">

&nbsp; <img alt="Laravel" src="https://img.shields.io/badge/Laravel-11-FF2D20?logo=laravel\&logoColor=white">

&nbsp; <img alt="Vue" src="https://img.shields.io/badge/Vue-3-42b883?logo=vue.js\&logoColor=white">

&nbsp; <img alt="Vite" src="https://img.shields.io/badge/Vite-5-646CFF?logo=vite\&logoColor=white">

&nbsp; <img alt="License" src="https://img.shields.io/badge/License-MIT-lightgrey.svg">

</p>



\# Kursverwaltung – Demo (Laravel 11 + Vue 3)



Eine kleine End-to-End-App zur Demonstration von API-Entwicklung (Laravel 11, SQLite) und Frontend (Vue 3, Pinia, Vite).  

Funktionen: Kurse \*\*anlegen\*\*, \*\*auflisten\*\*, \*\*suchen/filtern\*\*, \*\*löschen\*\* – inkl. Validierung \& Pagination.



---



\## 🚀 Quickstart



\### Backend (Laravel 11)

```bash

cd backend

\# .env vorbereiten (SQLite)

copy .env.example .env                 # Windows

copy NUL database\\database.sqlite

\# .env: DB\_CONNECTION=sqlite, DB\_DATABASE=database/database.sqlite

php artisan key:generate

php artisan migrate

php artisan serve --host 127.0.0.1 --port 8000





Frontend (Vite + Vue 3) – in neuem Terminal



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

│   ├── database/migrations/\*\_create\_courses\_table.php

│   ├── routes/api.php

│   ├── config/cors.php

│   └── bootstrap/app.php        # api: \_\_DIR\_\_.'/../routes/api.php' eingebunden

└── frontend/

&nbsp;   ├── src/

&nbsp;   │   ├── api/http.ts

&nbsp;   │   ├── stores/courses.ts

&nbsp;   │   ├── components/

&nbsp;   │   │   ├── CourseForm.vue

&nbsp;   │   │   └── CourseList.vue

&nbsp;   │   └── App.vue / main.ts

&nbsp;   ├── vite.config.ts           # Proxy / Alias @ → src

&nbsp;   └── tsconfig.json            # paths: "@/\*" → "src/\*"





🔌 API-Überblick (Prefix /api)

Methode	Pfad	Beschreibung

GET	/courses	Liste – Query: q, active, per\_page, sort, dir

POST	/courses	Kurs anlegen – Body: title, starts\_at, price\_cents, optional description, is\_active

GET	/courses/{id}	Kurs anzeigen

PUT/PATCH	/courses/{id}	Kurs ändern

DELETE	/courses/{id}	Kurs löschen

GET	/ping	Health-Check → {"ok": true}

⚙️ Konfiguration (lokal)



.env (Backend):



APP\_URL=http://127.0.0.1:8000

DB\_CONNECTION=sqlite

DB\_DATABASE=database/database.sqlite

SESSION\_DRIVER=file

CACHE\_STORE=file

QUEUE\_CONNECTION=sync





🧰 Troubleshooting



404 /api/courses (Laravel 11):

In bootstrap/app.php müssen die API-Routen eingebunden sein:



->withRouting(

&nbsp;   web: \_\_DIR\_\_.'/../routes/web.php',

&nbsp;   api: \_\_DIR\_\_.'/../routes/api.php',

&nbsp;   commands: \_\_DIR\_\_.'/../routes/console.php',

&nbsp;   health: '/up',

)



Danach:



php artisan optimize:clear

php artisan route:list





CORS im Dev:

config/cors.php erlaubt http://localhost:5173. Backend nach Änderungen neu starten.



Alias @ im Frontend:

In vite.config.ts resolve.alias → @ zeigt auf ./src, und tsconfig.json hat:



{ "compilerOptions": { "baseUrl": ".", "paths": { "@/\*": \["src/\*"] } } }



✅ Status



Backend \& Frontend laufen lokal mit Hot-Reload.



CRUD-Flow ist funktionsfähig (manuell geprüft).

Demo-Referenz für Full-Stack-Arbeitsweise.


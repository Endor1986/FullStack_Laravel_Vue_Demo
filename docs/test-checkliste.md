# Manuelle Test-Checkliste – iCourse (Laravel 11 & Vue 3)

**Ziel:** CRUD-Flow, Validierung, Fehlerbilder und Dev-Setup in < 2 Min. verifizierbar.  
**Statuslegende:** ✅ bestanden · ⚠️ teilweise · ❌ fehlgeschlagen

---

## Start & Health
✅ Frontend startet (Vite) → `http://localhost:5173`  
✅ Backend startet (Laravel) → `http://127.0.0.1:8000`  
✅ Health-Check → `GET /api/ping` ⇒ `{ "ok": true }`  
✅ Dev-Proxy aktiv → Frontend `/api` → Backend

## Create
✅ Formular valid (Titel, Datum, Preis ≥ 0) → **POST /api/courses** ⇒ **201**  
✅ Neuer Kurs erscheint sofort in der Liste (State-Refresh)

## Read / List
✅ `GET /api/courses` liefert Daten (**200**)  
✅ Pagination sichtbar bei > `per_page`  
✅ Anzeige korrekt (Titel, Datum, Preis, aktiv)

## Suche & Filter
✅ Freitextsuche `q` filtert nach Titel  
✅ Aktiv-Filter `active=true/false` wirkt korrekt  
✅ Kombination Suche + Filter funktioniert

## Update (optional)
✅ Kursdaten änderbar (**PUT/PATCH**) ⇒ **200**

## Delete
✅ Löschen entfernt Eintrag (**DELETE /api/courses/{id}** ⇒ **204**)  
✅ Liste aktualisiert sich ohne Reload

## Validierung
✅ Clientseitig: z. B. Preis ≥ 0 (Browser-Hinweis)  
✅ Serverseitig: FormRequest ⇒ **422** mit Feldfehlern  
✅ Fehlermeldungen sind verständlich & feldnah

## Lade- & Fehlerzustände
✅ Loading sichtbar (Spinner/„Lade…“) bei pending Requests  
✅ Serverfehler/Offline ⇒ UI-Hinweis + Console-Log (**500**)  
✅ Validation-Fehler ⇒ UI-Hinweis (**422**), kein Absturz

## CORS & Sicherheit (dev)
✅ CORS erlaubt `http://localhost:5173` (nur dev)  
✅ Keine geheimen Keys im Frontend/Repo (env/gitignore geprüft)

---

**Ergebnis:**  
✅ Alle Kernpfade (Create, List, Filter, Delete) inkl. Validierung & Fehlerbilder manuell verifiziert.

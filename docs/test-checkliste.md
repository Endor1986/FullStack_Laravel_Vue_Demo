# Testplan

## Ziel

Nachweis klassischer Testverfahren (Black-Box, Grenzwertanalyse, White-Box, Regression) anhand einer kleinen Bestell-API.

## Scope

* /orders: Validierung, Preisberechnung, Fehlerfälle
* Validierungsfunktionen (PLZ, Menge)
* Rechenlogik (Mehrwertsteuer, Rundung)

## Verfahren

* Äquivalenzklassen \& Grenzwerte (PLZ, Menge)
* Entscheidungstabellen (Rabatte – später)
* White-Box (Validatoren)
* Regression (Bugs fixen -> Tests bleiben)

## Entry/Exit

* Entry: Repo gebaut, npm install läuft, API startet
* Exit: Mind. 8 Testfälle grün; bekannte Bugs gefixt oder dokumentiert



| ID   | Bereich  | Titel                           | Erwartung                    |

| ---- | -------- | ------------------------------- | ---------------------------- |

| T-01 | ZIP      | PLZ muss genau 5 Ziffern haben  | 400 + `message=invalid-zip`  |

| T-02 | Menge    | qty > 10 wird abgewiesen        | 400 + `message=invalid-qty`  |

| T-03 | Preis    | 0.1+0.2 korrekt (Cent-Integer)  | Total korrekt (0.36)         |

| T-04 | Contract | Fehlerobjekt nutzt `message`    | Konsistentes Schema          |

| T-05 | Lager    | stock=0 → Bestellung blockieren | 409 + `message=out-of-stock` |




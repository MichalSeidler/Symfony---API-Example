Symfony - API Example
======================
Jednoduchá rychlá ukázková implementace přístupu na API a výpis položek prostřednictvím Symfony frameworku.
Není zde kladen žádný důraz na vizuální stránku. Slouží jako ukázka, neboť pro produkční prostředí vyžaduje další úpravy.

Např.:
- načtení všech záznamů z API do (databáze / dlouhodobé cache) a (pravidelná / při odpovědi 200) aktualizace 
- při výpadku API načítat data z DB aby byla vždy dostupná
======================

Run:
1) docker-compose up
2) docker exec -it symfony /bin/bash
3) composer install
4) symfony console doctrine:migrations:migrate
5) http://localhost:8080

======================
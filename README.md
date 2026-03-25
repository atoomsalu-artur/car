# Autorent

Projekt töötab Apache, PHP, MySQL/MariaDB ja phpMyAdmin abil.

## Paigaldus
- GitHubi projekt klooniti serverisse
- projekt paigutati kausta `/var/www/html/car`
- loodi andmebaas `car_rent`
- imporditi SQL fail
- seadistati andmebaasi ühendus failis `config.php`

## Lisatud funktsionaalsus
- lisatud tabel `users`
- lisatud tabel `reservations`
- lisatud kasutaja registreerimise leht `register.php`
- lisatud auto broneerimisvorm failis `single_car.php`
- koguhind arvutatakse valemiga: päevade arv × auto hind päevas
- broneering salvestatakse andmebaasi

## Failid
- `register.php`
- `single_car.php`
- `car_rent_dump.sql`

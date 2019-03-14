## IMEL - zadaci za testiranje uposlenih (Šesti zadatak)
Dobrodošli. Ovdje ću Vam predstaviti svoje rješenje šestog zadatka. Zadatak je realizovan korištenjem Laravel PHP Framework-a. Predstavlja jedan administratorski panel, u kojem administratori imaju mogućnost registrovanja novih, prikaz, izmjenu te brisanje: 
* Korisnika
* Objava/blogova
* Kategorija


## Sadržaj

 1. [Instalacija](#instalation)
 2. [Unos potrebnih podataka u bazu](#data)
 3. [Author](#author)
   

<a name="instalation"></a>
## Instalacija
Nakon što ste projekat klonirali ili preuzeli, prva stvar koju je potrebno uraditi jeste instalirati "composer". Da bi instalirali "composer", potrebno je unijeti sljedeću PHP komandu u terminalu (unutar direktorijuma projekta):
```php
composer install
```

Nakon što je "composer" instaliran, potrebno je kreirati novi ključ aplikacije, tako što ćete unijeti sljedeću komandu u terminal:
```php
php artisan key:generate
```

Sada je projekat spreman za dalje konfigurisanje, odnosno konfigurisanje baze podataka. Kreirajte praznu bazu podataka sa proizvoljnim imenom, te preimenujte ".env-example" u ".env", te unesite konfiguraciju Vaše baze podataka:
```php
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_mysql_username
DB_PASSWORD=your_mysql_password
```

Nakon što konfigurišete bazu podataka, sada je potrebno pokrenuti migracije svih tabela koje su unaprijed definisane. Učinite to tako što ćete u terminal ukucati sljedeću komandu:
```
php artisan migrate
```

<a name="data"></a>
## Unos potrebnih podataka u bazu
Ukoliko je migracija uspješno obavljena, sada je potrebno da unesete administratorskog korisnika, tri tipa korisnika, kao i "placeholder" sliku, kako bi pristupili administratorskom panelu, na kojem se nalaze sve funkcionalnosti ovog projekta. Da bi Vam olakšao, ja sam kreirao "seed" koji automatski kreira ove podatke za Vas. Da bi pokrenuli taj "seed", ukucajte sljedeću naredbu u terminal:

```
php artisan db:seed
```

Nakon što ste obavili sve ove korake, aplikacija je spremna za korištenje. Napomena: _Obavezno se prijaviti kao korisnik koji ima administratorska ovlaštenja, jer trenutno samo takav korisnik može pristupiti sistemu._

<a name="author"></a>
## Autor:
* Zlatan Goralija, 14.3.2019.g.
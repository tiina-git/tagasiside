# Kodu ülesanne 

See on lihtne veebileht, mis pole loomulikut teab mis asjalik, funktsionaalne või veel vähem turvaline. Aga see leht töötab, kõik mis on siin olemas. Kloonige projekt enda arvutisse ja vaadake, mis sellel lehel toimub ja kuidas töötab. Kogu "info" on koodis olemas. 

# Ülesanne

1. Loo uus andmebaas
2. Loo uus tabel vastavalt feedback.csv sisule
3. Kasuta andmebaasi ühenduseks [mysqli](https://www.php.net/manual/en/book.mysqli.php) või [PDO](https://www.php.net/manual/en/pdo.connections.php) prepare lahendust. Proovi luua klass, nagu tunnis tegime. Vihjeks Python ja SQLite ühendus.
4. Kontakt lehelt saadetav info tuleb lisada andmebaasi tabelisse mille sa eelpool tegid. Lisaks kirjutab ka csv faili. Olemasolevat csv faili sisu **ei pea** andmebaasi tabelisse lisama.
5. Admin leht **peab näitama** andmebaasist saadavat infot ja sorteeritud peab olema kuupäeva järgi. Kuupäevad veebilehel on vastavalt eesti keelele.
6. Tagasiside kirjeid peab saama ka kustutada! Muutmist **EI OLE** vaja teha, sest see on "kliendi" kommentaar. Ainult admin peab saama seda teha!

## Lisa
- Proovi logimine teha sessiooni põhiseks. Ainult parooliga.

# GitHub
Kuna õpetaja GitHubi osa jääb külge, siis Visual Code'is Terminalis anna käsklus 
```
git remote remove origin
```
sest õpetaja githubi ilma kutseta lisada ei saa, selle asemel peab olmea teie enda oma. Sellega kaob ära teil Source Control juures värviline pilve ikoon aga sinine **main** jääb alles, mis on lokaalne git.

# Tegija tegemised

Siia palun tee loetelu kõikidest asjadest mida sa tegid. Järjekord pole oluline.
* Parooli muutmine 'tiina123'

* Tegin uue SQL andmebaasi 'feedback' samanimelise tabeliga, kus on veerud (id, name,email,message,added)

* Lisasin SQL andmebaasi andmetele uue faili 'settings.php' 
 - lisasin faili .gitignore nimekirja, sest neid andmeid ei tohi avaldada

* SQL andmete saatmine
'submit_feedback.php' faili täiendus:
- sql INSERT INTO feedback...
- ühendan failid (include("settings.php");include("mysqli.php");$db = new Db();)

* SQL andmete lugemine
'admin.php' faili täiendus:
- sql SELECT FROM feedback...
- ühendan failid (include("settings.php");include("mysqli.php");$db = new Db();)

* SQL andmete kustutamine
 - lisasin uue faili 'delete_feedback.php'
 - täiendasin faili 'admin.php' nupuga
* ...


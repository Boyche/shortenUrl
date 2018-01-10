Web Aplikacija koja pruža uslugu skracivanja URL-a
Da bi aplikacija funkcionisala na vašem web serveru, potrebno je:
-	Napraviti bazu podataka sa imenom „urlshortener“ na vašem serveru i dodeliti joj korisnika „root“ bez sifre. I importovati koristeci file: „urlshortener.sql“ koji se nalazi u folderu. Ili možete importovati „urlshortener.sql“ u neku drugu bazu, ali je onda potrebno adaptirati podatke u funkciji „connectToDatabase“ koja se nalazi u datoteci functions.php kao prva.
-	Dodati Rewrite Rules koji se nalaze u .htaccess fajlu koji se nalazi u folderu Vašem .htaccess fajlu, ili da bi izbegli neželjene kolizije, možete privremeno sacuvati Vaš .htaccess i prekopirati ovaj prosledjeni kako biste testirali aplikaciju valjano.
-	Citav Folder „backend_tests“ prekopirati u root vašeg servera.
-	Web servise možete testirati onako kako ste Vi definisali u vašem zadatku, ali ...
-	Radi lakšeg upravljanja, napravio sam i jednostavan i skroman interface za korišnjenje ove web aplikacije, koji možete videti otvarajuci http://localhost/url_shortener i na njemu cete moci da testirate Rad web aplikacije. 
-	Aplikacija uzima zadati url, od njega pravi hesh dužine 8 karaktera, proverava da li dolazi do kolizije koju izbegavamo jeftinim dodavanjem nasumicnog jednocifrenog broja na hesh sve dok se ponavalja kolizija i kada je u redu pamti se poslednji kratki url.
-	Zahtevom serveru sa posaltim kratim url-om dobijamo redirekciju na pravi url koji se nalazi u bazi.
-	Ukoliko imate bilo kakva pitanja, molim Vas da ih postavite, bice mi drago da odgovorim na njih.
Bojan Milic

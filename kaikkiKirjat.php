<?php
require_once 'inc/functions.php';
require_once 'inc/headers.php';

try{
    $db=opendb();
    jsonFactory($db,"select DISTINCT(kirjaNimi), kirja.kustannus, kirja.ale, kirja.kirjaNro, kirja.luotu, sivuNro, hinta, kuvaus, kuva, julkaistu, etunimi, sukunimi, julkaisija.julkaisija, julkaisija.julkaisijaNro, kategoria.kategoria
    from kirja
        inner join kirjakategoria
            on kirja.kirjaNro = kirjakategoria.kirjaNro
        inner join kategoria
            on kirjakategoria.kategoriaNro = kategoria.kategoriaNro
        inner join julkaisija
            on kirja.julkaisijaNro = julkaisija.julkaisijaNro
        inner join kirjailijakirja
            on kirja.kirjaNro = kirjailijakirja.kirjaNro
        inner join kirjailija
            on kirjailijakirja.kirjailijaNro = kirjailija.kirjailijaNro
            group by kirja.kirjaNro");
} catch (PDOException $pdoex) {
    returnError($pdoex); 
};
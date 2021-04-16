<?php

require_once 'inc/functions.php';
require_once 'inc/headers.php';
// lue parametrit URLIsta
$url = parse_url(filter_input(INPUT_SERVER, 'PATH_INFO', FILTER_SANITIZE_NUMBER_INT), PHP_URL_PATH);
// Parametrit erotellaan /ssilla
$parametrit = explode('/', $url);
// kategoria on ensimmäinen parametri,joka seuraa osoitteen jälkeen ja eroteltu: /

$kirjaNro_id = $parametrit[0];


try {
    $db = opendb();
    jsonFactory($db, "select DISTINCT(kirjaNimi), kirja.kirjaNro, sivuNro, hinta, kuvaus, kuva, YEAR(julkaistu) AS julkaistu, etunimi, sukunimi, julkaisija.julkaisija, kategoria.kategoria
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
    where kirja.kirjaNro=$kirjaNro_id group by kirja.kirjaNimi");
} catch (PDOException $pdoex) {
    returnError($pdoex);
};
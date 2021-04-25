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
    jsonFactory($db, "select kirjaNimi, kirja.kirjaNro, sivuNro, hinta, kustannus, kuvaus, kuva, YEAR(julkaistu) AS julkaistu, DATE_FORMAT(julkaistu, '%Y-%m-%d') AS pvmJulkaistu, etunimi, sukunimi, julkaisija.julkaisija, kategoria.kategoria, IFNULL(AVG(arvosana), 0) as arvosana
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
        left outer join arvostelu
            on kirja.kirjaNro = arvostelu.kirjaNro
    where kirja.kirjaNro=$kirjaNro_id group by kirja.kirjaNimi");
} catch (PDOException $pdoex) {
    returnError($pdoex);
};

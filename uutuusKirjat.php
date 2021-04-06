<?php

require_once 'inc/functions.php';
require_once 'inc/headers.php';

$input = json_decode(file_get_contents('php://input'));

try{
    $db=opendb();
    jsonFactory($db,"select DISTINCT(kirjaNimi), sivuNro, hinta, kuvaus, kuva, YEAR(julkaistu) as 'vuosi', etunimi, sukunimi, julkaisija.julkaisija, kategoria.kategoria
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
    GROUP BY kirjaNimi
    HAVING vuosi =" . date("Y") . "");
} catch (PDOException $pdoex) {
    returnError($pdoex); 
}
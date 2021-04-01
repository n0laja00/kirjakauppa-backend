<?php

require_once 'inc/functions.php';
require_once 'inc/headers.php';

$input = json_decode(file_get_contents('php://input'));
$book1 = filter_var($input-> $_GET['kirja1'],FILTER_SANITIZE_STRING);
$book2 = filter_var($input-> $_GET['kirja2'],FILTER_SANITIZE_STRING);
$book3 = filter_var($input-> $_GET['kirja3'],FILTER_SANITIZE_STRING);
$book4 = filter_var($input-> $_GET['kirja4'],FILTER_SANITIZE_STRING);

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
    HAVING kirjaNimi IN ('" . 
     $book1 . "','" . $book2 . "','" . $book3 . "','" . $book4 . "')");
} catch (PDOException $pdoex) {
    returnError($pdoex); 
}
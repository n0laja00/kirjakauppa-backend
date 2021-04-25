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
    jsonFactory($db, "SELECT kategoria.kategoria, kategoria.kategoriaNro
    FROM kirja INNER JOIN kirjakategoria 
    	ON kirja.kirjaNro = kirjakategoria.kirjaNro
    INNER JOIN kategoria 
        ON kategoria.kategoriaNro = kirjakategoria.kategoriaNro
    WHERE kirja.kirjaNro = $kirjaNro_id");
} catch (PDOException $pdoex) {
    returnError($pdoex);
};



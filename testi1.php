<?php

require_once 'inc/functions.php';
require_once 'inc/headers.php';




// lue parametrit URLIsta
$url = parse_url(filter_input(INPUT_SERVER,'PATH_INFO'), PHP_URL_PATH);
// Parametrit erotellaan /ssilla
$parametrit = explode('/',$url);
// kategoria on ensimmäinen parametri,joka seuraa osoitteen jälkeen ja eroteltu: /



$testi = " in (".$parametrit[1].implode(", ", $parametrit).")";



try {
    $db = opendb();
    jsonFactory($db,"select * from kirjakategoria where kategoriaNro $testi");

} catch (PDOException $pdoex) {
    returnError($pdoex);
};
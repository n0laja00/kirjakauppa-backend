<?php
require_once 'inc/functions.php';
require_once 'inc/headers.php';

$uri = parse_url(filter_input(INPUT_SERVER,'PATH_INFO'),PHP_URL_PATH);
$parameters = explode('/',$uri);
$criteria = $parameters[1];

$uri2 = parse_url(filter_input(INPUT_SERVER,'PATH_INFO'),PHP_URL_PATH);
$parameters2 = explode(" ",$criteria);
$criteria2 = $parameters2[0];


try {
    $db = openDb();
    $sql = "select DISTINCT(kirjaNimi), kirja.kirjaNro, sivuNro, hinta, kuvaus, kuva, julkaistu, etunimi, sukunimi, julkaisija.julkaisija, kategoria.kategoria
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
        where kirja.kirjaNimi like '%$criteria%' OR kirjailija.etunimi like '%$criteria2%'
        group by kirja.kirjaNro";
    
    
        

    jsonFactory($db, $sql);
} 
catch (PDOException $pdoex) {
    returnError($pdoex);
}
<?php

require_once 'inc/functions.php';
require_once 'inc/headers.php';

try{
    $db=opendb();
    jsonFactory($db,"select DISTINCT(kirjaNimi), kirja.kirjaNro, sivuNro, hinta, kuvaus, kuva, julkaistu, etunimi, sukunimi, julkaisija.julkaisija, kategoria.kategoria
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
            on kirjailijakirja.kirjailijaNro = kirjailija.kirjailijaNro");
} catch (PDOException $pdoex) {
    returnError($pdoex); 
};

/*
$sql="select * from kirja";
$query =$db->query($sql); 
$results = $query->fetchAll(PDO::FETCH_ASSOC); 

header('http/1.1 200 OK');
echo json_encode($results, JSON_PRETTY_PRINT); */
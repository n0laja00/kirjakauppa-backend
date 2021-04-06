<?php
require_once 'inc/functions.php';
require_once 'inc/headers.php';


$uri = parse_url(filter_input(INPUT_SERVER,'PATH_INFO'),PHP_URL_PATH);
$parameters = explode('/',$uri);
$criteria = $parameters[1];


$id = '3';

try{
    $db=opendb(); 

    $sql="SELECT kirjaNimi, kirja.kirjaNro, sivuNro, hinta, ale, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu, luotu, kategoria 
    FROM kirja, kirjakategoria, kategoria
    WHERE kirja.kirjanro=kirjakategoria.kirjanro AND
    kirjakategoria.kategoriaNro=kategoria.kategoriaNro AND
    kirjakategoria.kategoriaNro = $criteria";

    jsonFactory($db, $sql); 

    /*$sql="SELECT kategoria FROM kategoria WHERE kategoriaNro = :kategoriaId";

    $query2 =$db->query($sql2); 
    $result2 = $query2->fetchAll(PDO::FETCH_ASSOC);

    
    header('http/1.1 200 OK');
    echo json_encode($result, JSON_PRETTY_PRINT); */
} catch (PDOException $pdoex) {
    returnError($pdoex);  
}
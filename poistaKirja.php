<?php
require_once 'inc/headers.php';
require_once 'inc/functions.php';

$bookNr = filter_input(INPUT_POST, 'bookNr',FILTER_SANITIZE_NUMBER_INT);


try{
    $db = openDb();
    $query = $db->prepare("DELETE FROM kirjailijakirja WHERE kirjaNro = :kirjaNro;
    DELETE FROM kirjakategoria WHERE kirjaNro = :kirjaNro;
    DELETE FROM kirja WHERE kirjaNro = :kirjaNro;");

    $query->bindValue(':kirjaNro',$bookNr,PDO::PARAM_INT);
    $query->execute();

} catch(PDOException $pdoex) {
    returnError($pdoex);
}
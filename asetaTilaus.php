<?php

require_once 'inc/functions.php';
require_once 'inc/headers.php';

$json = file_get_contents('php://input');
$input=json_decode($json);
$cart=json_decode($json, true);

$asEtunimi = filter_var($input->asEtunimi, FILTER_SANITIZE_STRING);
$asSukunimi = filter_var($input->asSukunimi, FILTER_SANITIZE_STRING);
$email = filter_var($input->email, FILTER_SANITIZE_EMAIL);
$puhNro = filter_var($input->puhNro, FILTER_SANITIZE_NUMBER_INT);
$yritys = filter_var($input->yritys, FILTER_SANITIZE_STRING);
$lahiosoite = filter_var($input->lahiosoite, FILTER_SANITIZE_STRING);
$postitmp = filter_var($input->postitmp, FILTER_SANITIZE_STRING);
$postiNro = filter_var($input->postiNro, FILTER_SANITIZE_STRING);
$ostoskori = filter_var_array($cart['ostoskori'], FILTER_SANITIZE_NUMBER_INT);

$toimitustapa='v';
$maksutapa='v';

try{
    $db = opendb();
    $query = $db->prepare("insert into asiakas(asEtunimi, asSukunimi, lahiosoite, postiNro, puhNro, email, yritys) values (:asEtunimi, :asSukunimi, :lahiosoite, :postiNro, :puhNro, :email, :yritys)");
    $query->bindValue(':asEtunimi', $asEtunimi,  PDO::PARAM_STR);
    $query->bindValue(':asSukunimi', $asSukunimi,  PDO::PARAM_STR);
    $query->bindValue(':lahiosoite', $lahiosoite,  PDO::PARAM_STR);
    $query->bindValue(':postiNro', $postiNro, PDO::PARAM_INT);
    $query->bindValue(':puhNro', $puhNro, PDO::PARAM_INT);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->bindValue(':yritys', $yritys, PDO::PARAM_STR);
    $query->execute();

    $asiakas_id = $db->lastInsertId();

    $query = $db->prepare("insert into tilaus(asNro, toimitustapa, maksutapa, postitmp, postiNro, lahiosoite) values (:asNro, :toimitustapa, :maksutapa, :postitmp, :postiNro, :lahiosoite)");
    $query->bindValue(':toimitustapa', $toimitustapa,  PDO::PARAM_STR);
    $query->bindValue(':maksutapa', $maksutapa, PDO::PARAM_STR);
    $query->bindValue(':asNro', $asiakas_id, PDO::PARAM_STR);
    $query->bindValue(':postitmp', $postitmp, PDO::PARAM_STR);
    $query->bindValue(':postiNro', $postiNro, PDO::PARAM_INT);
    $query->bindValue(':lahiosoite', $lahiosoite, PDO::PARAM_STR);
    $query->execute();

    $tilaus_id = $db->lastInsertId();
    $riviNro = 1;
    foreach($ostoskori as $product) {
        $kirjaNro = $product['kirjaNro'];
        $maara = $product['maara'];
        $query = $db->prepare("insert into tilausrivi (tilausNro, riviNro, kirjaNro, kpl) values (:tilausNro, :riviNro, :kirjaNro, :kpl)");
        $query->bindValue(':tilausNro', $tilaus_id,  PDO::PARAM_INT);
        $query->bindValue(':riviNro', $riviNro,  PDO::PARAM_INT);
        $query->bindValue(':kirjaNro', $kirjaNro,  PDO::PARAM_INT);
        $query->bindValue(':kpl', $maara,  PDO::PARAM_INT);
        $query->execute();
        $riviNro=$riviNro+1;
    };

    header('HTTP/1.1 200 OK');

}catch(PDOException $pdoex){
    returnError($pdoex);
}


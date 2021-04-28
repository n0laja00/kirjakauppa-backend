<?php
require_once 'inc/functions.php';
require_once 'inc/headers.php';
$input= json_decode(file_get_contents('php://input'));
$tilausnro = filter_var($input->tilausNro, FILTER_SANITIZE_NUMBER_INT);
$toimitusTila = filter_var($input->toimitusTila, FILTER_SANITIZE_STRING);
$maksettu = filter_var($input->maksettu, FILTER_SANITIZE_STRING);

try {
    $db = opendb();
    $query=$db->prepare("UPDATE tilaus SET toimitusTila = :toimitusTila, maksettu = :maksettu WHERE tilausNro = :tilausnro");
    $query->bindValue(":tilausnro", $tilausnro, PDO::PARAM_INT);
    $query->bindValue(":toimitusTila", $toimitusTila, PDO::PARAM_STR);
    $query->bindValue(":maksettu", $maksettu, PDO::PARAM_STR);
    $query->execute();

    header('HHTP/1.1 200 OK'); 
    $data = array('tilausnro' => $tilausnro); 
    echo json_encode($data); 

} catch(PDOException $pdoex) {
    returnError($pdoex);
}
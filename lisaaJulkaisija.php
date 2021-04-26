<?php
require_once 'inc/headers.php';
require_once 'inc/functions.php';

$publisher = filter_input(INPUT_POST, 'publisher',FILTER_SANITIZE_STRING);
$phonenumber = filter_input(INPUT_POST, 'phonenumber',FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email',FILTER_SANITIZE_STRING);

try {
    $db = opendb();

    $query = $db->prepare("REPLACE INTO julkaisija (julkaisija, puhNro, email) VALUES (:julkaisija, :puhNro, :email);");
    $query->bindValue(':julkaisija', $publisher, PDO::PARAM_STR);
    $query->bindValue(':puhNro', $phonenumber, PDO::PARAM_STR);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->execute();

    echo json_encode($data);

} catch (PDOException $pdoex) {
    returnError($pdoex);
}

?>
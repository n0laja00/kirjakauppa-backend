<?php
require_once 'inc/headers.php';
require_once 'inc/functions.php';

$category = filter_input(INPUT_POST, 'category',FILTER_SANITIZE_STRING);


try {
    $db = opendb();

    $query = $db->prepare("REPLACE INTO kategoria (kategoria) VALUES (:kategoria);");
    $query->bindValue(':kategoria', $category, PDO::PARAM_STR);
    $query->execute();

    echo json_encode($data);

} catch (PDOException $pdoex) {
    returnError($pdoex);
}

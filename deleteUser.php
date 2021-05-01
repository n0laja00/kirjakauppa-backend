<?php
require_once 'inc/functions.php';
require_once 'inc/headers.php';


$input = json_decode(file_get_contents('php://input'));
$id = filter_var($input->id,FILTER_SANITIZE_NUMBER_INT);

try {
    $db = openDb();
    $query = $db->prepare('DELETE FROM user WHERE id=(:id)');
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->execute();

    header('HTTP/1.1 200 OK');
    $data = array('id' => $id);
    echo json_encode($data);
} 
catch (PDOException $pdoex) {
    returnError($pdoex);
}
<?php

require_once 'inc/functions.php';
require_once 'inc/headers.php';
$input= json_decode(file_get_contents('php://input'));
$tilausnro = filter_var($input->tilausNro, FILTER_SANITIZE_NUMBER_INT);

try{
    $db = opendb();
    $query = $db->prepare('delete from tilausrivi where tilausNro=(:tilausnro)');
    $query -> bindValue(':tilausnro',$tilausnro,PDO::PARAM_INT);
    $query->execute();

    $query = $db->prepare('delete from tilaus where tilausNro=(:tilausnro)');
    $query -> bindValue(':tilausnro',$tilausnro,PDO::PARAM_INT);
    $query->execute();
    
    header('HHTP/1.1 200 OK'); 
    $data = array('tilausnro' => $tilausnro); 
    echo json_encode($data); 
    
} catch (PDOexception $pdoex){
    returnError($pdoex);
}
<?php

require_once 'inc/functions.php';
require_once 'inc/header.php';

try{
    $db=opendb();

    $sql="select * from kirja";
    $query =$db->query($sql); 
    $result = $query->fetchAll(PDO::FETCH_ASSOC); 

    
    print_r($result);
    header('http/1.1 200 OK');
    echo json_encode($result); 
} catch (PDOException $pdoex) {
    returnError($pdoex); 
}

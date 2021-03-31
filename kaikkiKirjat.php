<?php

require_once 'inc/functions.php';
require_once 'inc/header.php';

try{
    $db=opendb();

    $sql="select * from kirja";
    $query =$db->query($sql); 
    $result = $query->fetchAll(PDO::FETCH_ASSOC); 

    
    header('http/1.1 200 OK');
    echo json_encode($result, JSON_PRETTY_PRINT); 
} catch (PDOException $pdoex) {
    returnError($pdoex); 
}

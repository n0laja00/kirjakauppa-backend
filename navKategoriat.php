<?php
require_once 'inc/functions.php';
require_once 'inc/headers.php';

try{
    $db=opendb(); 
    
    $sql="SELECT * FROM kategoria";

    jsonFactory($db, $sql); 
} catch (PDOException $pdoex) {
    returnError($pdoex);  
}
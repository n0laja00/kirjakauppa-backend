<?php

require_once 'inc/functions.php';
require_once 'inc/headers.php';

$input = json_decode(file_get_contents('php://input'));

try{
    $db=opendb();
    jsonFactory($db,"SELECT * FROM julkaisija");
} catch (PDOException $pdoex) {
    returnError($pdoex); 
}
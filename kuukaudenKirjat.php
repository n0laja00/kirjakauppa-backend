<?php

require_once 'inc/functions.php';
require_once 'inc/headers.php';

try{
    $db=opendb();
    jsonFactory($db,"select * FROM kuukaudenkirjat");
} catch (PDOException $pdoex) {
    returnError($pdoex); 
}
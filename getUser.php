<?php
require_once 'inc/functions.php';
require_once 'inc/headers.php';


$uri = parse_url(filter_input(INPUT_SERVER,'PATH_INFO'),PHP_URL_PATH);
$parameters = explode('/',$uri);
$id = $parameters[1];

try{
    $db=opendb(); 

    $sql="SELECT id, fname, lname, password from user WHERE id = $id ";

    jsonFactory($db, $sql); 

} catch (PDOException $pdoex) {
    returnError($pdoex);  
}
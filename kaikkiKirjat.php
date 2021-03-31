<?php

require_once 'inc/functions.php';
require_once 'inc/headers.php';

try{
    $db=opendb();
    jsonFactory($db,"select * from kirja");
    jsonFactory($db,"select * from kirjailija");
    jsonFactory($db,"select * from jurlkaisija");

} catch (PDOException $pdoex) {
    returnError($pdoex); 
}

/*
$sql="select * from kirja";
$query =$db->query($sql); 
$results = $query->fetchAll(PDO::FETCH_ASSOC); 

header('http/1.1 200 OK');
echo json_encode($results, JSON_PRETTY_PRINT); */
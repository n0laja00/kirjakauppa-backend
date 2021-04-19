<?php
require_once 'inc/functions.php';
require_once 'inc/headers.php';

try {
    $db = openDb();
    $sql = "select kirjaNro, kirjaNimi from kirja";
    jsonFactory($db, $sql);
} 
catch (PDOException $pdoex) {
    returnError($pdoex);
}
<?php

require_once 'inc/functions.php';
require_once 'inc/headers.php';

try{
    $db = opendb();
    jsonFactory($db, "select * from tilaus inner join tilausrivi on tilaus.tilausNro = tilausrivi.tilausNro");
} catch (PDOexception $pdoex){
    returnError($pdoex);
}
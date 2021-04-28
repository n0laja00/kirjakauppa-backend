<?php

require_once 'inc/functions.php';
require_once 'inc/headers.php';

try{
    $db = opendb();
    jsonFactory($db, "select tilaus.asNro, tilaus.tilausNro, toimitustapa, maksutapa, maksettu, toimitusTila, tilaus.postitmp AS 'toimitusPostitmp', tilaus.postiNro AS 'toimitusPostiNro', tilaus.lahiosoite AS 'toimitusOsoite', asEtunimi, asSukunimi, asiakas.postitmp, asiakas.postiNro, asiakas.lahiosoite, puhNro, email, yritys from tilaus inner join asiakas on tilaus.asNro = asiakas.asNro");
} catch (PDOexception $pdoex){
    returnError($pdoex);
}
<?php
session_start();
require_once 'inc/headers.php';
require_once 'inc/functions.php';



if (!isset($_SESSION['user'])) {
    header('HTTP/1.1 401 Unauthorized');
    exit;
}

$data = array('message' => "Ylläpitäjän käyttöoikeudet puuttuvat.");
echo json_encode($data);
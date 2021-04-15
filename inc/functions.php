<?php


function opendb() {
    $dbname="kirjakauppa";
    
    $db = new PDO ("mysql:host=localhost;dbname=$dbname", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    return $db;
};

function returnError(PDOException $pdoex) {
    echo header('http/1.1 500 Internal Server Error'); 
    $error= array('error' => $pdoex -> getMessage());
    echo json_encode($error); 
    exit;
};

function returnCustomError(string $message): void {
    header('HTTP/1.1 500 Internal Server Error');
    $error = array('error' => $message);
    echo json_encode($error);
    exit;
  }


function jsonFactory(object $db, string $sql): void {
    $query = $db->query($sql);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    header('http/1.1 200 OK');
    echo json_encode($results, JSON_PRETTY_PRINT); 
}

function imageResize($imageResourceId,$width,$height) {


    $targetWidth = 615;
    $targetHeight = 908;


    $targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
    imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);


    return $targetLayer;
}
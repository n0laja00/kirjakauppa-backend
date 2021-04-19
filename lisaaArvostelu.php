<?php
require_once 'inc/functions.php';
require_once 'inc/headers.php';

$input = json_decode(file_get_contents('php://input'));
$name = filter_var($input->nimimerkki, FILTER_SANITIZE_STRING);
$title = filter_var($input->otsikko, FILTER_SANITIZE_STRING);
$text = filter_var($input->teksti, FILTER_SANITIZE_STRING);
$bookId = filter_var($input->kirjaNro, FILTER_SANITIZE_NUMBER_INT);
$rating = filter_var($input->arvosana, FILTER_SANITIZE_NUMBER_INT);


try {
    $db = opendb();

    $query = $db->prepare("insert into arvostelu(nimimerkki, otsikko, teksti, kirjaNro, arvosana) values (:nimimerkki, :otsikko, :teksti, :kirjaNro, :arvosana)");
    $query->bindValue(':nimimerkki', $name, PDO::PARAM_STR);
    $query->bindValue(':otsikko', $title, PDO::PARAM_STR);
    $query->bindValue(':teksti', $text, PDO::PARAM_STR);
    $query->bindValue(':kirjaNro', $bookId, PDO::PARAM_INT);
    $query->bindValue(':arvosana', $rating, PDO::PARAM_INT);
    $query->execute();

    $data = array('arvosteluNro' => $db->lastInsertId(), 'nimimerkki' => $name, 'otsikko' => $title, 'teksti' => $text, 'arvosana' => $rating);
    header('HTTP/1.1 200 OK');
    echo json_encode($data);


} catch (PDOException $pdoex) {
    returnError($pdoex);
}

?>
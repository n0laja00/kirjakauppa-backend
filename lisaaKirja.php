<?php 
require_once 'inc/functions.php';
require_once 'inc/headers.php';

$input = json_decode(file_get_contents('php://input'));
$bookName = filter_var($input->bookName,FILTER_SANITIZE_STRING);
$bookDesc = filter_var($input->bookDesc,FILTER_SANITIZE_STRING);
$bookWriterFN = filter_var($input->bookWriterFN,FILTER_SANITIZE_STRING);
$bookWriterLN = filter_var($input->bookWriterLN,FILTER_SANITIZE_STRING);
$bookPublishDate = filter_var($input->bookPublished,FILTER_SANITIZE_STRING);
$bookPage = filter_var($input->bookPage,FILTER_SANITIZE_NUMBER_INT);
$bookPrice = filter_var($input->bookPrice,FILTER_SANITIZE_NUMBER_INT);
$bookExpense = filter_var($input->bookExpense,FILTER_SANITIZE_NUMBER_INT);
$bookPublisherNo = filter_var($input->publisherNo,FILTER_SANITIZE_NUMBER_INT);
$bookPublishDate = filter_var($input->bookPublished,FILTER_SANITIZE_STRING);
$bookPicture = "eka.png";


try {
    $db = openDb();
    jsonFactory($db,"INSERT INTO kirja(kirjaNimi, sivuNro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu) 
    VALUES (:kirjaNimi, :sivuNro, :hinta, :kustannus, :kuvaus, :kuva, :julkaisijaNro, :julkaistu);
    REPLACE INTO kirjailija(etunimi, sukunimi) VALUES (:etunimi, :sukunimi); INSERT INTO kirjailijakirja VALUES(
        (SELECT kirjaNro FROM kirja WHERE kirjaNimi = :kirjaNimi), (SELECT kirjailijaNro FROM kirjailija 
        WHERE etunimi=:etunimi AND sukunimi=:sukunimi))");
    $query->bindValue(':kirjaNimi',$bookName,PDO::PARAM_STR);
    $query->bindValue(':kuvaus',$bookDesc,PDO::PARAM_STR);
    $query->bindValue(':etunimi',$bookWriterFN,PDO::PARAM_STR);
    $query->bindValue(':sukunimi',$bookWriterLN,PDO::PARAM_STR);
    $query->bindValue(':kuva',$bookPicture,PDO::PARAM_STR);
    $query->bindValue(':sivuNro',$bookPage,PDO::PARAM_INT);
    $query->bindValue(':hinta',$bookPrice,PDO::PARAM_INT);
    $query->bindValue(':kustannus',$bookExpense,PDO::PARAM_INT);
    $query->bindValue(':julkaisijaNro',$bookPublisherNo,PDO::PARAM_INT);
    $query->bindValue(':julkaistu',$bookPublishDate,PDO::PARAM_STR);
    $query->execute();

} catch(PDOException $pdoex) {
    returnError($pdoex);
}

?>
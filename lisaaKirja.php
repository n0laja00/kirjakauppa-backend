<?php 
require_once 'inc/functions.php';
require_once 'inc/headers.php';

$input = json_decode(file_get_contents('php://input'));
$bookName = filter_var($input->bookName,FILTER_SANITIZE_STRING);
$bookDesc = filter_var($input->bookDesc,FILTER_SANITIZE_STRING);
$bookPage = filter_var($input->bookPage,FILTER_SANITIZE_NUMBER_INT);
$bookPrice = filter_var($input->bookPrice,FILTER_SANITIZE_NUMBER_INT);
$bookExpense = filter_var($input->bookExpense,FILTER_SANITIZE_NUMBER_INT);
$bookPublisherNo = filter_var($input->publisherNo,FILTER_SANITIZE_NUMBER_INT);
$bookPublishDate = filter_var($input->bookPublished,FILTER_SANITIZE_STRING);
$bookPicture = "eka.png";


try {
    $db = openDb();
    jsonFactory($db,"insert into kirja(kirjaNimi, sivuNro, hinta, kustannus, kuvaus, kuva, julkaisijaNro, julkaistu) 
    values (:kirjaNimi, :sivuNro, :hinta, :kustannus, :kuvaus, :kuva, :julkaisijaNro, :julkaistu)");
    $query->bindValue(':kirjaNimi',$bookName,PDO::PARAM_STR);
    $query->bindValue(':kuvaus',$bookDesc,PDO::PARAM_STR);
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
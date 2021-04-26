<?php
require_once 'inc/headers.php';
require_once 'inc/functions.php';

$bookName = filter_input(INPUT_POST, 'bookName',FILTER_SANITIZE_STRING);
$bookNo = filter_input(INPUT_POST, 'bookNo',FILTER_SANITIZE_NUMBER_INT);
$bookDesc = filter_input(INPUT_POST, 'bookDesc',FILTER_SANITIZE_STRING);
$bookWriterFN = filter_input(INPUT_POST, 'bookWriterFN',FILTER_SANITIZE_STRING);
$bookWriterLN = filter_input(INPUT_POST, 'bookWriterLN',FILTER_SANITIZE_STRING);
$bookPublishDate = filter_input(INPUT_POST, 'bookPublished',FILTER_SANITIZE_STRING);
$bookPage = filter_input(INPUT_POST, 'bookPage',FILTER_SANITIZE_NUMBER_INT);
$bookPrice = filter_input(INPUT_POST, 'bookPrice',FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$bookExpense = filter_input(INPUT_POST, 'bookExpense',FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$bookPublisher = filter_input(INPUT_POST, 'publisher',FILTER_SANITIZE_STRING);
$bookPublishDate = filter_input(INPUT_POST, 'bookPublished',FILTER_SANITIZE_STRING);
$bookCategory =  filter_input(INPUT_POST, 'bookCategory',FILTER_SANITIZE_STRING);
$extraCategories = array(
  "category2" => filter_input(INPUT_POST, 'bookCategory2',FILTER_SANITIZE_STRING),
  "category3" => filter_input(INPUT_POST, 'bookCategory3',FILTER_SANITIZE_STRING),
  "category4" => filter_input(INPUT_POST, 'bookCategory4',FILTER_SANITIZE_STRING),
);

$bookUpdateSQL = ",kuva = :kuva";

if ($bookCategory === '') {
  returnCustomError('Valitse kirjakategoria!');
}

try{

  if (isset($_FILES['file'])) {
    if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
      $filename = $_FILES['file']['name'];
      $type = $_FILES['file']['type'];
      
  
      if ($type === 'image/png')  {
        $path = 'img/' . basename($filename);
  
        if (move_uploaded_file($_FILES['file']['tmp_name'],$path)) {
          $data = array('filename' => $filename,'type' => $type);
          echo json_encode($data);

        } else {
          returnCustomError('Virhe kuvan tallentamisessa tietokantaan');
        }
      } else {  
        returnCustomError('Käytä .PNG tyyppiä kuvissa!');
      }
    } else {
      returnCustomError('Virhe tiedostoa tallentaessa');
    }
  } else {
    $bookUpdateSQL = "";
  }

  $db = openDb();

  $query = $db->prepare("UPDATE kirja SET kirjaNimi = :kirjaNimi, sivuNro = :sivuNro, hinta = :hinta, kustannus = :kustannus, kuvaus = :kuvaus, julkaistu = :julkaistu,  julkaisijaNro =  (SELECT julkaisijaNro FROM julkaisija WHERE julkaisija= :julkaisija) $bookUpdateSQL 
  WHERE kirjaNro = :kirjaNro;
  UPDATE kirjailija SET etunimi = :etunimi, sukunimi = :sukunimi; UPDATE kirjailijakirja SET kirjaNro = (SELECT kirjaNro FROM kirja WHERE kirjaNimi = :kirjaNimi), kirjailijaNro = (SELECT kirjailijaNro FROM kirjailija
      WHERE etunimi=:etunimi AND sukunimi=:sukunimi);
  UPDATE kirjakategoria SET kirjaNro = (SELECT kirjaNro FROM kirja WHERE kirjaNimi = :kirjaNimi), kategoriaNro = (SELECT kategoriaNro FROM kategoria WHERE kategoria = :kategoria)");

  $query->bindValue(':kirjaNimi',$bookName,PDO::PARAM_STR);
  $query->bindValue(':kirjaNro',$bookNo,PDO::PARAM_INT);
  $query->bindValue(':kuvaus',$bookDesc,PDO::PARAM_STR);
  $query->bindValue(':etunimi',$bookWriterFN,PDO::PARAM_STR);
  $query->bindValue(':sukunimi',$bookWriterLN,PDO::PARAM_STR);
  if ($bookUpdateSQL !== "") {
  $query->bindValue(':kuva',$filename,PDO::PARAM_STR);
  }
  $query->bindValue(':sivuNro',intval($bookPage),PDO::PARAM_INT);
  $query->bindValue(':hinta',$bookPrice,PDO::PARAM_STR); // PARAM_INT ei toimi desimaalien kanssa
  $query->bindValue(':kustannus',$bookExpense,PDO::PARAM_STR);
  $query->bindValue(':julkaisija',$bookPublisher,PDO::PARAM_STR);
  $query->bindValue(':julkaistu',$bookPublishDate,PDO::PARAM_STR);
  $query->bindValue(':kategoria',$bookCategory,PDO::PARAM_STR);
  $query->execute();
  

  foreach($extraCategories as $value) {
    if ($value !== 'undefined') {
      $query = $db->prepare("INSERT INTO kirjakategoria VALUES((SELECT kirjaNro FROM kirja WHERE kirjaNimi = :kirjaNimi),
      (SELECT kategoriaNro FROM kategoria WHERE kategoria = :kategoria2))");
      $query->bindValue(':kirjaNimi',$bookName,PDO::PARAM_STR);
      $query->bindValue(':kategoria2',$value,PDO::PARAM_STR);
      $query->execute();
    }
  }

} catch(PDOException $pdoex) {
  returnError($pdoex);
}
<?php
session_start();
require_once 'inc/headers.php';
require_once 'inc/functions.php';

$username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);

$sql = "select * from user where username='$username'";

try {
  $db = openDb();
  $query = $db->query($sql);
  $user = $query->fetch(PDO::FETCH_OBJ);
  if ($user) {
    $passwordFromDb = $user->password;
    if (password_verify($password,$passwordFromDb)) {
      header('HTTP/1.1 200 OK');
      $data = array(
        'id' => $user->id,
        'fname' => $user->fname,
        'lname' => $user->lname
      );
      $_SESSION['user'] = $user;
    } else {
      header('HTTP/1.1 401 Unauthorized');
      $data = array('message' => "Kirjautuminen epäonnistui. Tarkista käyttäjänimi ja salasana.");
    }
  } else {
    header('HTTP/1.1 401 Unauthorized');
    $data = array('message' => "Kirjautuminen epäonnistui. Tarkista käyttäjänimi ja salasana.");
   }

  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex); 
}
?>
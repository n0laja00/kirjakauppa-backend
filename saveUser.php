<?php
require_once 'inc/functions.php';
require_once 'inc/headers.php';

$input = json_decode(file_get_contents('php://input'));
$fname = filter_var($input->fname,FILTER_SANITIZE_STRING);
$lname = filter_var($input->lname,FILTER_SANITIZE_STRING);
$email = filter_var($input->email,FILTER_SANITIZE_STRING);
$getPassword = filter_var($input->password,FILTER_SANITIZE_STRING);
$password = password_hash($getPassword,PASSWORD_DEFAULT);

try{
    $db=opendb(); 

    $sql = "insert into user(fname,lname,email,password)
    values ('$fname','$lname','$email','$password')";

    jsonFactory($db, $sql); 

} catch (PDOException $pdoex) {
    returnError($pdoex);  
}

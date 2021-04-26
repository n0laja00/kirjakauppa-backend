<?php
    $fname = "Admin";
    $lname = "käyttäjä";
    $email = "admin.user.0988";
    $password = password_hash("saariselanritari123",PASSWORD_DEFAULT);

    $sql = "insert into user(fname,lname,email,password)
    values ('$fname','$lname','$email','$password')";
    echo $sql;






?>
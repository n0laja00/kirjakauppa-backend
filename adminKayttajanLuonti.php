<?php
    $fname = "Verkkokaupan";
    $lname = "ylläpitäjä";
    $username = "ylläpitäjä";
    $password = password_hash("saariselanritari123",PASSWORD_DEFAULT);

    $sql = "insert into user(fname,lname,username,password)
    values ('$fname','$lname','$username','$password')";
    echo $sql;






?>
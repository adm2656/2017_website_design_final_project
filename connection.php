<?php

    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "team10";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if(!$conn){
        die("Connection failed :" . mysqli_connect_error());
    }

    mysqli_query($conn, "set names utf8")
?>
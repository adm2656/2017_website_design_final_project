<?php

    $servername = "140.123.175.101";//上線後改為localhost
    $username = "team10";
    $password = "juice";
    $dbname = "team10";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if(!$conn){
        die("Connection failed :" . mysqli_connect_error());
    }

    mysqli_query($conn, "set names utf8")
?>
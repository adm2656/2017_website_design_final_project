<?php
    include "connection.php";
    session_start();
    $Des = $_POST["destination"];
    $total = $_POST["total"];

    $sql = "INSERT INTO ticket (destination, quantity, sale) VALUES ('$Des', '$total', '0')";

    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Add success');</script>";
        header("Refresh: 0; url=backstage.php" );
        mysqli_close($conn);
    }
    else{
        echo "<script>alert('Somthing just go wrong');</script>";
        header("Refresh: 0; url=backstage.php" );
        mysqli_close($conn);
    }
?>
<?php
    include "connection.php";
    session_start();

    $account = $_SESSION['email'];
    $getaccountid = "SELECT user_id FROM user WHERE account = '$account'";
    
    $row = (mysqli_fetch_array(mysqli_query($conn, $getaccountid)));
    $user_id = $row["user_id"];
    $remove_id = $_POST["remove_id"];
    $removesql = "DELETE FROM cart_info WHERE cart_id = '$user_id' and cart_info_id = '$remove_id'";
    mysqli_query($conn, $removesql);
    echo "<script>alert('Remove success');</script>";
    header("Refresh: 0; url=Cart.php" );
    mysqli_close($conn);
?>
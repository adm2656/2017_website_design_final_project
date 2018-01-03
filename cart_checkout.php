<?php
    include "connection.php";
    session_start();

    $account = $_SESSION['email'];
    $getaccountid = "SELECT user_id FROM user WHERE account = '$account'";

    $row = (mysqli_fetch_array(mysqli_query($conn, $getaccountid)));
    $user_id = $row["user_id"];
    $checkout_id = $_POST["checkout_id"];

    $cartinfo = "SELECT ticket_id, amount FROM cart_info WHERE cart_info_id = '$checkout_id'";
    $getcartinfo = (mysqli_fetch_array(mysqli_query($conn, $cartinfo)));
    $ticket_id = $getcartinfo["ticket_id"];
    $amount = $getcartinfo["amount"];

    $cart = "SELECT cart_id FROM cart WHERE owner_id = '$user_id'";
    $getcartid = mysqli_fetch_array(mysqli_query($conn, $cart));
    $cart_id = $getcartid['cart_id'];

    $checkout = "DELETE FROM cart_info WHERE cart_id = '$cart_id' and cart_info_id = '$checkout_id'";
    mysqli_query($conn, $checkout);

    $addtorecord = "INSERT INTO record (buyer_id, ticket_id, amount) VALUES ('$user_id', '$ticket_id', $amount)";
    mysqli_query($conn, $addtorecord);

    echo "<script>alert('Chcekout success');</script>";
    header("Refresh: 0; url=Member.php" );
    mysqli_close($conn);
?>
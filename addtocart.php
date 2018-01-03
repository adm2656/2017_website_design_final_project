<?php
    include "connection.php";
    session_start();

    if(isset($_POST['ticket_id'])){
        if(isset($_SESSION['email'])){
            $account = $_SESSION['email'];
            $ticket_id = $_POST['ticket_id'];
            $select = $_POST['select' .$ticket_id. ''];

            $getuser_id = "SELECT user_id FROM user WHERE account = '$account'";
            $row = mysqli_fetch_array(mysqli_query($conn, $getuser_id));
            $user_id = $row['user_id'];

            $cartinfo ="SELECT * FROM cart_info WHERE cart_id = '$user_id' and ticket_id = '$ticket_id'";
            $getcartinfo = mysqli_fetch_array(mysqli_query($conn, $cartinfo));
            
            if ($getcartinfo !=FALSE){
                $amount = $getcartinfo['amount'];
                $newamount = $amount + $select;
                $addamount = "UPDATE cart_info SET amount = '$newamount' WHERE cart_id = '$user_id' and ticket_id = '$ticket_id'";
                mysqli_query($conn, $addamount);
                echo "<script>alert('Add success');</script>";
                header("Refresh: 0; url=Cart.php" );
                mysqli_close($conn);
            }else{
                $cart = "SELECT cart_id FROM cart WHERE owner_id = '$user_id'";
                $getcartid = mysqli_fetch_array(mysqli_query($conn, $cart));
                $cart_id = $getcartid['cart_id'];
                $addtocart = "INSERT INTO cart_info (cart_id, ticket_id, amount) VALUE ('$cart_id', $ticket_id, $select)";
                mysqli_query($conn, $addtocart);
                echo "<script>alert('Add success');</script>";
                header("Refresh: 0; url=Cart.php" );
                mysqli_close($conn);
            }
        }else{
            echo "<script>alert('Please login first');</script>";
            header("Refresh: 0; url=index.php" );
            mysqli_close($conn);
        }
    }
?>
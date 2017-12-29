<?php
    include "connection.php";

    session_start();
    if(!isset($_SESSION['email'], $_SESSION['email'])){
        $inputemail = $_POST['inputemail'];
        $inputpwd = $_POST['inputpwd'];
        $checksubmit = "SELECT * FROM user WHERE account = '$inputemail' and pwd = '$inputpwd'";
        if(mysqli_num_rows(mysqli_query($conn, $checksubmit))>0){
            echo "<script>alert('This account is exist, please login.');</script>";
            header("Refresh: 0; url=index.php");
        }
        else{
            $submitsql = "INSERT INTO user (account, pwd) VALUES ('$inputemail', '$inputpwd')";
            mysqli_query($conn, $submitsql);
            echo "<script>alert('Welcome to join us.');</script>";

            $selectaccountid = "SELECT user_id FROM user WHERE account = '$inputemail'";
            $row = mysqli_fetch_array(mysqli_query($conn, $selectaccountid));
            $user_id = $row['user_id'];
            $createcart = "INSERT INTO cart (owner_id) VALUES ('$user_id')";
            mysqli_query($conn, $createcart);
            $_SESSION['email'] = $inputemail;
            $_SESSION['pwd'] = $inputpwd;
            header("Refresh: 0; url=index.php" );
        }        
    }else{
        $inputemail = $_POST['inputemail'];
        $inputpwd = $_POST['inputpwd'];
        if($_SESSION['email'] == $inputemail){
            echo "<script>alert('You already login.');</script>";
            header("Refresh: 0; url=index.php" );
        }
    }
?>
<?php
    include "connection.php";

    session_start();
    if(isset($_POST['oldpwd'], $_POST['newpwd'], $_POST['user_id'])){
        $oldpwd = $_POST['oldpwd'];
        $newpwd = $_POST['newpwd'];
        $user_id = $_POST['user_id'];
        $sql = "UPDATE user SET pwd = '$newpwd' WHERE user_id = '$user_id'";
        if($_POST['oldpwd'] == $_SESSION['pwd']){
            mysqli_query($conn, $sql);
            echo "<script>alert('Change success, please login again');</script>";
            session_destroy();
            header("Refresh: 0; url=index.php" );
            mysqli_close($conn);
        }else{
            echo "<script>alert('Please enter right old password');</script>";
            header("Refresh: 0; url=Member.php" );
            mysqli_close($conn);
        }
    }
?>
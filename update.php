<?php
    include "connection.php";
    session_start();
    if(isset($_POST["destination"], $_POST["quantity"], $_POST["edit_id"])){
        $Des = $_POST["destination"];
        $newtotal = $_POST["quantity"];
        $edit_id = $_POST["edit_id"];
        $sql = "UPDATE ticket SET quantity = '$newtotal' WHERE ticket_id = '$edit_id'";
        mysqli_query($conn, $sql);
        echo "<script>alert('Update success');</script>";
        header("Refresh: 0; url=backstage.php" );
        mysqli_close($conn);
    }
?>
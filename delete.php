<?php
    include "connection.php";
    session_start();
    $delete_id = $_POST["delete_id"];
    $sql = "DELETE FROM ticket WHERE ticket_id = $delete_id";
    mysqli_query($conn, $sql);
    echo "<script>alert('Delete success');</script>";
    header("Refresh: 0; url=backstage.php" );
    mysqli_close($conn);
?>
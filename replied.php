<?php
    include "connection.php";
    session_start();
    $message_id = $_POST["message_id"];
    $sql = "DELETE FROM contact WHERE message_id = $message_id";
    mysqli_query($conn, $sql);
    echo "<script>alert('Replied');</script>";
    header("Refresh: 0; url=backstage.php" );
    mysqli_close($conn);
?>
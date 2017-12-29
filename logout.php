<?php
    session_start();
    include "connection.php";
    echo "<script>alert('Logout success.');</script>";
    header("Refresh: 0; url=index.php" );
    session_destroy();
?>
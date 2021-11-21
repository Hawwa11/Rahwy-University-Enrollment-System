<?php
    //remove existing sessions
    session_start();
    session_destroy();

    // Direct user to Login page
    header("Location:login.php");
?>
<?php
    session_start();
    session_destroy();
    header("Location: ../../Login/View/Login.php");
    exit();
?>

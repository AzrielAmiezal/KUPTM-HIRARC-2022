<?php
    session_start();
    //session_destroy();
    unset($_SESSION["adminLogged"]);
    unset($_SESSION["adminID"]);
    unset($_SESSION["admin_fullname"]);
    header("Location: admin_login.php");
?>
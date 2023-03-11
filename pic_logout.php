<?php
    session_start();
    //session_destroy();
    unset($_SESSION["picID"]);
    unset($_SESSION["picFullname"]);
    unset($_SESSION["picLogged"]);
    header("Location: pic_login.php");
?>
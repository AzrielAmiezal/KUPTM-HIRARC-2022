<?php
    $link = mysqli_connect("localhost", "root", "", "hazard", "3306") or die($link);

    if (!$link) {
        echo "Error: Unable to connect to MySQL.";
        echo "Debugging errno: " . mysqli_connect_errno();
        echo "Debugging error: " . mysqli_connect_error();
        exit;
    }

    // echo "Success: A proper connection to MySQL was made! The my_db database is great.";
    // echo "Host information: " . mysqli_get_host_info($link);

    //echo "<link rel='stylesheet' href='CSS/pic.css' type='text/css'>";
?>

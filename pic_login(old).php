<?php

require "connection.php";
require "pic_css_function.php";

session_start();

echo 
'<head>
    <title>PIC Login</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="pic_template/css/sb-admin-2.css" type="text/css">
    <link href="pic_template/font-awesome5.14.0/css/all.css" rel="stylesheet">
    <link href="pic_template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>';

echo '<body id="page-top">';

    $login_body = 
    "<form class='user' action='' method='POST'>" .
        "<p>" .
            "<input class='form-control form-control-user' type='text' name='pic_username' autocomplete='off' placeholder='Username'/><br />" .
            "<input class='form-control form-control-user' type='password' name='pic_password' placeholder='Password'/><br />" .
        "</p>" .
        "<p><input class='btn btn-primary btn-user btn-block' type='submit' name='pic_login_button' value='Login'/> <input class='btn btn-primary btn-user btn-block' type='reset' value='Clear' /></p>" .
        "<p style='text-align: center;'><a href='pic_forgot_password.php'>Forgot password</a></p>" .
    "</form>";
    register_login_body("PIC Login", $login_body);
    

    if(isset($_POST['pic_login_button']))
    {
        if($_POST['pic_username'] != "" && $_POST['pic_password'] != "")
        {
            $query = sprintf("SELECT * FROM pic WHERE picUsername = '%s'", 
                        mysqli_real_escape_string($link, $_POST['pic_username']));

            $result = mysqli_query($link, $query);

            // echo "num rows: " . mysqli_num_rows($result) . "";
            // echo "username: " . $_POST['pic_username'] . "password: " . $_POST['pic_password'];
            
            if(mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);

                //echo "db pass: " . $row['picPassword'];
                //echo password_verify(mysqli_real_escape_string($link, $_POST['pic_password']), $row["picPassword"]);

                if(password_verify(mysqli_real_escape_string($link, $_POST['pic_password']), $row["picPassword"]))
                {
                    
                    $_SESSION["picID"] = $row["picID"];
                    $_SESSION["picFullname"] = $row["picFullname"];
                    $_SESSION["picLogged"] = 1;

                    echo "Logged: " . $_SESSION["picLogged"];
                    //echo "<p>Login succesful.</p>";
                    header('Location: pic_main.php');
                    //echo '<script type="text/javascript">location.href = "pic_main.php";</script>';
                    //echo "<script type='text/javascript'> document.location='pic_report_task'; </script>";
                }
                else
                {
                    //echo "<p>Wrong name or password.</p>";
                    echo overlay(css_small_card("danger", "ERROR", "Wrong name or password.", "fas fa-exclamation-circle"));
                }
            }
            else
            {
                //echo "<p>Wrong name or password.</p>";
                echo overlay(css_small_card("danger", "ERROR", "Wrong name or password.", "fas fa-exclamation-circle"));
            }
        }
        else
        {
            //echo "<p>Please fill in all of the information.</p>";
            echo overlay(css_small_card("warning", "WARNING", "Please fill in all of the information.", "fas fa-exclamation-circle"));
        }
    }

    echo footer();

    echo '<script src="pic_template/vendor/jquery/jquery.min.js"></script>';
    echo '<script src="pic_template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>';
    echo '<script src="pic_template/vendor/jquery-easing/jquery.easing.min.js"></script>';
    echo '<script src="pic_template/js/sb-admin-2.min.js"></script>';
    echo '<script src="pic_template/vendor/chart.js/Chart.min.js"></script>';
    echo '<script src="pic_template/js/demo/chart-area-demo.js"></script>';
    echo '<script src="pic_template/js/demo/chart-pie-demo.js"></script>';
    echo '<script src="pic_template/js/demo/chart-pie-demo.js"></script>';
    echo '<script src="pic_template/vendor/datatables/jquery.dataTables.min.js"></script>';
    echo '<script src="pic_template/vendor/datatables/dataTables.bootstrap4.min.js"></script>';
    echo '<script src="pic_template/js/demo/datatables-demo.js"></script>';

echo '</body>';
?>
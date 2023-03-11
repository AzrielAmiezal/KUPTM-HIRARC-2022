<?php

    require "connection.php";
    require "pic_css_function.php";

    session_start();

    //forgot password usage
    if(isset($_GET["picID"]) && isset($_GET["token"]))
    {
        echo 
        '<head>
            <title>PIC Forgot Password</title>

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            
            <link rel="stylesheet" href="pic_template/css/sb-admin-2.css" type="text/css">
            <link href="pic_template/font-awesome5.14.0/css/all.css" rel="stylesheet">
            <link href="pic_template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        </head>';

        $form_body = 
        '<form class="user" action="" method="POST">' . 
            '<p>' . 
                '<input class="form-control form-control-user" type="password" name="admin_new_password" placeholder="New password"/>' .
                '<input class="form-control form-control-user" type="password" name="admin_new_password_confirm" placeholder="Confirm new password" />' .
            '</p>' .
            '<p>' . 
                '<input class="btn btn-primary btn-user btn-block" type="submit" name="submit" value="Submit" />' .
            '</p>' . 
        '</form>'; 

        register_login_body("Change Password", $form_body);

        if(isset($_POST['submit']))
        {
            if(($_POST['admin_new_password'] != "") && ($_POST['admin_new_password_confirm'] != ""))
            {
                //checking old password is the same in the db
                $query = sprintf("SELECT * FROM pic WHERE adminID='%s'",
                                mysqli_real_escape_string($link, $_GET['picID']));
                $result = mysqli_query($link, $query);

                if(!$result)
                {
                    echo overlay(css_small_card("danger", "ERROR", mysqli_error($link), "fas fa-exclamation-circle"));
                }
                else
                {
                    $row = mysqli_fetch_assoc($result);

                    if(($_POST['admin_new_password'] == $_POST['pic_new_password_confirm']))
                    {
                        $query = sprintf("UPDATE admin
                                            SET adminPassword='%s'
                                        WHERE adminID = '%s' AND adminPassword='%s'",
                                        mysqli_real_escape_string($link, password_hash($_POST['admin_new_password'], PASSWORD_DEFAULT)), 
                                        mysqli_real_escape_string($link, $_GET["adminID"]),
                                        mysqli_real_escape_string($link, $_GET["token"]));
                        $result = mysqli_query($link, $query);

                        if(!$result)
                        {
                            echo overlay(css_small_card("danger", "ERROR", mysqli_error($link), "fas fa-exclamation-circle"));
                        }
                        else
                        {
                            echo overlay(css_small_card("success", "PASSWORD CHANGED", "Your password has succesfuly changed.", "fas fa-check-circle"));
                            header('Location: admin_login.php');
                        }
                    }
                }
            }
            else
            {
                echo overlay(css_small_card("warning", "WARNING", "Please fill in all of the information.", "fas fa-exclamation-circle"));
            }
        }
        
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

        echo footer();
    }

    
    
?>
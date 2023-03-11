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
                '<input class="form-control form-control-user" type="password" name="pic_new_password" placeholder="New password"/>' .
                '<br />' .
                '<input class="form-control form-control-user" type="password" name="pic_new_password_confirm" placeholder="Confirm new password" />' .
            '</p>' .
            '<p>' . 
                '<input class="btn btn-primary btn-user btn-block" type="submit" name="submit" value="Submit" />' .
            '</p>' . 
        '</form>'; 

        register_login_body("Change Password", $form_body);

        if(isset($_POST['submit']))
        {
            if(($_POST['pic_new_password'] != "") && ($_POST['pic_new_password_confirm'] != ""))
            {
                //checking old password is the same in the db
                $query = sprintf("SELECT * FROM pic WHERE picID='%s'",
                                mysqli_real_escape_string($link, $_GET['picID']));
                $result = mysqli_query($link, $query);

                if(!$result)
                {
                    echo overlay(css_small_card("danger", "ERROR", mysqli_error($link), "fas fa-exclamation-circle"));
                }
                else
                {
                    $row = mysqli_fetch_assoc($result);

                    if(($_POST['pic_new_password'] == $_POST['pic_new_password_confirm']))
                    {
                        $query = sprintf("UPDATE pic
                                            SET picPassword='%s'
                                        WHERE picID = '%s' AND picPassword='%s'",
                                        mysqli_real_escape_string($link, password_hash($_POST['pic_new_password'], PASSWORD_DEFAULT)), 
                                        mysqli_real_escape_string($link, $_GET["picID"]),
                                        mysqli_real_escape_string($link, $_GET["token"]));
                        $result = mysqli_query($link, $query);

                        if(!$result)
                        {
                            echo overlay(css_small_card("danger", "ERROR", mysqli_error($link), "fas fa-exclamation-circle"));
                        }
                        else
                        {
                            echo overlay(css_small_card("success", "PASSWORD CHANGED", "Your password has succesfuly changed.", "fas fa-check-circle"));
                            header('Location: pic_login.php');
                        }
                    }
                }
            }
            else
            {
                echo overlay(css_small_card("warning", "WARNING", "Please fill in all of the information.", "fas fa-exclamation-circle"));
            }
        }
    }
    //change password usage
    else
    {
        echo '<html lang="en">';
            echo '<head>' .
                '<meta charset="utf-8">' .
                '<meta http-equiv="X-UA-Compatible" content="IE=edge">' .
                '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">' .
                '<meta name="description" content="">' .
                '<meta name="author" content="">' .

                '<title>KUPTM PIC HIRARC</title>' .

                '<link href="pic_template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">' .
                '<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">' .
                '<link href="pic_template/css/sb-admin-2.min.css" rel="stylesheet">' .
                '<link href="pic_template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">' .

                '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>' .
                '<script src="notification_script.js"></script>' .

            '</head>';

            echo '<body id="page-top">';
                echo '<div id="wrapper">';
                    echo sidebar();
                    echo '<div id="content-wrapper" class="d-flex flex-column">';
                        echo '<div id="content">';
                            echo topbar($_SESSION['picFullname']);
                            echo '<div class="container-fluid">';
                                
                            // $form_body = 
                            // '<form class="user" action="" method="POST">' . 
                            //     '<p>' . 
                            //         '<input class="form-control form-control-user" type="password" name="pic_old_password" placeholder="Old password"/>' .
                            //     '</p>' .
                            //     '<p>' . 
                            //         '<input class="form-control form-control-user" type="password" name="pic_new_password" placeholder="New password"/>' .
                            //         '<br />' .
                            //         '<input class="form-control form-control-user" type="password" name="pic_new_password_confirm" placeholder="Confirm new password" />' .
                            //     '</p>' .
                            //     '<p>' . 
                            //         '<input class="btn btn-primary btn-user btn-block" type="submit" name="submit" value="Submit" />' .
                            //     '</p>' . 
                            // '</form>'; 

                            // echo css_basic_card("Change Password", $form_body);

                            $table = 
                            '<form class="user" action="" method="POST">' .
                                '<div class="card shadow mb-4">' .
                                    '<div class="card-header py-3">' .
                                        '<h6 class="m-0 font-weight-bold text-primary">Personal Information</h6>' .
                                    '</div>' .
                                        '<div class="card-body">' .
                                            '<div class="table-responsive">' .
                                                '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">' .
                                                    '<tr>' .
                                                        '<th class="text-center" colspan="2">Account Security</th>' .
                                                    '</tr>' .
                                                    '<tr>' .
                                                        '<th>Old password:</th>' .
                                                        '<td><input class="form-control form-control-user" type="password" name="pic_old_password" placeholder="Old password"/></td>' .
                                                    '</tr>' .

                                                    '<tr>' .
                                                        '<th class="text-center" colspan="2">New credentials</th>' .
                                                    '</tr>' .
                                                    '<tr>' .
                                                        '<th>New password:</th>' .
                                                        '<td><input class="form-control form-control-user" type="password" name="pic_new_password" placeholder="New password"/></td>' .
                                                    '</tr>' .
                                                    '<tr>' .
                                                        '<th>Confirm password:</th>' .
                                                        '<td><input class="form-control form-control-user" type="password" name="pic_new_password_confirm" placeholder="Confirm new password" /></td>' .
                                                    '</tr>' .

                                                    // '<tr>' .
                                                    //     '<th></th>' .
                                                    //     '<td></td>' .
                                                    // '</tr>' .
                                                
                                                    
                                                '</table>' .
                                                '<br /><input class="btn btn-primary btn-user btn-block" type="submit" name="submit" value="Submit" />' .
                                            '<div>' .
                                        '</div>' .
                                    '</div>' .
                                '</div>' . 
                                '</div>' . 
                            '</form>';

                            echo $table;

                            if(isset($_POST['submit']))
                            {
                                if(($_POST['pic_old_password'] != "") && ($_POST['pic_new_password'] != "") && ($_POST['pic_new_password_confirm'] != ""))
                                {
                                    //checking old password is the same in the db
                                    $query = sprintf("SELECT * FROM pic WHERE picID='%s'",
                                                    mysqli_real_escape_string($link, $_SESSION['picID']));
                                    $result = mysqli_query($link, $query);

                                    if(!$result)
                                    {
                                        echo overlay(css_small_card("danger", "ERROR", mysqli_error($link), "fas fa-exclamation-circle"));
                                    }
                                    else
                                    {
                                        $row = mysqli_fetch_assoc($result);

                                        //echo "Pic" . $row["picPassword"];
                                        //echo "Old" . $_POST["pic_old_password"];

                                        //verifying password
                                        if(password_verify(mysqli_real_escape_string($link, $_POST["pic_old_password"]), $row["picPassword"]))
                                        {
                                            //check if the new and confirmation password is the same
                                            if(($_POST['pic_new_password'] == $_POST['pic_new_password_confirm']))
                                            {
                                                $query = sprintf("UPDATE pic
                                                                    SET picPassword='%s'
                                                                WHERE picID='%s'",
                                                                mysqli_real_escape_string($link, password_hash($_POST['pic_new_password'], PASSWORD_DEFAULT)), 
                                                                mysqli_real_escape_string($link, $_SESSION['picID']));
                                                $result = mysqli_query($link, $query);

                                                if(!$result)
                                                {
                                                    echo overlay(css_small_card("danger", "ERROR", mysqli_error($link), "fas fa-exclamation-circle"));
                                                }
                                                else
                                                {
                                                    // if(mysqli_num_rows($result) == 1)
                                                    // {
                                                        echo overlay(css_small_card("success", "PASSWORD CHANGED", "Your password has succesfuly changed.", "fas fa-check-circle"));
                                                        //header("Location: pic_main.php");  
                                                    // }
                                                    
                                                }
                                            }
                                            else 
                                            {
                                                echo overlay(css_small_card("warning", "WARNING", "New password and the password confirmation is not the same.", "fas fa-exclamation-circle"));
                                            }
                                        }
                                        // echo overlay(css_small_card("success", "PASSWORD CHANGED", "Your password has succesfuly changed.", "fas fa-check-circle"));
                                        // header("Location: pic_main.php");
                                    }
                                }
                                else
                                {
                                    echo overlay(css_small_card("warning", "WARNING", "Please fill in all of the information.", "fas fa-exclamation-circle"));
                                }
                            }
                            echo '</div>';
                        echo '</div>';
                        echo footer();
                    echo '</div>'; 
                echo '</div>';

                echo logoutModal();

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
        echo '</html>';
    }

    
?>

<script>
    fetch_pic_notification_function(<?php echo $_SESSION["picID"] ?>);
    change_pic_read_status(<?php echo $_SESSION["picID"] ?>);
</script>
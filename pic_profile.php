


<?php

    require "connection.php";
    require "pic_css_function.php";

    session_start();

    if($_SESSION["picLogged"] == 1)
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
                                //$form_body = 

                                /*
                                    picIDNo 	

                                3 	picUsername 	

                                4 	picFullname 	
                                5 	picPassword 	
                                6 	picDepartment 	
                                7 	picPhoneNumber 	
                                8 	picEmail 
                                */
                                $query = sprintf("SELECT * FROM pic WHERE picID = '%s'", 
                                mysqli_real_escape_string($link, $_SESSION["picID"]));

                                $result = mysqli_query($link, $query);

                                if(mysqli_num_rows($result) == 1)
                                {
                                    $row = mysqli_fetch_assoc($result);

                                    // $form_body = 
                                    // '<form class="user" action="" method="POST">' . 
                                    //     '<p>' . 
                                    //         css_default_card("Account Security", 'Password Confirmation: <input class="form-control form-control-user" type="password" name="pic_password" placeholder="Password"/>') .
                                    //     '</p>' .
                                    //     '<p>' .
                                    //         css_default_card("Account Information", 
                                    //         '<p>' .    
                                    //             'Username: <input class="form-control form-control-user" type="text" name="pic_new_username" placeholder="User name" value="' . $row["picUsername"]. '" />' .
                                    //             'Full name: <input class="form-control form-control-user" type="text" name="pic_new_fullname" placeholder="Full Name" value="' . $row["picFullname"]. '" />' .
                                    //             'Phone Number: <input class="form-control form-control-user" type="text" name="pic_new_phonenumber" placeholder="Phone Number" value="' . $row["picPhoneNumber"]. '" />' .
                                    //             'Email: <input class="form-control form-control-user" type="text" name="pic_new_email" placeholder="E-Mail" value="' . $row["picEmail"]. '"/>' .
                                    //         '</p>') .
                                    //     '</p>' .
                                    //     '<p>' . 
                                    //         '<input class="btn btn-primary btn-user btn-block" type="submit" name="submit" value="Submit" />' .
                                    //         '<input class="btn btn-primary btn-user btn-block" type="reset" value="Clear" />' .
                                    //     '</p>' . 
                                    // '</form>'; 

                                    // echo css_basic_card("Information", $form_body);

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
                                                            '<th>Username:</th>' .
                                                            '<td><input class="form-control form-control-user" type="text" name="pic_new_username" placeholder="User name" value="' . $row["picUsername"]. '" /></td>' .
                                                        '</tr>' .

                                                        '<tr>' .
                                                            '<th>Full name:</th>' .
                                                            '<td><input style="text-transform: capitalize;" class="form-control form-control-user" type="text" name="pic_new_fullname" placeholder="Full Name" value="' . $row["picFullname"]. '" /></td>' .
                                                        '</tr>' .

                                                        '<tr>' .
                                                            '<th>Phone Number:</th>' .
                                                            '<td><input class="form-control form-control-user" type="text" name="pic_new_phonenumber" placeholder="Phone Number" value="' . $row["picPhoneNumber"]. '" /></td>' .
                                                        '</tr>' .

                                                        '<tr>' .
                                                            '<th>Email:</th>' .
                                                            '<td><input class="form-control form-control-user" type="text" name="pic_new_email" placeholder="E-Mail" value="' . $row["picEmail"]. '"/></td>' .
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
                                }

                                

                                //function is not yet implement
                                if(isset($_POST["submit"]))
                                {
                                    $query = sprintf("UPDATE pic
                                                    SET picUsername = '%s', 
                                                        picFullname = '%s',
                                                        picPhoneNumber = '%s',
                                                        picEmail = '%s'
                                                    WHERE picID = '%s'",
                                                mysqli_real_escape_string($link, $_POST["pic_new_username"]),
                                                mysqli_real_escape_string($link, $_POST["pic_new_fullname"]),
                                                mysqli_real_escape_string($link, $_POST["pic_new_phonenumber"]),
                                                mysqli_real_escape_string($link, $_POST["pic_new_email"]),
                                                mysqli_real_escape_string($link, $_SESSION["picID"]));
                                    $result = mysqli_query($link, $query);

                                    if($result)
                                    {
                                        echo overlay(css_small_card("success", "SUCCESS", "Profile updated.", "fas fa-check"));
                                    }
                                    else
                                    {
                                        echo overlay(css_small_card("danger", "ERROR", "Profile unable to update. " . mysqli_error($link), "fas fa-exclamation-circle"));
                                    }
                                }
                            echo "</div>";
                        echo '</div>'
                        ;echo footer();
                    echo '</div>';
                echo '</div>';

                echo modal();

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
    else
    {
        header("Location: pic_login");
    }
?>

<script>
    fetch_pic_notification_function(<?php echo $_SESSION["picID"] ?>);
    change_pic_read_status(<?php echo $_SESSION["picID"] ?>);
</script>
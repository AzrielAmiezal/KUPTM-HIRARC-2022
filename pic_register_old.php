<?php

require "connection.php";
require "pic_css_function.php";

session_start();

echo 
'<head>
    <title>PIC Register</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="pic_template/css/sb-admin-2.css" type="text/css">
    <link href="pic_template/font-awesome5.14.0/css/all.css" rel="stylesheet">
    <link href="pic_template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>';

echo '<body id="page-top">';

    $login_body = 
    "<form class='user' action='' method='post'>" .
        "<p><input class='form-control form-control-user' type='text' name='pic_id_no' autocomplete='off' placeholder='PIC ID No'/></p>" .
        "<p><input class='form-control form-control-user' type='text' name='pic_username' autocomplete='off' placeholder='PIC Username'/></p>" .
        "<p><input class='form-control form-control-user' style='text-transform: capitalize;' size='50' type='text' name='pic_fullname' autocomplete='off' autocapitalize='word' placeholder='PIC Fullname'/></p>" .
        "<p><input class='form-control form-control-user' type='text' name='pic_email' autocomplete='off' placeholder='PIC E-Mail'/></p>" .
        "<p><input class='form-control form-control-user' type='password' name='pic_password' placeholder='PIC Password'/></p>" .
        // "<p>PIC Position<br />" .
        //     "<select name='pic_position'>" .
        //         "<option value='' selected hidden>Select one</option>" .
        //         "<option value='1'>Lecturer</option>" .
        //         "<option value='2'>Staff</option>" .
        //     "</select> <br /></p>" .
        "<p>" . 
            "<select class='form-control form-control-user' name='pic_department'>" .
                "<option value='' selected hidden>Select one</option>" .
                "<option value='Department_Admin'>Admin Department</option>" .
                "<option value='Department_IT'>IT Department</option>" .
                "<option value='Department_Academic'>Academic Department</option>" .
                "<option value='Department_Financial'>Financial Department</option>" .
                // "<option value='Department_Other'>Others</option>" .
            "</select><br /></p>" .
        "<p><input class='form-control form-control-user' type='text' name='pic_phone_number' autocomplete='off' placeholder='PIC Phone Number'/></p>" .
        "<p><input class='btn btn-primary btn-user btn-block' type='submit' name='pic_register_button' value='Register'/> <input class='btn btn-primary btn-user btn-block' type='reset' value='Clear' /></p>" .
    "</form>";

    register_login_body("PIC Register", $login_body);
    

    if(isset($_POST['pic_register_button']))
    {
        if($_POST['pic_id_no'] != "" && 
            $_POST['pic_username'] != "" &&
            $_POST['pic_fullname'] != "" && 
            $_POST['pic_email'] != "" &&
            $_POST['pic_password'] != "" && 
            $_POST['pic_department'] != "" && 
            $_POST['pic_phone_number'] != "")
        {
            $query = sprintf("SELECT * FROM pic WHERE picUsername = '%s'", mysqli_real_escape_string($link, $_POST['pic_username']));
            $result = mysqli_query($link, $query);
            
            //echo "num rows: " . mysqli_num_rows($result);

            if(mysqli_num_rows($result) == 0)
            {
                $query = sprintf("INSERT INTO pic VALUE ('', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", 
                        mysqli_real_escape_string($link, $_POST['pic_id_no']),
                        mysqli_real_escape_string($link, $_POST['pic_username']),
                        mysqli_real_escape_string($link, $_POST['pic_fullname']),
                        mysqli_real_escape_string($link, password_hash($_POST['pic_password'], PASSWORD_DEFAULT)),
                        mysqli_real_escape_string($link, $_POST['pic_department']),
                        mysqli_real_escape_string($link, $_POST['pic_phone_number']),
                        mysqli_real_escape_string($link, $_POST['pic_email']));

                $result = mysqli_query($link, $query);
                
                if(!$result) 
                {
                    echo "ERROR:" . mysqli_error($link);
                } else 
                {
                   // echo "<script>alert('New PIC has been registered.');</script>";
                   echo overlay(css_small_card("success", "SUCCESS", "New PIC has been registered.", "fas fa-check-circle"));
                }
            }
            else
            {
                //echo "<script>alert('PIC existed. Please use other name.');</script>";
                //echo "<p>PIC existed. Please use other name.</p>";
                //echo "<script>alert('PIC existed. Please use other name.');</script>";
                echo overlay(css_small_card("warning", "WARNING", "PIC name existed. Please user other name.", "fas fa-exclamation-circle"));
            }
            
        }
        else
        {
            //echo "<script>alert('Please fill in all of the information.');</script>";
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

<?php
    // include "connection.php";

    // echo "<div class='login-register-body'>";    

    // echo "<h2>PIC Register</h2>";

    // echo 
    // "<form action='' method='post'>" .
    //     "<p>PIC ID No<br /><input type='text' name='pic_id_no' autocomplete='off'/><br /></p>" .
    //     "<p>PIC Username<br /><input type='text' name='pic_username' autocomplete='off'/><br /></p>" .
    //     "<p>PIC Fullname<br /><input style='text-transform: capitalize;' size='50' type='text' name='pic_fullname' autocomplete='off' autocapitalize='word'/><br /></p>" .
    //     "<p>PIC Email<br /><input type='text' name='pic_email' /><br /></p>" .
    //     "<p>PIC Password<br /><input type='password' name='pic_password' /><br /></p>" .
    //     // "<p>PIC Position<br />" .
    //     //     "<select name='pic_position'>" .
    //     //         "<option value='' selected hidden>Select one</option>" .
    //     //         "<option value='1'>Lecturer</option>" .
    //     //         "<option value='2'>Staff</option>" .
    //     //     "</select> <br /></p>" .
    //     "<p>PIC Department<br />" . 
    //         "<select name='pic_department'>" .
    //             "<option value='' selected hidden>Select one</option>" .
    //             "<option value='Department_Admin'>Admin Department</option>" .
    //             "<option value='Department_IT'>IT Department</option>" .
    //             "<option value='Department_Academic'>Academic Department</option>" .
    //             "<option value='Department_Financial'>Financial Department</option>" .
    //             // "<option value='Department_Other'>Others</option>" .
    //         "</select><br /></p>" .
    //     "<p>PIC Phone Number<br /><input type='text' name='pic_phone_number' autocomplete='off'/><br /></p>" .
    //     "<p><input type='submit' name='pic_register_button' value='Register'/> <input type='reset' value='Clear' /></p>" .
    // "</form>";

    // if(isset($_POST['pic_register_button']))
    // {
    //     if($_POST['pic_id_no'] != "" && 
    //         $_POST['pic_username'] != "" &&
    //         $_POST['pic_fullname'] != "" && 
    //         $_POST['pic_email'] != "" &&
    //         $_POST['pic_password'] != "" && 
    //         $_POST['pic_department'] != "" && 
    //         $_POST['pic_phone_number'] != "")
    //     {
    //         $query = sprintf("SELECT * FROM pic WHERE picUsername = '%s'", mysqli_real_escape_string($link, $_POST['pic_username']));
    //         $result = mysqli_query($link, $query);
            
    //         //echo "num rows: " . mysqli_num_rows($result);

    //         if(mysqli_num_rows($result) == 0)
    //         {
    //             $query = sprintf("INSERT INTO pic VALUE ('', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", 
    //                     mysqli_real_escape_string($link, $_POST['pic_id_no']),
    //                     mysqli_real_escape_string($link, $_POST['pic_username']),
    //                     mysqli_real_escape_string($link, $_POST['pic_fullname']),
    //                     mysqli_real_escape_string($link, password_hash($_POST['pic_password'], PASSWORD_DEFAULT)),
    //                     mysqli_real_escape_string($link, $_POST['pic_department']),
    //                     mysqli_real_escape_string($link, $_POST['pic_phone_number']),
    //                     mysqli_real_escape_string($link, $_POST['pic_email']));

    //             $result = mysqli_query($link, $query);
                
    //             if(!$result) {
    //                 echo "ERROR:" . mysqli_error($link);
    //             } else {
    //                 echo "<script>alert('New PIC has been registered.');</script>";
    //             }

    //             // if($result) { echo "The PIC is successfully registered."; }
    //             // else { echo "ERROR: " . mysqli_error($link); }

    //            // mysqli_close($link);

    //             //header('Location: pic_main');
    //             //echo "<script>alert('New PIC has been registered.');</script>";
    //         }
    //         else
    //         {
    //             //echo "<script>alert('PIC existed. Please use other name.');</script>";
    //             //echo "<p>PIC existed. Please use other name.</p>";
    //             echo "<script>alert('PIC existed. Please use other name.');</script>";
    //         }
            
    //     }
    //     else
    //     {
    //         //echo "<script>alert('Please fill in all of the information.');</script>";
    //         echo "<p>Please fill in all of the information.</p>";
    //     }
    // } 
    // echo "</div>";
?>
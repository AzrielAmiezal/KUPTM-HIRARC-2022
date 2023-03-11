<?php

    require "connection.php";
    require "pic_css_function.php";
    require "email_notify.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/phpmailer/phpmailer/src/Exception.php';
    require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require 'vendor/phpmailer/phpmailer/src/SMTP.php';

    session_start();

    echo 
    '<head>
        <title>KUPTM PIC HIRARC</title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link rel="stylesheet" href="pic_template/css/sb-admin-2.css" type="text/css">
        <link href="font-awesome5.14.0/css/all.css" rel="stylesheet">
        <link href="pic_template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="notification_script.js"></script>
    </head>';

    echo '<body id="page-top">';
        $login_body = 
        "<form class='user' action='' method='POST'>" .
            "<p><input class='form-control form-control-user' type='text' name='pic_email' autocomplete='off' placeholder='E-Mail'/><br /></p>" .
            "<p><input class='btn btn-primary btn-user btn-block' type='submit' name='pic_submit_button' value='Login'/> <input class='btn btn-primary btn-user btn-block' type='reset' value='Clear' /></p>" .
        "</form>";
        register_login_body("PIC Forgot Password", $login_body);

        if(isset($_POST['pic_submit_button']))
        {
            if($_POST['pic_email'] != "")
            {
                $query = sprintf("SELECT picID, picPassword FROM pic WHERE picEmail = '%s'", 
                            mysqli_real_escape_string($link, $_POST['pic_email']));

                $result = mysqli_query($link, $query);
                
                if(mysqli_num_rows($result) == 1)
                {
                    $row = mysqli_fetch_assoc($result);
                    
                    send_email($_POST["pic_email"], 
                            "KUTPM HIRARC Password Recovery", 
                            "<a href='localhost/hazard/pic_change_password.php?picID=". $row["picID"] . "&token=" . $row["picPassword"] . "'>Change Password</a>");

                    // $mail = new PHPMailer(true);                            
                    // try 
                    // {
                    //     //Server settings
                    //     $mail->isSMTP();                                     
                    //     $mail->Host = 'smtp.gmail.com';               
                    //     $mail->SMTPAuth = true;                             
                    //     $mail->Username = 'mubarrak48@gmail.com';     
                    //     $mail->Password = 'password';             
                    //     $mail->SMTPOptions = array(
                    //         'ssl' => array(
                    //         'verify_peer' => false,
                    //         'verify_peer_name' => false,
                    //         'allow_self_signed' => true
                    //         )
                    //     );                         
                    //     $mail->SMTPSecure = 'ssl';                           
                    //     $mail->Port = 465;                                   

                    //     //Send Email
                    //     $mail->setFrom('mubarrak48@gmail.com', 'HIRARC Support');
                        
                    //     //Recipients
                    //     $mail->addAddress($_POST["pic_email"]);              
                    //     $mail->addReplyTo('mubarrak48@gmail.com', 'HIRARC Support');
                        
                    //     //Content
                    //     $mail->isHTML(true);                                  
                    //     $mail->Subject = "Password Recovery";
                    //     $message = "<a href='localhost/hazard/pic_change_password.php?picID=". $row["picID"] . "&token=" . $row["picPassword"] . "'>Change Password</a>";
                    //     $mail->Body    = $message;

                    //     $mail->send();

                        

                        //echo "Password: " . $row["picPassword"];
                        
                        //echo overlay(css_small_card("success", "SUCCESS", "Message has been sent to the email.", "fas fa-check"));
                    // } 
                    // catch (Exception $e) 
                    // {
                    //     echo overlay(css_small_card("danger", "ERROR", "Message could not be sent to the email. " . $mail->ErrorInfo, "fas fa-exclamation-circle"));
                    // }

                    // if(password_verify(mysqli_real_escape_string($link, $_POST['pic_password']), $row["picPassword"]))
                    // {
                        
                    //     $_SESSION["picID"] = $row["picID"];
                    //     $_SESSION["picFullname"] = $row["picFullname"];
                    //     $_SESSION["picLogged"] = 1;

                    //     echo "Logged: " . $_SESSION["picLogged"];
                    //     //echo "<p>Login succesful.</p>";
                    //     header('Location: pic_main.php');
                    //     //echo '<script type="text/javascript">location.href = "pic_main.php";</script>';
                    //     //echo "<script type='text/javascript'> document.location='pic_report_task'; </script>";
                    // }
                    // else
                    // {
                    //     //echo "<p>Wrong name or password.</p>";
                    //     echo overlay(css_small_card("danger", "ERROR", "Wrong name or password.", "fas fa-exclamation-circle"));
                    // }
                }
                else
                {
                    //echo "<p>Wrong name or password.</p>";
                    echo overlay(css_small_card("danger", "ERROR", "E-Mail does not exists.", "fas fa-exclamation-circle"));
                }
            }
            else
            {
                //echo "<p>Please fill in all of the information.</p>";
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

    echo '</body>';

    echo footer();
?>
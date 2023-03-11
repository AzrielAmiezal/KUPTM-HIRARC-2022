<?php
    require "pic_css_function.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';

    function send_email(string $receiverEmail, string $subject, string $message)
    {
        $mail = new PHPMailer(true);                            
        try 
        {
            //Server settings
            $mail->isSMTP();                                     
            $mail->Host = 'smtp.gmail.com';               
            $mail->SMTPAuth = true;                             
            $mail->Username = 'kl2007006808@student.kuptm.edu.my';     
            $mail->Password = 'pass';             
            $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
            );                         
            $mail->SMTPSecure = 'ssl';                           
            $mail->Port = 465;                                   

            //Send Email
            $mail->setFrom('mubarrak48@gmail.com', 'KUPTM HIRARC Support');
            
            //Recipients
            $mail->addAddress($receiverEmail);              
            $mail->addReplyTo('mubarrak48@gmail.com', 'KUPTM HIRARC Support');
            
            //Content
            $mail->isHTML(true);                                  
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();

            //echo overlay(css_small_card("success", "SUCCESS", "Message has been sent to the email.", "fas fa-check"));
        } 
        catch (Exception $e) 
        {
            echo overlay(css_small_card("danger", "ERROR", "Message could not be sent to the email. " . $mail->ErrorInfo, "fas fa-exclamation-circle"));
        }
    }
?>
<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])){

    $email = $_GET["e"];

    $rs = Database ::search("SELECT * FROM `user` WHERE `email` = '".$email."' ");

    $n = $rs -> num_rows ;

    if($n == 1){

        $code = uniqid();

       Database ::iud ("UPDATE `user` SET `verification_code`='".$code."' WHERE `email`='".$email."'");

       $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'wasanthasanjaya1234@gmail.com';
            $mail->Password = 'imsi htgw vwbt awoc';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('wasanthasanjaya1234@gmail.com', 'Reset Password');
            $mail->addReplyTo('wasanthasanjaya1234@gmail.com', 'Reset Password');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'eshop Forgot Password Verification Code';
            $bodyContent = '<h1 style="color:green;">Your verification code is '.$code.'</h1>';
            
            $mail->Body    = $bodyContent;

            if(!$mail->send()){
                echo("Verification Code Sending Failed");

            }else{
                echo("success");
            }

    } else{
        echo("Invalid Email Address");
    }


    


}else{
    echo ("Please Enter Your Email Address First");
}



?>
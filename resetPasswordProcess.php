<?php
require "connection.php";

$email = $_POST["e"];
$new_pw = $_POST["np"];
$retyped_pw = $_POST["rnp"];
$v_code = $_POST["vc"];



if(empty($email)){
    echo("Please enter your email address.");
      
}else if(empty($new_pw)){
    echo("Please enter your New Password.");
}else if(strlen($new_pw)<5 || strlen($new_pw)>20){
    echo("Invalid New Password");

}else if(empty($retyped_pw)){
    echo("Please retype your new password");
    
}else if($new_pw != $retyped_pw){
echo("Your password does not matched");
}else if(empty($v_code)){
    echo("Please enter your verification code");
}else{

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' AND `verification_code` = '".$v_code."'");

    $n = $rs-> num_rows;

    if($n ==1){
        Database::iud("UPDATE `user` SET `password`='".$new_pw."' WHERE `email`='".$email."' AND `verification_code` = '".$v_code."'" );

        echo("success");

    }else{
        echo("Invalid user details");
    }

}











?>
<?php


session_start();


require "connection.php";

if (isset($_SESSION["u"])) {

    $user_email = $_SESSION["u"]["email"];

    
    $fname = $_POST["fn"];
    $lname = $_POST["ln"];
    $mobile = $_POST["mn"];
    $pw = $_POST["pw"];
    $email = $_POST["ea"];
    $line1 = $_POST["al1"];
    $line2 = $_POST["al2"];
    //$province = $_POST["p"];
    //$district = $_POST["d"];
    $city = $_POST["c"];
    $pc = $_POST["pc"];

    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$user_email."'");

    $address_num = $address_rs->num_rows;

    if ($address_num ==1 ){
        Database::iud ("UPDATE `user_has_address` SET `line1`='".$line1."', `line2`= '".$line2."', `postal_code`= '".$pc."', `city_city_id`='".$city."' WHERE `user_email` = '".$user_email."' ");
    } else{
        Database::iud("INSERT INTO `user_has_address`(`line1`,`line2`,`postal_code`,`user_email`,`city_city_id`) VALUES('".$line1."','".$line2."','".$pc."','".$user_email."','".$city."',)");
        

    }
    $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "img/svg+xml");

    if (isset($_FILES["img"])){
        $img = $_FILES["img"];
        $fil_type = $img["type"];

        if(in_array($fil_type,$allowed_image_extentions)){
            $new_file_type ;

            if($fil_type == "image/jpg"){
                $new_file_type =".jpg";
            }else if($fil_type == "image/jpeg"){
                $new_file_type= ".jpeg";
            }else if($fil_type == "image/png"){
                $new_file_type= ".png";
            }else if($fil_type == "image/svg+xml"){
                $new_file_type= ".svg";
            }

            $file_name = "resources//profile_images//".$lname."_".$mobile."_".uniqid(). $new_file_type;
            move_uploaded_file($img["tmp_name"], $file_name);

            $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='".$user_email."'");

            $image_num = $image_rs->num_rows;
        
            if($image_num==1){

                Database::iud("UPDATE `profile_img` SET `path`='".$file_name."' WHERE `user_email` = '".$user_email."' ");

            }else{
                Database::iud("INSERT INTO `profile_img` (`path`,`user_email`) VALUES ('".$file_name."','".$user_email."')");

            }


        }else{
            echo("File type does not allowed to upload ");
        }

    }else{
        //echo("Image Not Uploaded");
    }


    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='".$user_email."'   ");

    $user_num = $user_rs->num_rows;

    if($user_num ==1){

        Database::iud("UPDATE `user` SET `fname`='".$fname."', `lname`='".$lname."',`email`='".$email."',`password`='".$pw."',`mobile`='".$mobile."' WHERE `email`='".$user_email."' ");

        echo("success");

    }else{
        echo("Your are not a valid user");
    }
    




    


}

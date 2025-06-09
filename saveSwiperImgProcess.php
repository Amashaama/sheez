<?php

require "connection.php";

$length = sizeof($_FILES);

if ($length <= 12 && $length > 0) {

    $alowed_img_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

    for ($x = 0; $x < $length; $x++) {
        if (isset($_FILES["img" . $x])) {
            $img_file = $_FILES["img" . $x];
            $file_extention = $img_file["type"];

            if (in_array($file_extention, $alowed_img_extentions)) {

                $new_img_extention;

                if ($file_extention == "image/jpg") {
                    $new_img_extention = ".jpg";
                } else if ($file_extention == "image/jpeg") {
                    $new_img_extention = ".jpeg";
                } else if ($file_extention == "image/png") {
                    $new_img_extention = ".png";
                } else if ($file_extention == "image/svg+xml") {
                    $new_img_extention = ".svg";
                }

                $file_name = "resources//homepage_swiper//" . $x . "_" . uniqid() . $new_img_extention;
                move_uploaded_file($img_file["tmp_name"], $file_name);

                Database::iud("INSERT INTO `swiper_img`(`swiper_img_path`) VALUES ('" . $file_name . "')");
            } else {
                echo ("Not an allowed image type.");
            }
        }
      
    }
    echo ("success");

   
} else {
    echo (" Please add images of your product ");
}

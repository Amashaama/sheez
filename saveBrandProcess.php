<?php

require "connection.php";

$brand_id = $_POST["bid"];

$brandimg_rs = Database::search("SELECT * FROM `brand_img` WHERE `brand_brand_id`='" . $brand_id . "' ");
$brandimg_num = $brandimg_rs->num_rows;

$allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "img/svg+xml");

if (isset($_FILES["img"])) {
    $img = $_FILES["img"];
    $fil_type = $img["type"];

    if (in_array($fil_type, $allowed_image_extentions)) {
        $new_file_type;
        if ($fil_type == "image/jpg") {
            $new_file_type = " .jpg ";
        } else if ($fil_type == "image/jpeg") {
            $new_file_type = " .jpeg";
        } else if ($fil_type == "image/png") {
            $new_file_type = " .png";
        } else if ($fil_type == "image/svg+xml") {
            $new_file_type = " .svg";
        }

        $file_name = "resources//brand_images//" . $brand_id . "_" . uniqid() . $new_file_type;
        move_uploaded_file($img["tmp_name"], $file_name);

        if ($brandimg_num == 0) {
            Database::iud("INSERT INTO `brand_img` (`brand_img_path`,`brand_brand_id`) VALUES ('" . $file_name . "','" . $brand_id . "') ");

            echo ("successs");
        }else if($brandimg_num == 1){
            Database::iud("UPDATE `brand_img` SET `brand_img_path`='".$file_name."' WHERE `brand_brand_id`='".$brand_id."' ");
            echo ("brand image updated");

        }
    } else {
        echo ("File type does not allowed to upload ");
    }
} else {
    echo ("Your haven't upload any image");
}

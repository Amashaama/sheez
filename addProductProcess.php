<?php

session_start();
require "connection.php";

$email = $_SESSION["a"]["email"];

$category = $_POST["ca"];

$title = $_POST["t"];
$condition = $_POST["con"];
$color = $_POST["clr"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$desc = $_POST["desc"];

if (empty($category)) {
    echo ("Please Select a category ");
} else if (empty($title)) {
    echo ("Pleas add a name to product");
} else if (empty($condition)) {
    echo ("please select the condition of the product");
} else if (empty($color)) {
    echo ("please select the color of the product");
} else if (empty($dwc)) {
    echo ("please type delivery cost inside colombo");
} else if (empty($doc)) {
    echo ("please type delivery cost outside colombo");
} else {

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $status = 1;

    Database::iud("INSERT INTO `product` (`description`,`title`,`datetime_added`,
`delivery_fee_colombo`,`delivery_fee_other`,`color_clr_id`,`status_status_id`,
`condition_condition_id`,`user_email`,`category_cat_id`) VALUES
('" . $desc . "','" . $title . "','" . $date . "','" . $dwc . "','" . $doc . "','" . $color . "',
'" . $status . "','" . $condition . "','" . $email . "','" . $category . "')");

    $product_id = Database::$connection->insert_id; //last added insert

    $length = sizeof($_FILES);

    if ($length <= 4 && $length > 0) {

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

                    $file_name = "resources//new_product//" . $title . "_" . $x . "_" . uniqid() . $new_img_extention;
                    move_uploaded_file($img_file["tmp_name"], $file_name);

                    Database::iud("INSERT INTO `product_img`(`img_path`,`Product_id`) VALUES ('" . $file_name . "','" . $product_id . "')");
                } else {
                    echo ("Not an allowed image type.");
                }
            }
          
        }
        echo ("success");

       
    } else {
        echo (" Please add images of your product ");
    }
}

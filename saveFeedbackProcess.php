<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {


    $email = $_SESSION["u"]["email"];
    $inid = $_POST["inid"];
    $t = $_POST["t"];
    $feedback = $_POST["feed"];

    if (empty($feedback)) {
        echo ("Please enter your feedback");
    } else {


        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");


        $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $email . "' AND `id`='" . $inid . "' ");
        $invoice_num = $invoice_rs->num_rows;

        $invoice_data = $invoice_rs->fetch_assoc();

        $pid = $invoice_data["product_id"];

      //  Database::iud("INSERT INTO `feedback`(`type`,`feedback`,`date`,`product_id`,`user_email`,`invoice_id`) 
      //  VALUES('" . $t . "','" . $feedback . "','" . $date . "','" . $pid . "','" . $email . "','" . $inid . "')");

      

        Database::iud("INSERT INTO `feedback`(`type`,`feedback`,`date`,`product_id`,`user_email`,`invoice_id`) 
        VALUES('" . $t . "','" . $feedback . "','" . $date . "','" . $pid . "','" . $email . "','" . $inid . "')");


        $feedback_id_rs =  Database::search("SELECT * FROM `feedback` WHERE `user_email`='" . $email . "' AND `invoice_id`='" . $inid . "' ");

       $feedback_id_data = $feedback_id_rs->fetch_assoc();

       $f_id = $feedback_id_data["id"];

         // feedback images //

         $length = sizeof($_FILES);

         if ($length <= 3 && $length > 0) {
 
             $allowed_img_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
 
             for ($x = 0; $x < $length; $x++) {
                 if (isset($_FILES["img" . $x])) {
                     $img_file = $_FILES["img" . $x];
                     $file_extention = $img_file["type"];
 
                     if (in_array($file_extention, $allowed_img_extentions)) {
 
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
 
                         $file_name = "resources//feedbacks//" . $pid . "_" . $x."_".$inid . "_" . uniqid() . $new_img_extention;
                         move_uploaded_file($img_file["tmp_name"], $file_name);
                     } else {
                         echo ("Not an allowed image type.");
                     }
                 }
                 Database::iud("INSERT INTO `feedback_img`(`feedback_img_path`,`feedback_id`) 
                 VALUES ('" . $file_name . "','" . $f_id . "')");
             }
         }
 
 
         // feedback images //



      






        echo ("1");
    }
} else {
    echo ("Something went wrong");
}

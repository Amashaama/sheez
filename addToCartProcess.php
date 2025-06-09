<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    if (isset($_GET["id"])) {

        $email = $_SESSION["u"]["email"];
        $pid = $_GET["id"];
        $qty= $_GET["qty"];
      

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id`='" . $pid . "'
        AND `user_email`='" . $email . "' ");

        $cart_num = $cart_rs->num_rows;

        if ($cart_num == 1) {
            $cart_data = $cart_rs->fetch_assoc();
            $list_id = $cart_data["cart_id"];

            Database::iud("DELETE FROM `cart` WHERE `cart_id`='" . $list_id . "'");
            echo ("Removed");
        } else {
            if(!empty ($qty)){
                Database::iud("INSERT INTO `cart`(`qty`,`product_id`,`user_email`) VALUES 
                ('".$qty."','" . $pid . "','" . $email . "')");
                echo ("Added");

            }else{
                Database::iud("INSERT INTO `cart`(`product_id`,`user_email`) VALUES 
                ('" . $pid . "','" . $email . "')");
                echo ("Added");

            }
           
        }
    }
}

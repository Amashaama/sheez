<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    if (isset($_GET["id"])) {

        $email = $_SESSION["u"]["email"];
        $pid = $_GET["id"];

        /*    $watchlist_rs = Database::search("SELECT product.id,product.price,product.qty,product.title,color.clr_name,
        condition.condition_name FROM `product` INNER JOIN `color` ON product.color_clr_id
        =color.clr_id INNER JOIN `condition` ON product.condition_condition_id
        =condition.condition_id WHERE product.id IN(SELECT product_id FROM `watchlist`WHERE `product_id`='".$pid."'
                AND `user_email`= '".$email."')"); */

        $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $pid . "' 
         AND `user_email`='" . $email . "'");


        $watchlist_num = $watchlist_rs->num_rows;

        if ($watchlist_num == 1) {
            $watchlist_data = $watchlist_rs->fetch_assoc();
            $list_id = $watchlist_data["id"];

            Database::iud("DELETE FROM `watchlist` WHERE `id`='" . $list_id . "'");
            echo ("Removed");
        } else {
            Database::iud("INSERT INTO `watchlist`(`product_id`,`user_email`) VALUES 
            ('" . $pid . "','" . $email . "')");
            echo ("Added");
        }
    }
}

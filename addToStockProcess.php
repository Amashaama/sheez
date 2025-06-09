<?php

session_start();
require "connection.php";

$email = $_SESSION["a"]["email"];


$pid = $_POST["t"];
$model = $_POST["m"];
$new_model = $_POST["nm"];
$brand = $_POST["b"];
$new_brand = $_POST["nb"];
$price = $_POST["p"];
$qty = $_POST["q"];
$status = $_POST["s"];

if (empty($pid)) {
    echo ("Please Select a product name ");
} else if (empty($price)) {
    echo ("please type a price");
} else {


    $mhb_rs = Database::search("SELECT * FROM `model_has_brand` WHERE 
`model_model_id`='" . $model . "' AND `brand_brand_id` ='" . $brand . "' ");


    $mhb_num = $mhb_rs->num_rows;
    $mhb_data = $mhb_rs->fetch_assoc();


    if ($mhb_num > 0) {

        $rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "' AND `price`='" . $price . "' AND `model_has_brand_id`='" . $mhb_data["id"] . "' ");
        $num = $rs->num_rows;
        $d = $rs->fetch_assoc();

        if ($num == 1) {

            $new_qty = $d["qty"] + $qty;
            //update for product and insert for stock
            Database::iud("UPDATE `product` SET `qty`='" . $new_qty . "', `model_has_brand_id`='" . $mhb_data["id"] . "'    WHERE `id`='" . $pid . "'  ");

            Database::iud("INSERT INTO `stock` (`price`,`qty`,`product_id`,`status_status_id`,`model_has_brand_id`)
     VALUES ('" . $price . "','" . $qty . "','" . $pid . "','" . $status . "','" . $mhb_data["id"] . "') ");

            echo ("1");
        } else {
            // insert q for stock 

            Database::iud("UPDATE `product` SET `qty`='" . $qty . "', `model_has_brand_id`='" . $mhb_data["id"] . "', `price`='" . $price . "' WHERE `id`='" . $pid . "'  ");

            Database::iud("INSERT INTO `stock` (`price`,`qty`,`product_id`,`status_status_id`,`model_has_brand_id`)
    VALUES ('" . $price . "','" . $qty . "','" . $pid . "','" . $status . "','" . $mhb_data["id"] . "') ");

            echo ("2");
        }
    } else {


        Database::iud("INSERT INTO `model` (`model_name`) 
    VALUES ('" . $new_model . "')");

        $nm_rs = Database::search("SELECT * FROM `model` WHERE `model_name`='" . $new_model . "' ");
        $nm_data = $nm_rs->fetch_assoc();


        Database::iud("INSERT INTO `brand` (`brand_name`) 
    VALUES ('" . $new_brand . "')");

        $nb_rs = Database::search("SELECT * FROM `brand` WHERE `brand_name`='" . $new_brand . "' ");
        $nb_data = $nb_rs->fetch_assoc();

        Database::iud("INSERT INTO `model_has_brand` (`model_model_id`, `brand_brand_id`) 
    VALUES ('" . $nm_data["model_id"] . "', '" . $nb_data["brand_id"]. "')");

        $new_mhb_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `model_model_id`='" . $nm_data["model_id"] . "' AND `brand_brand_id`='" . $nb_data["brand_id"] . "' ");

        $new_mhb_data = $new_mhb_rs->fetch_assoc();

        Database::iud("UPDATE `product` SET `qty`='" . $qty . "', `model_has_brand_id`='" . $new_mhb_data["id"] . "', `price`='" . $price . "' WHERE `id`='" . $pid . "'  ");

        Database::iud("INSERT INTO `stock` (`price`,`qty`,`product_id`,`status_status_id`,`model_has_brand_id`)
        VALUES ('" . $price . "','" . $qty . "','" . $pid . "','" . $status . "','" . $new_mhb_data["id"] . "') ");

        echo ("3");
    }
}

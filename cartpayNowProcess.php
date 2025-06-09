<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $pid = $_GET["id"];
    $qty = $_GET["qty"];
    $umail = $_SESSION["u"]["email"];

    $array;

    $order_id = uniqid();

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
    $product_data = $product_rs->fetch_assoc();

    $city_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "'");
    $city_num = $city_rs->num_rows;

    if ($city_num == 1) {

        $city_data = $city_rs->fetch_assoc();

        $city_id = $city_data["city_city_id"];
        $address = $city_data["line1"] . "," . $city_data["line2"];

        $district_rs = Database::search("SELECT * FROM `city` WHERE `city_id`='" . $city_id . "'");
        $district_data = $district_rs->fetch_assoc();

        $district_id = $district_data["district_district_id"];
        $delivery = 0;

        if ($district_id == 1) {
            $delivery = $product_data["delivery_fee_colombo"];
        } else {
            $delivery = $product_data["delivery_fee_other"];
        }

        $item = $product_data["title"];
        $amount_without_df = ((int)$product_data["price"] * (int)$qty);
        $amount = ((int)$product_data["price"] * (int)$qty) + (int)$delivery;

        /* invoice data add code */
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");


        Database::iud("INSERT INTO `invoice` (`order_id`,`date`,`total`,`qty`,`status`,`product_id`,`user_email`) 
        VALUES ('" . $pid . "','" . $date . "','" . $amount_without_df. "','" . $qty . "','1','" . $pid . "','" . $umail . "') ");
        /* invoice data add code */

        Database::iud("INSERT INTO `recent` (`user_email`,`product_id`)
        VALUES ('".$umail."','".$pid."') ");



        $fname = $_SESSION["u"]["fname"];
        $lname = $_SESSION["u"]["lname"];
        $mobile = $_SESSION["u"]["mobile"];
        $uaddress = $address;
        $city = $district_data["city_name"];

        $merchant_id = "1224036";
        $merchant_secret = "NzM2NDUyODQyMTEyNDA2MzExMTM3NTE4NDU4NTUzNDI1Njk4MzE0";
        $currency = "LKR";

        $hash = strtoupper(
            md5(
                $merchant_id .
                    $order_id .
                    number_format($amount, 2, '.', '') .
                    $currency .
                    strtoupper(md5($merchant_secret))
            )
        );

        $array["id"] = $order_id;
        $array["item"] = $item;
        $array["amount"] = $amount;
        $array["fname"] = $fname;
        $array["lname"] = $lname;
        $array["mobile"] = $mobile;
        $array["address"] = $uaddress;
        $array["umail"] = $umail;
        $array["city"] = $city;
        $array["hash"] = $hash;

        echo json_encode($array);
    } else {
        echo ("address error");
    }
}

?>

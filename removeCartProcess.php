<?php 

require "connection.php";

if(isset($_GET["id"])){

    $cid= $_GET["id"];

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `cart_id`='".$cid."'");
    $cart_data = $cart_rs->fetch_assoc();

    $cart_num= $cart_rs->num_rows;

    $umail = $cart_data["user_email"];
    $pid = $cart_data["product_id"];

    
        Database::iud("DELETE FROM `cart` WHERE `cart_id`='".$cid."'");
   
  
        Database::iud("INSERT INTO `recent`(`user_email`,`product_id`) VALUES ('".$umail."','".$pid."')");
        echo ("Product has been removed");




}else{
    echo("something went wrong");
}



?>
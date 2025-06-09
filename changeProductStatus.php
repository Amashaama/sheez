<?php 

include "connection.php";

$pid = $_POST["pid"];

if(empty($pid)){
    echo("Please type a product id First");
}else{

$rs= Database::search("SELECT * FROM `product` WHERE `id`='".$pid."' ");

$num = $rs->num_rows;

if($rs->num_rows ==1){

    $d= $rs->fetch_assoc();

    if($d["status_status_id"]==1){
        Database::iud("UPDATE `product` SET `status_status_id`='2' WHERE `id`='".$pid."' ");
        echo("Product Deactivated");
    }else if($d["status_status_id"]==2){
        Database::iud("UPDATE `product` SET `status_status_id`='1' WHERE `id`='".$pid."' ");
        echo("Product Activate");

    }

   
}else{
    echo("Not a valid product ID");
}

}


?>
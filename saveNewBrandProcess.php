<?php 

require "connection.php";

$brand = $_POST["b"];

if(empty($brand)){
    echo("Please type new brand name");
}else{

$brand_rs = Database::search("SELECT * FROM `brand` WHERE `brand_name`='".$brand."' ");
$brand_num = $brand_rs->num_rows;

if($brand_num ==0){
    Database::iud("INSERT INTO `brand` (`brand_name`) VALUES ('".$brand."') ");
    echo("success");

}else if($brand_num == 1){
    echo("This brand is in your brand list");
}
}


?>
<?php
include "connection.php";

$e = $_POST["e"];


if(empty($e)){
    echo("Please type email first !");
}else{

$rs = Database::search("SELECT * FROM `user` WHERE `status`='1'  AND `email`='" . $e . "' ");
$d = $rs->fetch_assoc();

$num = $rs->num_rows;

if ($num ==1) {

    
    Database::iud("UPDATE `user` SET `status`='2' WHERE `email`='" . $e . "' ");
    echo ("success");

} else if ($num ==0) {
    echo ("You already changed the status of this user ");
} else {
    echo ("somethng went wrong");
}
}

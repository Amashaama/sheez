<?php

require "connection.php";

$temp_qty = $_GET["qty"];
$pid= $_GET["pid"];

Database::iud("INSERT INTO `temp_qty` (`qty`,`product_id`) VALUES ('".$temp_qty."','".$pid."') ");

echo("success");



?>
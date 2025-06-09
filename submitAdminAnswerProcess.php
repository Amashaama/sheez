<?php

require "connection.php";

$qid = $_GET["id"];
$answer=$_GET["ans"];

Database::iud("UPDATE `qna` SET `answer`='".$answer."', `status`='2'  WHERE `id`='".$qid."' ");


echo(1);




?>
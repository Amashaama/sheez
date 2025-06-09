<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];
    $pid = $_POST["pid"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $question = $_POST["q"];

    if (empty($question)) {
        echo ("Please enter your question");
    } else {

        Database::iud("INSERT INTO `qna` (`question`,`date`,`user_email`,`product_id`,`status`) 
         VALUES ('" . $question . "','" . $date . "','" . $email . "','" . $pid . "','1') ");

        echo ("1");
    }
} else {
    echo ("Something went wrong");
}

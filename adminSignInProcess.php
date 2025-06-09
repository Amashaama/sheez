<?php
session_start();
include "connection.php";

$email = $_POST["e"];

if (empty($email)) {
    echo ("Please enter your email");
} else if (strlen($email) > 100) {
    echo ("Email must have less than 100 characters");
} else if  (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid email address");
}else{

$rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'  ");

$num = $rs->num_rows;
$d = $rs->fetch_assoc();


if ($num == 1) {

    if ($d["user_type_id"] == 1) {
        echo ("success");

        $_SESSION["a"]=$d; // store logged users data in session called "a"
    } else {
        echo ("You don't have admin account");
    }
} else {
    echo ("Invalid email address");
}

}

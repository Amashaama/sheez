<?php
session_start();
include "connection.php";

$p_rs = Database::search("SELECT * FROM `product` ");
$p_num = $p_rs->num_rows;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Analyze table | Admin</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <!-- moreee icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <link rel="icon" href="resources/logo.svg" />

    <style>
        .request-item {
            cursor: pointer;
            padding: 10px;
            border-bottom: 2px solid #ddd;
        }

        .request-item:hover {
            background-color: #f8f9fa;
        }
    </style>


</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class=" col- 10">
            <a href="adminPanel.php" class=" text-dart">
                            <span class="material-icons-outlined mt-2">arrow_back</span>
                        </a>
            </div>


            <div class="offset-2 col-8  bg-body ">
                <h4 class="mt-3 mb-5 text-center text-dark fw-bold">Feedback Analysis for product</h4>



                <?php

                for ($q = 0; $q < $p_num; $q++) {
                    $p_data = $p_rs->fetch_assoc();

                ?>
                    <div class="request-item fs-5" onclick="loadFg(<?php echo $p_data['id'];  ?>)"> <?php echo $p_data["id"]  ?>: <?php echo $p_data["title"] ?></div>


                <?php

                }


                ?>



            </div>

        </div>
    </div>



    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>

</body>

</html>





<?php





?>
<?php

require "connection.php";



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply | Admin</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <!-- moreee icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <link rel="icon" href="resource/logo.svg" />

    <style>
        body {
            padding: 20px;
        }

        .request-list {
            border-right: 2px solid #ddd;
            height: 100vh;
            overflow-y: auto;
        }

        .request-details {
            padding: 40px;
        }

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

    <?php

    $q_rs = Database::search("SELECT * FROM `qna` WHERE qna.status='1' ");

    $q_num = $q_rs->num_rows;







    ?>
    <div class="container-fluid">
        <div class="row">
          

            <div class="col-4 request-list bg-body">
                <h4 class="mb-5">Client Requests</h4>
                <?php

                for ($q = 0; $q < $q_num; $q++) {
                    $q_data = $q_rs->fetch_assoc();

                ?>
                    <div class="request-item text-danger fw-bold fs-5" onclick="loadQNA(<?php echo $q_data['id'];  ?>)">Quesion ID: <?php echo $q_data["id"]  ?></div>


                <?php

                }


                ?>


            </div>


            <div class="col-8 request-details " id="answer_form">
                


            </div>


        </div>

    </div>






    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>

</body>

</html>
<?php
session_start();
require "connection.php";

if (isset($_SESSION["a"])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home page add on | Addmin Panel</title>


        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <!-- google icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

        <!-- bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

        <link rel="icon" href="resources/logo.svg" />
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

        <div class="container-fluid">
            <div class="row">
                <div class=" col- 10">
                    <a href="adminPanel.php" class=" text-dart">
                        <span class="material-icons-outlined mb-2">arrow_back</span>
                    </a>
                </div>



                <div class="col-4 request-list bg-body">
                    <h4 class="mb-5 text-dark fw-bold">Home Page Images Adding</h4>

                    <div class="request-item text-success fw-bold fs-5" onclick="loadSwiperadd();">Swiper Images </div>
                    <div class="request-item text-success fw-bold fs-5" onclick="loadBrandImages();">Brand Images</div>




                </div>


                <div class="col-8 request-details " id="home_add_view">




                </div>


            </div>

        </div>






        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>



    </body>

    </html>

<?php







} else {
    echo ("You are not an addmin");
}


?>
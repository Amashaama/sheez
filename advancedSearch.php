<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Advanced Search | sheez</title>
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <!-- google icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

        <!-- bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

        <link rel="icon" href="resources/logo.svg" />

        <style>
            .card_img_top {
                width: 100%;
                height: fit-content;

            }

            .rear_img {
                width: 100%;
                height: fit-content;
                opacity: 0;
                position: absolute;
                top: 0;
                left: 0;
                z-index: -1;
                -webkit-transition: opacity 0.5s ease-out;
                -o-transition: opacity 0.5s ease-out;
                transition: opacity 0.5s ease-out;



            }

            .product-img:hover .rear_img {
                opacity: 1;
                z-index: 0;


            }
        </style>

    </head>
   
   <body style=" background-image: url(resources/r1\ \(1\).png);">
   

        <div class="container-fluid" >
         <div class="row">
                <div class="col-12">
                <a href="home5.php" class=" text-dart">
                            <span class="material-icons-outlined mt-2">arrow_back</span>
                        </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12 offset-lg-3 col-lg-6  bg-body rounded mt-3">

                    <div class="row">
                        <div class="col-12 text-center">
                            <P class="fs-1 text-dark-50 fw-bold mt-3 pt-2">Advanced Search</P>
                        </div>

                    </div>

                </div>

                <div class="offset-lg-2 col-lg-8 col-12 mt-3 bg-body rounded">
                    <div class="row">
                        <div class="offset-lg-1 col-lg-10 col-12">
                            <div class="row">
                                <div class="col-12 col-lg-10 mt-2 mb-1">
                                    <input type="text" class="form-control" placeholder="Type keyword to search..." id="type" />
                                </div>
                                <div class="col-12 col-lg-2 mt-2 mb-1 d-grid">
                                    <button class="btn btn-primary" onclick="advancedSearch(0);">Search</button>
                                </div>
                                <div class="col-12">
                                    <hr class="border border-3 border-dark">
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="row">
                        <div class="offset-lg-1 col-12 col-lg-10">
                            <div class="row">

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 col-lg-4 mb-3">
                                            <select class="form-select" id="cat">
                                                <option value="0">Select Category</option>
                                                <?php

                                                $category_rs = Database::search("SELECT * FROM `category` ");
                                                $category_num = $category_rs->num_rows;

                                                for ($x = 0; $x < $category_num; $x++) {
                                                    $category_data = $category_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $category_data["cat_id"]; ?>"><?php echo $category_data["cat_name"]; ?></option>

                                                <?php
                                                }

                                                ?>



                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-4 mb-3">
                                            <select class="form-select" id="brand">
                                                <option value="0">Select Brand</option>
                                                <?php

                                                $brand_rs = Database::search("SELECT * FROM `brand` ");
                                                $brand_num = $brand_rs->num_rows;

                                                for ($x = 0; $x < $brand_num; $x++) {
                                                    $brand_data = $brand_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $brand_data["brand_id"]; ?>"><?php echo $brand_data["brand_name"]; ?></option>

                                                <?php
                                                }

                                                ?>



                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-4 mb-3">
                                            <select class="form-select" id="model">
                                                <option value="0">Select Model</option>
                                                <?php

                                                $model_rs = Database::search("SELECT * FROM `model` ");
                                                $model_num = $model_rs->num_rows;

                                                for ($x = 0; $x < $model_num; $x++) {
                                                    $model_data = $model_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $model_data["model_id"]; ?>"><?php echo $model_data["model_name"]; ?></option>

                                                <?php
                                                }

                                                ?>

                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-6 mb-3">
                                            <select class="form-select" id="condition">
                                                <option value="0">Select Condition</option>
                                                <?php

                                                $condition_rs = Database::search("SELECT * FROM `condition` ");
                                                $condition_num = $condition_rs->num_rows;

                                                for ($x = 0; $x < $condition_num; $x++) {
                                                    $condition_data = $condition_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $condition_data["condition_id"]; ?>"><?php echo $condition_data["condition_name"]; ?></option>

                                                <?php
                                                }

                                                ?>




                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-6 mb-3">
                                            <select class="form-select" id="color">
                                                <option value="0">Select Colour</option>
                                                <?php

                                                $color_rs = Database::search("SELECT * FROM `color` ");
                                                $color_num = $color_rs->num_rows;

                                                for ($x = 0; $x < $color_num; $x++) {
                                                    $color_data = $color_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $color_data["clr_id"]; ?>"><?php echo $color_data["clr_name"]; ?></option>

                                                <?php
                                                }

                                                ?>

                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-6 mb-3">
                                            <input type="text" class="form-control" placeholder="Price From..." id="pf" />
                                        </div>

                                        <div class="col-12 col-lg-6 mb-3">
                                            <input type="text" class="form-control" placeholder="Price To..." id="pt" />
                                        </div>

                                        <div class="col-12 offset-lg-2 col-lg-8 mb-3">
                                            <select class="form-select border" id="ps">

                                                <option value="0">Sort By</option>
                                                <option value="1">Price Low to High</option>
                                                <option value="2">Price High to Low</option>


                                            </select>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="offset-lg-1 col-lg-10 col-12 bg-body mt-3 rounded mb-3">
                    <div class="offset-lg-1 col-12 col-lg-10 text-center">
                        <div class="row" id="view_area">
                            <div class="offset-5 col-2 mt-5 mb-5">
                                <span class="fw-bold text-black-50"><i class="bi bi-search h1" style="font-size: 100px;"></i></span>
                            </div>

                        </div>
                    </div>



                </div>





            </div>
        </div>










        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>

    </body>

    </html>






<?php






} else {
    echo ("Please Logged In First");
}




?>
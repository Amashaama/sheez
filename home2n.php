<?php

session_start();
require "connection.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Page</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resources/logo/1.svg" />

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

<body>


    <?php include "header4.php"; ?>

    <?php include "header2.php"; ?>

    <div class="container-fluid">



        <div class="row">
            <div class="col-12">

                <div class="row banner_main">
                    <div class="col-8 col-md-8">
                        <div class="text-bg">
                            <h1> <span class="blodark"> Sheez </span> <br>Trends 2024</h1>
                            <p>A huge fashion collection for ever </p>
                            <a class="read_more" href="#">Shop now</a>
                        </div>
                    </div>
                    <div class=" col-4 col-md-4">
                        <div class="ban_img">
                            <figure><img src="images/ban_img.png" alt="#" /></figure>
                        </div>
                    </div>
                </div>


            </div>
            <div class="title">
                <h1>Best Collection of 2021</h1>
            </div>

            <!-- category name -->

            <?php

            $c_rs = Database::search("SELECT * FROM `category` WHERE `cat_id`='1' ");
            $c_num = $c_rs->num_rows;

            for ($y = 0; $y < $c_num; $y++) {
                $c_data = $c_rs->fetch_assoc();


            ?>

                <div class="col-12 mt-3 mb-3">
                    <a href="#" class="text-decoration-non text-dark fs-3 fw-bold"><?php echo $c_data["cat_name"] ?></a> &nbsp;&nbsp;
                    <a href="#" class="text-decoration-none text-dark fs-6">See All&nbsp;&rarr;</a>
                </div>

                <!-- category name -->

                <!-- start product type 1 -->



                <!--start product type 2 -->
                <div class="col-12 mb-3">

                    <div class="row border border-dark">
                        <div class="col-12 ">
                            <div class="row justify-content-center gap-5">
                                <?php
                                $product_rs = Database::search("SELECT * FROM `product` WHERE `category_cat_id`='" . $c_data['cat_id'] . "' AND `status_status_id`='1' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0");

                                $product_num = $product_rs->num_rows;

                                for ($x = 0; $x < $product_num; $x++) {
                                    $product_data = $product_rs->fetch_assoc();

                                ?>

                                    <div class="card col-12 col-lg-2 mt-2 mb-2 " style="width: 20rem;">

                                        <?php

                                        $img_rs = Database::search("SELECT * FROM `product_img` WHERE `Product_id`='" . $product_data['id'] . "' ");
                                        $img_num = $img_rs->num_rows;
                                        $img_list = array();

                                        if ($img_num != 0) {
                                            for ($y = 0; $y < $img_num; $y++) {
                                                $img_data = $img_rs->fetch_assoc();
                                                $img_list[$y] = $img_data["img_path"];

                                                if ($y == 1) {
                                        ?>
                                                    <div class="product-img">
                                                        <img src="<?php echo $img_list[0] ?>" class="card_img_top img-thumbnail mt-2" style=" height:350px;" />
                                                        <img src="<?php echo $img_list[1] ?>" class="rear_img img-thumbnail mt-2" style=" height:350px;" />
                                                    </div>
                                        <?php

                                                }
                                            }
                                        }
                                        ?>



                                        <div class="card-body ms-0 m-0 text-center">
                                            <h5 class="card-title fw-bold fs-6"><?php echo $product_data["title"]; ?></h5>
                                            <span class="badge rounded-pill text-bg-info"><?php

                                                                                            if ($product_data["condition_condition_id"] == 1) {
                                                                                                echo ("New");
                                                                                            } else {
                                                                                                echo ("Used");
                                                                                            }


                                                                                            ?></span>
                                            <span class="card-text text-primary">Rs.<?php echo $product_data["price"];  ?></span><br />
                                            <span class="card-text text-warning fw-bold"> In Stock</span><br />
                                            <span class="card-text text-success fw-bold"><?php echo $product_data["qty"]; ?> Items Available </span><br />
                                            <a href="<?php echo "singleproductview.php?id=" . ($product_data["id"]); ?>" class="col-12 btn btn-success">Buy Now</a><br />
                                            <button class="col-12 btn btn-dark mt-2">
                                                <i class="bi bi-cart4 text-white fs-5"></i>
                                            </button>
                                            <button onclick="addToWatchlist(<?php echo $product_data['id']; ?>);" class="col-12 btn btn-outline-light mt-2 border border-danger">
                                                <i class="bi bi-heart-fill text-danger fs-5"></i>
                                            </button>

                                        </div>
                                    </div>


                        

                        <?php
                                }
                        ?>

                        </div>
                    </div>
                    </div>

                </div>
                <!--end product type 2 -->





            <?php
            }




            ?>


        </div>










    </div>


    <script src="https://storage.ko-fi.com/cdn/scripts/overlay-widget.js"></script>
    <script>
        /* womens clothing image change */



        /* womens clothing image change */
    </script>


</body>

</html>
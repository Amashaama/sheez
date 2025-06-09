<?php

session_start();
require "connection.php";


?>


<!DOCTYPE html>

<html>

<head>

    <title>Home | sheez</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resources/logo/1.svg" />

</head>

<body>



    <!--  <?php include "header.php"; ?> -->

    <div class="container-fluid">


        <div class="row">
            <?php include "header3.php"; ?>

            <?php include "header2.php"; ?>
            
            <div class="col-12">
                <div class="row">

                    <section class="banner_main">
                        <div class="container">
                            <div class="row">
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
                    </section>
                </div>

            </div>
        </div>
        <div class="row swiperRow">

            <?php include "swiper.php" ?>

        </div>


        <!--
          <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-4 pa_left">
                        <div class="carousel-cell2 six_probpx yellow_bg">
                            <i><img src="images/shoes.png" alt="#" /></i>
                            <span>Shoes</span>
                        </div>
                    </div>
                    <div class="col-md-2  col-sm-4 pa_left">
                        <div class="carousel-cell2 six_probpx bluedark_bg">
                            <i><img src="images/underwear.png" alt="#" /></i>
                            <span>underwear</span>
                        </div>
                    </div>
                    <div class="col-md-2  col-sm-4 pa_left">
                        <div class="carousel-cell2 six_probpx yellow_bg">
                            <i><img src="images/pent.png" alt="#" /></i>
                            <span>Pante & socks</span>
                        </div>
                    </div>
                    <div class="col-md-2  col-sm-4 pa_left">
                        <div class="carousel-cell2 six_probpx bluedark_bg">
                            <i><img src="images/t_shart.png" alt="#" /></i>
                            <span>T-shirt & tankstop</span>
                        </div>
                    </div>
                    <div class="col-md-2  col-sm-4 pa_left">
                        <div class="carousel-cell2 six_probpx yellow_bg">
                            <i><img src="images/jakit.png" alt="#" /></i>
                            <span>cardigans & jumpers</span>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 pa_left">
                        <div class="carousel-cell2 six_probpx bluedark_bg">
                            <i><img src="images/helbet.png" alt="#" /></i>
                            <span>Top & hat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->




        <!--category names-->

        <?php

        $c_rs = Database::search("SELECT * FROM `category`");

        $c_num = $c_rs->num_rows;

        for ($y = 0; $y < $c_num; $y++) {
            $c_data = $c_rs->fetch_assoc();

        ?>

            <div class="col-12 mt-3 mb-3">
                <a href="#" class="text-decoration-none text-dark fs-3 fw-bold"><?php echo $c_data["cat_name"] ?></a>&nbsp;&nbsp;
                <a href="#" class="text-decoration-none text-dark fs-6">See All&nbsp;&rarr;</a>
            </div>
            <!--category names-->
            <!--Products-->
            <div class="col-12 mb-3">
                <div class="row border border-primary">

                    <div class="col-12">
                        <div class="row justify-content-center gap-2">
                            <?php

                            $product_rs = Database::search("SELECT * FROM `product` WHERE `category_cat_id`='" . $c_data['cat_id'] . "' AND `status_status_id`='1' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0");

                            $product_num = $product_rs->num_rows;

                            for ($x = 0; $x < $product_num; $x++) {
                                $product_data = $product_rs->fetch_assoc();

                            ?>

                                <div class="card col-12 col-lg-2 mt-2 mb-2 " style="width: 18rem;">

                                    <?php

                                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `Product_id`='" . $product_data['id'] . "' ");

                                    $img_data = $img_rs->fetch_assoc();




                                    ?>




                                    <img src="<?php echo $img_data["img_path"] ?>" id="hoverImgChng" class="card-img-top img-thumbnail mt-2" style=" height:350px;" onmouseover="setNewImage();" onmouseout="setOldImage();" />
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

            <!--Products-->
        <?php
        }



        ?>




        <!-- Partners Crousel !-->

        <div class="my-5">
            <h1 class="text-center my-3">Our Partners</h1>
            <p class="text-center">Our signature collection of brands comes with comfort, style, trendy looks. All for a good price.</p>

            <div class="carousel" data-flickity='{"wrapAround": true,  "autoPlay": true}'>
                <div class="carousel-cell"><img src="resources/logo/brands/10 Great Tips for Redesigning a Logo in 2021.jpg"></div>
                <div class="carousel-cell"><img src="resources/logo/brands/34 Creative Business Logo Designs for Inspiration – 49 (2).jpg"></div>
                <div class="carousel-cell"><img src="resources/logo/brands/Letter A.jpg"></div>
                <div class="carousel-cell"><img src="resources/logo/brands/shoes _ logo idea.jpg"></div>
                <div class="carousel-cell"><img src="resources/logo/brands/10 Great Tips for Redesigning a Logo in 2021.jpg"></div>
                <div class="carousel-cell"><img src="resources/logo/brands/10 Great Tips for Redesigning a Logo in 2021.jpg"></div>
                <div class="carousel-cell"><img src="resources/logo/brands/10 Great Tips for Redesigning a Logo in 2021.jpg"></div>

            </div>

        </div>
        <!-- End Partners Crousel !-->



    </div>


    <?php include "footer.php"; ?>






    <script src="script.js"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>
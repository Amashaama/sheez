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


<body class="container-fluid">


    <div class="row">
        <?php include "header3.php"; ?>

        <?php include "header2.php"; ?>


        <section class="row banner_main ">

            <div class="col-8 col-md-8 ">
                <div class="text-bg">
                    <h1> <span class="blodark">Sheez </span> <br>Trends 2024</h1>
                    <p>A huge fashion collection for ever </p>
                    <a class="read_more" href="#">Shop now</a>
                </div>
            </div>
            <div class=" col-4 col-md-4">
                <div class="ban_img">
                    <figure><img src="images/ban_img.png" alt="#" /></figure>
                </div>
            </div>
        </section>
    </div>


    <div class="row">



        <div class=" col-12 swiperRow">

            <?php include "swiper.php" ?>
        </div>

    </div>
    <div class="row">

        <?php

        $c_rs = Database::search("SELECT * FROM `category`");
        $c_num = $c_rs->num_rows;

        for ($y = 0; $y < $c_num; $y++) {
            $c_data = $c_rs->fetch_assoc();
        ?>


            <div class="col-12 mt-3 mb-3 text-center">
                <a href="#" class="text-decoration-none text-dark fs-3 fw-bold"><?php echo $c_data["cat_name"] ?></a>&nbsp;&nbsp;
                <a href="#" class="text-decoration-none text-dark fs-6">See All&nbsp;&rarr;</a>
            </div>

            <!--category names -->
           

 <!-- products-->

           
 <div class="row mt-2 mb-4">

<?php


$product_rs = Database::search("SELECT * FROM `product` WHERE `category_cat_id`='" . $c_data['cat_id'] . "' AND `status_status_id`='1' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0");

$product_num = $product_rs->num_rows;

for ($x = 0; $x < $product_num; $x++) {
    $product_data = $product_rs->fetch_assoc();

?>

    <div class="avatar2 col-12 col-lg-3 mt-5  mb-5">
        <div class="avatar_card">
            <!-- Your card content here -->
            <div class="poster_avatar">
                <?php

                $img_rs = Database::search("SELECT * FROM `product_img` WHERE `Product_id`='" . $product_data['id'] . "' ");

                $img_data = $img_rs->fetch_assoc();




                ?>

                <img src="<?php echo $img_data["img_path"] ?>">

            </div>
            <div class="details">
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
    </div>


<?php
}

?>







</div>





<!-- Repeat the above structure for more rows and cards -->


<!-- products-->



                         


            <?php

        }

            ?>











            <!-- Partners Crousel !-->

            <div class="col-12 my-5">
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

            <?php include "footer.php"; ?>



    </div>









    <script src="script.js"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>
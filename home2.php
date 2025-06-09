

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

   <body style="background-color: 	#AFE1AF;">


   <?php

session_start();
require "connection.php";

if (isset($_GET['id'])) {
   $catno = $_GET['id'];

?>
      <div class="container-fluid">


         <div class="row m-1">
            <div class="title01 text-success text-center">
               <h1>Best Collection of 2021</h1>
            </div>

            <!-- category name = 1 -->

            <?php

            $c_rs = Database::search("SELECT * FROM `category` WHERE `cat_id`='".$catno."' ");
            $c_num = $c_rs->num_rows;

            for ($y = 0; $y < $c_num; $y++) {
               $c_data = $c_rs->fetch_assoc();


            ?>

               <div class="col-12 mt-3 mb-3">
                  <a href="#" class="text-decoration-non text-dark fs-3 fw-bold"><?php echo $c_data["cat_name"] ?></a> &nbsp;&nbsp;
                  <a href="#" class="text-decoration-none text-dark fs-6">All&nbsp;&rarr;</a>
               </div>

               <!-- category name -->

               <!-- start product type 1 -->



               <!--start product type 2 -->
               <div class="col-12 mb-3">
                  <div class="row border border-success ">
                     <div class="col-12">
                        <div class="row justify-content-center gap-5">
                           <?php
                           $product_rs = Database::search("SELECT * FROM `product` WHERE `category_cat_id`='" . $c_data['cat_id'] . "' AND `status_status_id`='1' ORDER BY `datetime_added` ");

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

                                       }else {
                                         
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
                                    <a href="<?php echo "spView.php?id=" . ($product_data["id"]); ?>" class="col-12 btn btn-success">Buy Now</a><br />
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

<?php
}

?>
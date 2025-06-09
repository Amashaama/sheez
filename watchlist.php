<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Watchlist | eShop</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resources/logo.svg" />
    </head>

    <body class="container-fluid">
    <?php
    include "header.php";
    ?>
       
            <div class="row">

              

                
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 border border-1 border-success rounded mb-2">
                            <div class="row">

                                <div class="col-12 text-center">
                                    <label class="form-label fs-1 fw-bolder">Watchlist &hearts;</label>
                                </div>

                                <div class="col-12 col-lg-12">
                                    <hr />
                                </div>

                               

                                <div class="col-11 col-lg-2 border-0 border-end border-1 border-dark">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="home5.php">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                        </ol>
                                    </nav>
                                    <nav class="nav nav-pills flex-column">
                                        <a class="nav-link active" aria-current="page" href="#">My Watchlist</a>
                                        <a class="nav-link" href="cart.php">My Cart</a>
                                        <a class="nav-link" href="r.php">Recents</a>
                                    </nav>
                                </div>

                                <?php
                                $watchlist_rs = Database::search("SELECT product.id,product.price,product.qty,product.title,color.clr_name,
                                condition.condition_name,user.fname,user.lname,user.email FROM `product` INNER JOIN `color` ON product.color_clr_id
                                =color.clr_id INNER JOIN `condition` ON product.condition_condition_id
                                =condition.condition_id INNER JOIN `user` ON user.email = product.user_email 
                                WHERE product.id IN(SELECT product_id FROM `watchlist` WHERE 
                                `user_email`='" . $_SESSION["u"]["email"] . "')");

                                $watchlist_num = $watchlist_rs->num_rows;




                                if ($watchlist_num == 0) {
                                ?>
                                    <!-- empty view -->
                                    <div class="col-12 col-lg-9">
                                        <div class="row">
                                            <div class="col-12 emptyView"></div>
                                            <div class="col-12 text-center">
                                                <label class="form-label fs-1 fw-bold">You have no items in your Watchlist yet.</label>
                                            </div>
                                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                                <a href="home5.php" class="btn btn-success fs-3 fw-bold">Start Shopping</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- empty view -->
                                    <?php
                                } else {
                                    for ($x = 0; $x < $watchlist_num; $x++) {
                                        $watchlist_data = $watchlist_rs->fetch_assoc();

                                        $img_rs = Database::search("SELECT * FROM `product_img` WHERE `Product_id`='" . $watchlist_data['id'] . "' ");
                                        $img_data = $img_rs->fetch_assoc();





                                        $remove_watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE 
                                        `user_email`='" . $_SESSION["u"]["email"] . "'  ");

                                        $remove_watchlist_num = $remove_watchlist_rs->num_rows;

                                        $remove_watchlist_data = $remove_watchlist_rs->fetch_assoc();



                                    ?>
                                        <!-- have products -->
                                        <div class="col-12 col-lg-9">
                                            <div class="row">

                                                <div class="card mb-3 mx-0 mx-lg-2 col-12">
                                                    <div class="row g-0">
                                                        <div class="col-md-4">


                                                            <img src="<?php echo $img_data["img_path"] ?>" class="img-fluid rounded-start" style="height: 200px;" />
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="card-body">

                                                                <h5 class="card-title fs-2 fw-bold text-dark"><?php echo $watchlist_data["title"] ?></h5>

                                                                <span class="fs-5 fw-bold text-black-50">Colour : <?php echo $watchlist_data["clr_name"] ?></span>
                                                                &nbsp;&nbsp; | &nbsp;&nbsp;

                                                                <span class="fs-5 fw-bold text-black-50">Condition : <?php echo $watchlist_data["condition_name"] ?></span>
                                                                <br />
                                                                <span class="fs-5 fw-bold text-black-50">Price :</span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-black">Rs. <?php echo $watchlist_data["price"] ?>.00</span>
                                                                <br />
                                                                <span class="fs-5 fw-bold text-black-50">Quantity :</span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-black"><?php echo $watchlist_data["qty"] ?> Items available</span>
                                                                <br />
                                                                <span class="fs-5 fw-bold text-black-50">Seller :</span>

                                                                <span class="fs-5 fw-bold text-black"><?php echo $watchlist_data["fname"] ?> <?php echo $watchlist_data["lname"] ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mt-5">
                                                            <div class="card-body d-lg-grid">
                                                                <a href="<?php echo "spView.php?id=" . ($watchlist_data["id"]); ?>" class="btn btn-outline-success mb-2">Buy Now</a>
                                                                <button onclick="addToCart(<?php echo $watchlist_data['id'];  ?>)" class="col-12 btn btn-outline-dark mt-2 mb-2">
                                                                    Add to cart
                                                                </button>
                                                                <a href="#" onclick="removeFromWatchlist(<?php echo $remove_watchlist_data['id']; ?>);" class="btn btn-outline-danger">Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- have products -->
                                <?php
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>

               

            </div>
            <?php include "footer.php"; ?>
        </div>
     


        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>
<?php
}

?>
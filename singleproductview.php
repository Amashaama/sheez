<?php
session_start();
require "connection.php";

if (isset($_GET["id"])) {
    $pid = $_GET["id"];

    $user = $_SESSION["u"];

    $product_rs = Database::search(" SELECT product.id,product.price,product.qty,product.description,
    product.title,product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,
    product.category_cat_id,product.model_has_brand_id,product.color_clr_id,product.status_status_id,
    product.condition_condition_id,product.user_email,model.model_name AS mname,
    brand.brand_name AS bname FROM `product` INNER JOIN `model_has_brand` ON
    model_has_brand.id=product.model_has_brand_id INNER JOIN `brand` ON
    brand.brand_id=model_has_brand.brand_brand_id INNER JOIN `model` ON
    model.model_id=model_has_brand.model_model_id WHERE product.id='" . $pid . "' ");

    $product_num = $product_rs->num_rows;
    if ($product_num == 1) {
        $product_data = $product_rs->fetch_assoc();

?>

        <!DOCTYPE html>
        <html lang="en" data-bs-theme="dark">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title><?php echo $product_data["title"]; ?> | sheez</title>

            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
            <link rel="stylesheet" href="style.css" />

            <link rel="icon" href="resources/logo/1.svg" />
        </head>

        <body >

        <div class="container-fluid">
                <div class="row" >
                    <?php include "header3.php"; ?>

                    <div class="col-12 mt-0 bg-white singleProduct" >
                        <div class="row">
                            <div class="col-12" style="padding: 20px;">
                                <div class="row">

                                    <div class="col-12 col-lg-2 order-2 order-lg-1">
                                        <ul>
                                            <?php
                                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `Product_id`='" . $pid . "'");
                                            $img_num = $img_rs->num_rows;
                                            $img_list = array();

                                            if ($img_num != 0) {
                                                for ($x = 0; $x < $img_num; $x++) {
                                                    $img_data = $img_rs->fetch_assoc();
                                                    $img_list[$x] = $img_data["img_path"];
                                            ?>
                                                    <li class="d-flex flex-column justify-content-center align-items-center 
                                border border-1 border-secondary mb-1">
                                                        <img src="<?php echo $img_list[$x]; ?>" id="product_img<?php echo $x; ?>" onclick="changeMainImg(<?php echo $x; ?>);" class="img-thumbnail mt-1 mb-1" />
                                                    </li>
                                                <?php

                                                }
                                            } else {
                                                ?>
                                                <li class="d-flex flex-column justify-content-center align-items-center 
                                border border-1 border-secondary mb-1">
                                                    <img src="resources/empty2.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center 
                                border border-1 border-secondary mb-1">
                                                    <img src="resources/empty2.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center 
                                border border-1 border-secondary mb-1">
                                                    <img src="resources/empty2.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                            <?php
                                            }

                                            ?>

                                        </ul>
                                    </div>

                                    <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                        <div class="row">
                                            <div class="col-12 align-items-center border border-1 
                                border-secondary">
                                                <div class="mainImg" id="mainImg"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 order-3">
                                        <div class="row">
                                            <div class="col-12">

                                                <div class="row border-bottom border-dark">
                                                    <nav aria-label="breadcrumb">
                                                        <ol class="breadcrumb">
                                                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                                            <li class="breadcrumb-item active" aria-current="page">Single Product View</li>
                                                        </ol>
                                                    </nav>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-4 fw-bold text-success"><?php echo $product_data["title"]; ?></span>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="badge">
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>

                                                            &nbsp;&nbsp;&nbsp;

                                                            <label class="fs-5 text-dark fw-bold">4.5 Stars | 39 Reviews and Ratings</label>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="row form_size border-bottom border-dark">
                                                    <div class="col-12 my-2 ">

                                                        <span class=" size_selector ">
                                                            <label class="size_text">Size</label>

                                                            <label for="X-Small">
                                                                <input type="radio" name="size" id="x-small">
                                                                <span>XS</span>
                                                            </label>

                                                            <label for="Small">
                                                                <input type="radio" name="size" id="small">
                                                                <span>S</span>
                                                            </label>
                                                            <label for="Medium">
                                                                <input type="radio" name="size" id="medium">
                                                                <span>M</span>
                                                            </label>
                                                            <label for="Large">
                                                                <input type="radio" name="size" id="large">
                                                                <span>L</span>
                                                            </label>
                                                            <label for="X-Large">
                                                                <input type="radio" name="size" id="x-large">
                                                                <span>XL</span>
                                                            </label>
                                                            <label for="XX-Large">
                                                                <input type="radio" name="size" id="xx-large">
                                                                <span>XXL</span>
                                                            </label>

                                                        </span>

                                                    </div>
                                                </div>

                                                <?php

                                                $price = $product_data["price"];
                                                $add = ($price / 100) * 10;
                                                $new_price = $price + $add;
                                                $diff = $new_price - $price;
                                                $percent = ($diff / $price) * 100;

                                                ?>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-4 text-dark fw-bold">Rs. <?php echo $price; ?> .00</span>
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        <span class="fs-4 text-danger fw-bold text-decoration-line-through">
                                                            Rs. <?php echo $new_price;  ?> .00
                                                        </span>
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        <span class="fs-4 fw-bold text-black-50">
                                                            Save Rs. <?php echo $diff; ?> .00
                                                            (<?php echo $percent; ?>%)
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">

                                                        <span class="fs-5 text-primary"><b>Return Policy : </b>No Returns</span><br />
                                                        <span class="fs-5 text-primary"><b>In Stock : </b><?php echo $product_data["qty"]; ?> Items Available</span>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-6 border border-1 border-dark text-center">
                                                                <?php
                                                                $user_rs = Database::search("SELECT * FROM `user` WHERE 
                                                                `email`='" . $product_data["user_email"] . "'");
                                                                $user_data = $user_rs->fetch_assoc();
                                                                ?>
                                                                <span class="fs-5 text-primary"><b>Seller : </b><?php echo $user_data["fname"]; ?></span>
                                                            </div>
                                                            <div class="col-12 col-lg-6 border border-1 border-dark text-center">
                                                                <span class="fs-5 text-primary"><b>Sold : </b>100 Items</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="my-2 offset-lg-2 col-12 col-lg-8 border border-2 border-black rounded">
                                                                <div class="row">
                                                                    <span><?php echo $product_data["description"] ?></span>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12 my-2">
                                                                <div class="row g-2">

                                                                    <div class="border border-1 border-secondary rounded overflow-hidden 
                                                        float-left mt-1 position-relative product-qty">
                                                                        <div class="col-12">
                                                                            <span>Quantity : </span>
                                                                            <input type="text" class="border-0 fs-5 fw-bold text-start" style="outline: none;" pattern="[1-9]" value="1" onkeyup='check_value(<?php echo $product_data["qty"]; ?>);' id="qty_input" />

                                                                            <div class="position-absolute qty-buttons">
                                                                                <div class="justify-content-center d-flex flex-column align-items-center 
                                                                                border border-1 border-secondary qty-inc">
                                                                                    <i class="bi bi-caret-up-fill text-primary fs-5" onclick='qty_inc(<?php echo $product_data["qty"]; ?>);'></i>
                                                                                </div>
                                                                                <div class="justify-content-center d-flex flex-column align-items-center 
                                                                                border border-1 border-secondary qty-dec">
                                                                                    <i class="bi bi-caret-down-fill text-primary fs-5" onclick='qty_dec();'></i>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-12 mt-5">
                                                                            <div class="row">
                                                                                <div class="col-4 d-grid">
                                                                                <button class="btn btn-success" type="submit" id="payhere-payment" 
                                                                                    onclick="paynow(<?php echo $pid; ?>);">Pay Now</button>
                                                                                
                                                                                </div>
                                                                                <div class="col-4 d-grid">
                                                                                    <button class="btn btn-primary">Add To Cart</button>
                                                                                </div>
                                                                                <div class="col-4 d-grid">
                                                                                    <button class="btn btn-secondary">
                                                                                        <i class="bi bi-heart-fill fs-4 text-danger"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row d-block me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold">Related Items</span>
                                    </div>
                                </div>
                            </div>









                            <div class="col-12 bg-white">
                                <div class="row justify-content-center g-2">




                                    <?php

                                    $related_rs = Database::search("SELECT * FROM `product` WHERE
                                        `model_has_brand_id`='" . $product_data["model_has_brand_id"] . "' LIMIT 4 ");
                                    $related_num = $related_rs->num_rows;

                                    for ($w = 0; $w < $related_num; $w++) {
                                        $related_data = $related_rs->fetch_assoc();
                                        $related_img_rs = database::search("SELECT * FROM `product_img` WHERE `Product_id`='" . $related_data["id"] . "' ");
                                        $related_img_num = $related_img_rs->num_rows;

                                        for ($x = 0; $x < $related_img_num; $x++) {
                                            $related_img_data = $related_img_rs->fetch_assoc();
                                        }
                                      


                                    ?>
                                        


                                    <?php
                                    }

                                    ?>

                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row d-block me-0 mt-4 mb-3 border-bottom border-1 border-dark border-start border-end border-top bg-warning-subtle">
                                            <div class="col-12">
                                                <span class="fs-4 fw-bold">Product Details</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row d-block me-0 mt-4 mb-3 border-bottom border-end border-1 border-start border-dark border-top bg-warning-subtle">
                                            <div class="col-12">
                                                <span class="fs-4 fw-bold">Feedbacks</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 col-lg-6 bg-white">
                                <div class="row">

                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label fs-4 fw-bold">Brand : </label>
                                            </div>
                                            <div class="col-9">
                                                <label class="form-label fs-4">Apple</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label fs-4 fw-bold">Model : </label>
                                            </div>
                                            <div class="col-9">
                                                <label class="form-label fs-4">iPhone 12</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fs-4 fw-bold">Description : </label>
                                            </div>
                                            <div class="col-12">
                                                <textarea cols="60" rows="10" class="form-control" readonly></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="row border border-1 border-dark rounded overflow-scroll me-0" style="height: 330px;">

                                    <div class="col-12 mt-1 mb-1 mx-1">
                                        <div class="row border border-1 border-dark rounded me-0">

                                            <div class="col-10 mt-1 mb-1 ms-0">John Doe</div>
                                            <div class="col-2 mt-1 mb-1 me-0">

                                                <span class="badge bg-success">Positive</span>
                                            </div>

                                            <div class="col-12">
                                                <b>
                                                    Perfect
                                                </b>
                                            </div>
                                            <div class="offset-6 col-6 text-end">
                                                <label class="form-label fs-6 text-black-50">2023.09.13</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row d-block me-0 mt-4 mb-3 border-bottom border-end border-1 border-start border-dark border-top bg-warning-subtle">
                                    <div class="col-12">
                                        <span class="fs-4 fw-bold">Feedbacks</span>
                                    </div>
                                </div>

                                <div class="container">
                                    <div class="commentbox">
                                       
                                        <div><span id="comment">0</span> Comments</div>
                                        <div class="comment_box_text">
                                            <p>We are happy to hear your thoughts..</p>
                                        </div>
                                        <div class="comments"></div>
                                        <div class="commentbox">
                                            <img src="resources/userblankprofile.svg" alt="">
                                            <div class="content_cb">
                                                <h2>Comment as:</h2>
                                                <input type="text" value="Anonymous" class="user_cb">

                                                <div class="commentinput">
                                                    <input type="text" placeholder="Enter comment" class="usercomment">
                                                    <div class="buttons">
                                                        <button type="submit" disabled id="publish">Send</button>
                                                    </div>
                                                </div>




                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>


                </div>
            </div>
            <?php include "footer.php"; ?>

            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
           

        </body>

        </html>

    <?php

    } else {
    ?> <script>
            alert("Something went wrong");
        </script> <?php
                }
            }


                    ?>
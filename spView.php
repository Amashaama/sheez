<?php
session_start();
require "connection.php";

if (isset($_GET["id"])) {
    $pid = $_GET["id"];

    $user = $_SESSION["u"];
    $email = $_SESSION["u"]["email"];

    $pageno;


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

            <style>
                .image-zoom-container {
                    position: relative;
                    overflow: hidden;
                    display: inline-block;
                }

                .image-zoom-container img {
                    display: block;
                    width: 100%;
                    height: auto;
                }

                .image-zoom-container::before {
                    content: "";
                    display: block;
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-image: var(--image-url);
                    background-size: 300%;
                    background-repeat: no-repeat;
                    background-position: var(--zoom-x) var(--zoom-y);
                    transition: opacity 0.3s;
                    opacity: 0;
                    cursor: pointer;
                }

                .image-zoom-container:hover::before {
                    opacity: 1;
                }
            </style>

        </head>
        <?php
        include "header.php";
        ?>


        <body>


            <div class="container-fluid">


                <div class="row">


                    <div class="col-12 mt-0  singleProduct">
                        <div class="row">
                            <div class="col-12" style="padding: 20px;">
                                <div class="row">

                                    <div class="col-12 col-lg-6 order-2 order-lg-1">

                                        <div class="row ">

                                            <?php
                                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `Product_id`='" . $pid . "'");
                                            $img_num = $img_rs->num_rows;
                                            $img_list = array();

                                            if ($img_num != 0) {
                                                for ($x = 0; $x < $img_num; $x++) {
                                                    $img_data = $img_rs->fetch_assoc();
                                                    $img_list[$x] = $img_data["img_path"];
                                            ?>
                                                    <li class="col-6 col-lg-6 d-flex flex-column justify-content-center align-items-center
                                                     border border-1 border-black mb-1">
                                                        <div class="image-zoom-container" id="imageZoomContainer<?php echo $x; ?>">

                                                            <img src="<?php echo $img_list[$x]; ?>" id="product_img<?php echo $x; ?>" onclick="changeMainImg(<?php echo $x; ?>);" class="img-thumbnail mt-1 mb-1" />
                                                        </div>
                                                    </li>


                                                <?php

                                                }
                                            } else {
                                                ?>
                                                <li class="col-lg-6 d-flex flex-column justify-content-center align-items-center
                                             border border-1 border-black mb-1">

                                                    <img src="resources/empty2.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                                <li class="col-lg-6 d-flex flex-column justify-content-center align-items-center
                                             border border-1 border-black mb-1">

                                                    <img src="resources/empty2.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                                <li class="col-lg-6 d-flex flex-column justify-content-center align-items-center
                                             border border-1 border-black mb-1">

                                                    <img src="resources/empty2.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                                <li class="col-lg-6 d-flex flex-column justify-content-center align-items-center
                                             border border-1 border-black mb-1">

                                                    <img src="resources/empty2.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>




                                            <?php

                                            }
                                            ?>
                                        </div>




                                    </div>


                            

                                    <div class="col-12 col-lg-6 order-3 ">
                                        <div class="row">
                                            <div class="col-11 offset-1">

                                                <div class="row ">
                                                    <nav aria-label="breadcrumb">
                                                        <ol class="breadcrumb">
                                                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                                            <li class="breadcrumb-item active" aria-current="page">Single Product View</li>
                                                        </ol>
                                                    </nav>
                                                </div>

                                                <div class="row ">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-2 fw-bold text-white"><?php echo $product_data["title"]; ?></span>
                                                    </div>
                                                </div>





                                                <?php

                                                $price = $product_data["price"];
                                                $add = ($price / 100) * 10;
                                                $new_price = $price + $add;
                                                $diff = $new_price - $price;
                                                $percent = ($diff / $price) * 100;

                                                ?>

                                                <div class="row ">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-4 text-light fw-bold">LKR <?php echo $price; ?> .00</span>
                                                        &nbsp;&nbsp;

                                                    </div>
                                                </div>

                                                <div class="row ">
                                                    <div class="col-12 my-2">

                                                        <span class="fs-9 text-white">Return Policy : No returns</span><br />
                                                        <span class="fs-9 text-white">Availability : <?php echo $product_data["qty"]; ?> Items Left</span>
                                                    </div>
                                                </div>

                                                <div class="row ">
                                                    <div class="col-12 my-2">

                                                        <?php
                                                        $user_rs = Database::search("SELECT * FROM `user` WHERE 
                                                                `email`='" . $product_data["user_email"] . "'");
                                                        $user_data = $user_rs->fetch_assoc();
                                                        ?>
                                                        <span class="fs-8 text-white">Seller : <?php echo $user_data["fname"]; ?></span>

                                                    </div>
                                                </div>

                                                <!--start size selector
                                                <?php

                                                $size_rs = Database::search("SELECT * FROM `product_has_size`
                                                 WHERE `product_id`='" . $pid . "' ");
                                                $size_num = $size_rs->num_rows;

                                                if ($size_num == 0) {

                                                ?>
                                                <?php

                                                } else {
                                                    ?>
                                                    <div class="row  ">
                                                    <div class="col-12 col-lg-6  ">
                                                        <select class="form-select text-center" id="size_id">
                                                            <option value="0">Select Size</option>
                                                            <?php
                                                            for($v=0; $v<$size_num;$v++){
                                                                $size_data= $size_rs->fetch_assoc();
                                                                $size_id=$size_data["size_id"];

                                                                $size_name_rs= Database::search("SELECT * FROM `size` WHERE `id`='".$size_id."'  ");

                                                                $size_name_num= $size_name_rs->num_rows;
                                                                for($p=0; $p<$size_name_num;$p++){
                                                                    $size_name_data= $size_name_rs->fetch_assoc();
                                                                    ?>
                                                                      <option value="<?php echo $size_name_data["id"]; ?>"><?php echo $size_name_data["size"]; ?></option>


                                                                    <?php
                                                                }
                                                                ?>

                                                                
                                                                <?php

                                                            }
                                                             ?>

                                                        </select>



                                                    </div>
                                                </div>
                                                    
                                                    <?php
                                                }

                                                ?>

                                                

                                                end size selector-->


                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="my-2 col-12 col-lg-12 border border-2 border-white rounded">
                                                                <div class="row">
                                                                    <span><?php echo $product_data["description"] ?></span>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-12 ">
                                                        <div class="row">

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
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                <div class="row">
                                                    <div class="col-12 mt-5">
                                                        <div class="row">
                                                            <div class="col-4 d-grid">
                                                                <button class="btn btn-success" type="submit" id="payhere-payment" onclick="paynow(<?php echo $pid; ?>);">Pay Now</button>

                                                            </div>
                                                            <div class="col-4 d-grid">
                                                                <button class="btn btn-primary" onclick="addToCart(<?php echo $product_data['id']; ?>)">Add To Cart</button>
                                                            </div>
                                                            <div class="col-4 d-grid">
                                                                <button class="btn btn-outline-secondary" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);">
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





                <div class="col-12 fb" style="background-color: #7A7474;">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">

                                <div class="col-12">
                                    <div class="row d-block me-0 mt-4 mb-3 border-bottom border-end border-1 border-start border-dark border-top bg-dark">
                                        <div class="col-12">
                                            <span class="fs-4 fw-bold">Feedbacks</span>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>


                        <div class="col-12">
                            <div class="row">

                                <div class="col-12 col-lg-12">
                                    <div class="row border border-1 border-white rounded overflow-scroll me-0" style="height: 530px;">


                                        <?php

                                        $feedback_rs = Database::search("SELECT * FROM `feedback` INNER JOIN `user` ON 
                                        user.email=feedback.user_email WHERE `product_id`='" . $pid . "' ");
                                        $feedback_num = $feedback_rs->num_rows;


                                        for ($z = 0; $z < $feedback_num; $z++) {

                                            $feedback_data = $feedback_rs->fetch_assoc();

                                        ?>
                                            <div class="col-12 mt-1 mb-1 mx-1">

                                                <?php
                                                if ($feedback_data["type"] == 1) {
                                                ?>
                                                    <div class="row border border-2 border-success rounded me-0">
                                                    <?php
                                                } else if ($feedback_data["type"] == 2) {
                                                    ?>

                                                        <div class="row border border-2 border-warning rounded me-0">

                                                        <?php
                                                    } else if ($feedback_data["type"] == 3) {
                                                        ?>

                                                            <div class="row border border-2 border-danger rounded me-0">

                                                            <?php
                                                        } else {
                                                            ?>
                                                                <div class="row border border-1 border-white rounded me-0">

                                                                <?php
                                                            }



                                                                ?>



                                                                <div class="col-10 mt-1 mb-1 ms-0"><?php echo $feedback_data["fname"] . " " . $feedback_data["lname"]; ?></div>
                                                                <div class="col-2 mt-1 mb-1 me-0 text-end">
                                                                    <?php
                                                                    if ($feedback_data["type"] == 1) {
                                                                    ?>
                                                                        <span class="badge bg-success">Positive</span>

                                                                    <?php
                                                                    } else if ($feedback_data["type"] == 2) {
                                                                    ?>
                                                                        <span class="badge bg-warning">Neutral</span>

                                                                    <?php
                                                                    } else if ($feedback_data["type"] == 3) {
                                                                    ?>
                                                                        <span class="badge bg-danger">Negative</span>

                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>



                                                                <div class="col-12 mb-2">
                                                                    <b>
                                                                        <?php echo $feedback_data["feedback"]  ?>
                                                                    </b>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class=" col-12 col-lg-6 ">
                                                                        <div class="row">

                                                                            <?php

                                                                            $fimg_rs = Database::search("SELECT * FROM `feedback_img` WHERE `feedback_id`='" . $feedback_data["id"] . "' ");

                                                                            $fimg_num = $fimg_rs->num_rows;




                                                                            for ($f = 0; $f < $fimg_num; $f++) {
                                                                                $fimg_data = $fimg_rs->fetch_assoc();
                                                                                $img_list[$f] = $fimg_data["feedback_img_path"];
                                                                            ?>

                                                                                <div class=" col-4 border border-dark rounded ">
                                                                                    <img src="<?php echo $img_list[$f]; ?>" class="img-fluid object-fit-contain" style="width: 140px; height:150px; " onclick="openModal('<?php echo $img_list[$f]; ?>')" />
                                                                                </div>

                                                                            <?php
                                                                            }

                                                                            ?>


                                                                        </div>
                                                                    </div>
                                                                </div>



                                                                <div class="offset-6 col-6 text-end">
                                                                    <label class="form-label fs-6 text-white-50"><?php echo $feedback_data["date"]  ?></label>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                    }
                                                        ?>




                                                        </div>
                                                    </div>
                                                    <?php



                                                    ?>



                                            </div>
                                    </div>
                                </div>

                                <!-- popup image feedback Modal -->
                                <div id="myModal" class="modal">
                                    <span class="close " onclick="closeModal()" style="color:red;">&times;</span>
                                    <img class="modal-content" id="modalImage">
                                </div>
                                <!-- popup image feedback Modal -->
                            </div>


                        </div>
                    </div>


                </div>


                <div class="col-12" style="background-color: 9C9393;">

                    <div class="row">
                        <div class="col-12">
                            <div class="row">

                                <div class="col-6">
                                    <div class="row d-block me-0 mt-4 mb-3 border-bottom border-end border-1 border-start border-dark-subtle border-top bg-dark">
                                        <div class="col-12">
                                            <span class="fs-4 fw-bold">Questions answerd by seller</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="row d-block me-0 mt-4 mb-3 border-bottom border-end border-1 border-start border-dark-subtle border-top bg-dark">
                                        <div class="col-12">
                                            <span class="fs-4 fw-bold">Ask</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-12 col-lg-6">
                            <div class="row border border-1  border-white rounded overflow-scroll me-0" style="height: 330px;">

                                <?php

                                $qna_rs = Database::search("SELECT * FROM `qna` INNER JOIN `user` ON 
                                user.email=qna.user_email WHERE `product_id`='" . $pid . "' ");
                                $qna_num = $qna_rs->num_rows;




                                for ($q = 0; $q < $qna_num; $q++) {
                                    $qna_data = $qna_rs->fetch_assoc();
                                    $answer = $qna_data["answer"];

                                    if (!empty($answer)) {



                                ?>

                                        <div class="col-12 mt-1 mb-1 mx-1">
                                            <div class="row border border-1 border-success rounded me-0">
                                                <div class="col-2 mt-1 mb-1 me-0">

                                                    <span class="badge bg-success ">Question</span>
                                                </div>

                                                <div class="col-10 mt-1 mb-1 ms-0 text-end"><?php echo $qna_data["fname"] . " " . $qna_data["lname"]; ?></div>


                                                <div class="col-12 mt-1 ">
                                                    <b>
                                                        <?php echo $qna_data["question"]  ?>
                                                    </b>
                                                </div>
                                                <div class="offset-6 col-6 text-end">
                                                    <label class="form-label fs-6 text-white-50"><?php echo $qna_data["date"]  ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-10 mt-1 mb-1 mx-1 ">
                                                <div class="row border border-1 border-danger rounded me-0 ">
                                                    <div class=" col-12">
                                                        <div class="col-2 mt-1 mb-1 me-0">

                                                            <span class="badge bg-danger">Answer</span>
                                                        </div>

                                                        <div class="col-10 mt-1 mb-1 ms-0 text-end"></div>


                                                        <div class="col-12 mt-1">
                                                            <b>
                                                                <?php echo $qna_data["answer"]  ?>
                                                            </b>
                                                        </div>
                                                        <div class="offset-6 col-6 text-end">
                                                            <label class="form-label fs-6 text-white-50"><?php echo $qna_data["date"]  ?></label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <hr />






                                <?php
                                    }
                                }


                                ?>

                            </div>
                        </div>




                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <form>


                                    <label for="" class="form-label">Type here</label>
                                    <textarea class="form-control border-4" id="getQuestion" rows="7"></textarea>
                                    <button class="btn btn-danger mt-2" type="submit" onclick="submitQuestion(<?php echo $pid; ?>);">Ready to Go</button>



                                </form>
                            </div>

                        </div>
                    </div>
                </div>




                <div class="col-12" style="background-color:  #7A7474;">
                    <div class="row d-block me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                        <div class="col-12">
                            <span class="fs-3 fw-bold">Related Items</span>
                        </div>
                    </div>

                    <div class="row ">




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
                            <div class="col-12 col-lg-4 mb-2">
                                <div class="card" style="width: 18rem;">
                                    <img src="<?php echo $related_img_data["img_path"]; ?>" class="card-img-top" />
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $related_data["title"]; ?></h5>
                                        <p class="card-text">LKR <?php echo $related_data["price"]; ?> .00</p>
                                        <a href="#" class="btn btn-primary">Wanna Buy ?</a>
                                    </div>
                                </div>
                            </div>


                        <?php
                        }

                        ?>
                    </div>
                </div>




























            </div>


            <?php include "footer.php"; ?>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const zoomContainers = document.querySelectorAll('.image-zoom-container');

                    zoomContainers.forEach(container => {
                        const img = container.querySelector('img');
                        container.style.setProperty('--image-url', `url(${img.src})`);

                        container.addEventListener('mousemove', function(e) {
                            const rect = container.getBoundingClientRect(); // size n position of container
                            // relative to viewport
                            const x = e.clientX - rect.left; // X position within the element
                            // (mouse position relative to viewport -containers left edge position relative to viewport)
                            const y = e.clientY - rect.top; // Y position within the element

                            const xPercent = (x / rect.width) * 100;
                            const yPercent = (y / rect.height) * 100;

                            container.style.setProperty('--zoom-x', `${xPercent}%`);
                            container.style.setProperty('--zoom-y', `${yPercent}%`);
                        });
                    });
                });
            </script>

            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>


        </body>

        </html>

<?php

    }
}



?>
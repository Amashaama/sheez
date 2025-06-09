<?php
session_start();

require "connection.php";

if (isset($_SESSION["u"])) {


    $user = $_SESSION["u"]["email"];

    $total = 0;
    $subtotal = 0;
    $shipping = 0;
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cart | sheez</title>

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





        <div class="col-12 pt-2" style="background-color: #E3E5E4;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home5.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
                </ol>
            </nav>
        </div>

        <div class="col-12 border border-1 border-success rounded mb-3">
            <div class="row">

                <div class="col-12">
                    <label class="form-label fs-1 fw-bold">Cart <i class="bi bi-cart4 fs-1 text-success"></i></label>
                </div>

                <div class="col-12 col-lg-6">
                    <hr />
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="offset-lg-2 col-12 col-lg-6 mb-3">
                            <input type="text" class="form-control" placeholder="Search in Cart..." />
                        </div>
                        <div class="col-12 col-lg-2 mb-3 d-grid">
                            <button class="btn btn-outline-success">Search</button>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <hr />
                </div>

                <?php

                $cart_rs = Database::search("SELECT * FROM `cart` WHERE user_email='" . $user . "'  ");
                $cart_num = $cart_rs->num_rows;

                if ($cart_num == 0) {
                ?>
                    <!-- Empty View -->
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 emptyCart"></div>
                            <div class="col-12 text-center mb-2">
                                <label class="form-label fs-1 fw-bold">
                                    You have no items in your Cart yet.
                                </label>
                            </div>
                            <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                                <a href="home5.php" class="btn btn-danger fs-3 fw-bold">
                                    Start Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Empty View -->


                    <?php

                } else {


                    for ($x = 0; $x < $cart_num; $x++) {
                        $cart_data = $cart_rs->fetch_assoc();

                        $saved_qty_rs= Database::search("SELECT `qty` FROM `cart` WHERE `user_email`='" . $user . "'
                        AND `product_id`='".$cart_data["product_id"]."' ");
                        $saved_qty_num= $saved_qty_rs->num_rows;

                        $saved_qty_data= $saved_qty_rs->fetch_assoc();
                        $saved_qty_qty= $saved_qty_data["qty"];
                                                    



                        $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `user` ON 
                                user.email= product.user_email INNER JOIN `product_img` ON product_img.Product_id=
                                product.id INNER JOIN `color` ON product.color_clr_id
                                =color.clr_id INNER JOIN `condition` ON product.condition_condition_id
                                =condition.condition_id  WHERE `id`='" . $cart_data["product_id"] . "' ");

                        $product_data = $product_rs->fetch_assoc();
                        $total = $total + ($product_data["price"]);



                        $address_rs = Database::search("SELECT `district_district_id` AS `did` FROM `city` WHERE `city_id`IN
                            (SELECT `city_city_id` FROM `user_has_address` WHERE 
                            `user_email`='" . $_SESSION["u"]["email"] . "')");

                        $address_data = $address_rs->fetch_assoc();

                        $ship = 0;

                        if ($address_data["did"] == 1) {
                            $ship = $product_data["delivery_fee_colombo"];
                            $shipping = $shipping + $product_data["delivery_fee_colombo"];
                        } else {
                            $ship = $product_data["delivery_fee_other"];
                            $shipping = $shipping + $product_data["delivery_fee_other"];
                        }

                        $final_total = $total + $shipping;

                    ?>

                        <div class="col-12 col-lg-9">
                            <div class="row">

                                <div class="card mb-3 mx-0 col-12">
                                    <div class="row g-0">
                                        <div class="col-md-12 mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                                                    <span class="fw-bold text-black fs-5"><?php echo $product_data["fname"] ?> <?php echo $product_data["lname"] ?></span>&nbsp;
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <!-- popup -->
                                        <div class="col-md-4">

                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="good" title="Product Description">
                                                <img src="<?php echo $product_data["img_path"] ?>" class="img-fluid rounded-start" style="max-width: 200px;">
                                            </span>

                                        </div>
                                        <!-- popup -->
                                        <div class="col-md-5">
                                            <div class="card-body">

                                                <h3 class="card-title"><?php echo $product_data["title"] ?></h3>
                                                <span class="fw-bold text-black-50" id="pid">pid : <?php echo $product_data["id"] ?></span> &nbsp; |


                                                <span class="fw-bold text-black-50">Colour : <?php echo $product_data["clr_name"] ?></span> &nbsp; |

                                                &nbsp; <span class="fw-bold text-black-50">Condition : <?php echo $product_data["condition_name"] ?></span>
                                                <br>
                                                <span class="fw-bold text-black-50 fs-5">Price :</span>&nbsp;
                                                <span class="fw-bold text-black fs-5">Rs. <?php echo $product_data["price"] ?>.00</span>
                                                <br>

                                                <div class="col-12">
                                                   
                                                    <span>Quantity : </span>
                                                    <input type="text" class="border-0 fs-5 fw-bold text-start" style="outline: none;" pattern="[1-9]" value="1" onkeyup='check_value(<?php echo $product_data["qty"]; ?>);' id="qty_input" />
                                                </div>

                                                <br><br>
                                                <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;
                                                <span class="fw-bold text-black fs-5">rs. <?php echo $shipping ?>.00</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card-body d-grid">
                                                <?php
                                                $pid = $product_data["id"];

                                                ?>
                                                <button class="btn btn-success mb-2" type="submit" id="payhere-payment" onclick="paynow(<?php echo $pid; ?>);">Pay Now</button>

                                                <a class="btn btn-outline-danger mb-2" onclick="deleteFromCart(<?php echo $cart_data['cart_id']; ?>);">Remove</a>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="col-md-12 mt-3 mb-3">
                                            <div class="row">
                                                <div class="col-6 col-md-6">
                                                    <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                                </div>
                                                <div class="col-6 col-md-6 text-end">
                                                    <span class="fw-bold fs-5 text-black-50">Rs. <?php echo $total ?> .00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- products -->


                        <!-- summary -->
                        <div class="col-12 col-lg-3">
                            <div class="row">

                                <div class="col-12">
                                    <label class="form-label fs-3 fw-bold">Summary</label>
                                </div>

                                <div class="col-12">
                                    <hr />
                                </div>

                                <div class="col-6 mb-3">
                                    <span class="fs-6 fw-bold" id="qty_input">total</span>

                                </div>

                                <div class="col-6 text-end mb-3">
                                    <span class="fs-6 fw-bold">Rs. <?php echo $total; ?> .00</span>
                                </div>

                                <div class="col-6">
                                    <span class="fs-6 fw-bold">Shipping</span>
                                </div>

                                <div class="col-6 text-end">
                                    <span class="fs-6 fw-bold">Rs. <?php echo $shipping; ?> .00</span>
                                </div>

                                <div class="col-12 mt-3">
                                    <hr />
                                </div>

                                <div class="col-6 mt-2">
                                    <span class="fs-4 fw-bold">Total</span>
                                </div>

                                <div class="col-6 mt-2 text-end">
                                    <span class="fs-4 fw-bold">Rs. <?php echo $final_total ?> .00</span>
                                </div>

                                <div class="col-12 mt-3 mb-3 d-grid">
                                    <button class="btn btn-success" type="submit" id="payhere-payment" onclick="paynow(<?php echo $product_data['id']; ?>);">Pay Now</button>
                                </div>

                            </div>
                        </div>
                        <!-- summary -->


                <?php
                    }
                }

                ?>










            </div>
        </div>



    </div>

    
    <?php include "footer.php"; ?>







    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
</body>


</html>
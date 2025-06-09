<?php


session_start();

require "connection.php";

if (isset($_SESSION["u"])) {


    $umail = $_SESSION["u"]["email"];
    $oid = $_GET["id"];



?>


    <!DOCTYPE html>
    <html html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Invoice | eShop</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resourses/logo.svg" />
    </head>

    <body class="mt-2 " style="background-color: #f7f7ff;">

        <div class="container-fluid">
            <div class="row">


                <div class="col-12">
                    <hr />
                </div>

                <div class="col-12 btn-toolbar justify-content-end">
                    <button class="btn btn-outline-dark me-2"><i class="bi bi-printer-fill" onclick="printInvoice();" ></i> Print</button>
                    <button class="btn btn-outline-danger me-2"><i class="bi bi-filetype-pdf"></i> Export as PDF</button>
                  
                    <a href="home5.php"   class="btn btn-success">Back to Home</a>
                </div>

                <div class="col-12">
                    <hr />
                </div>

                <div class="col-12" id="page">
                    <div class="row">

                        <div class="col-6">
                            <div class="ms-4 invoiceHeaderImage">
                                <img src="resources/logo/1.svg" style="width:80px; height:85px;">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="row">
                               
                                <div class="col-12 text-success text-decoration-underline text-end">
                                    <h2>sheez</h2>
                                </div>
                                <div class="col-12 fw-bold text-end">
                                    <span>Gampola, Kandy, Sri Lanka.</span><br />
                                    <span>+94112 565745</span><br />
                                    <span>sheez@gmail.com</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="border border-1 border-primary" />
                        </div>

                        <div class="col-12 mb-4">
                            <div class="row">

                                <?php

                                $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "'");
                                $address_data = $address_rs->fetch_assoc();

                                ?>


                                <div class="col-6">
                                    <h5 class="fw-bold">INVOICE TO :</h5>
                                    <h2><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></h2>
                                    <span>Horana Colombo</span><br />
                                    <span>johndoe@gmail.com</span>
                                </div>

                                <?php

                                $invoice_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `product` ON product.id =invoice.product_id WHERE `order_id`='" . $oid . "' ");
                                $invoice_data = $invoice_rs->fetch_assoc();

                                ?>

                                <div class="col-6 text-end mt-4">
                                    <h1 class="text-primary">Invoice <?php echo $invoice_data["order_id"]; ?></h1>
                                    <span class="fw-bold">Data & Time of Invoice : </span>&nbsp;
                                    <span class="fw-bold"><?php echo $invoice_data["date"]; ?></span>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr class="border border-1 border-secondary">
                                        <th>#</th>
                                        <th>Order ID & Product</th>
                                        <th class="text-end">Unit Price</th>
                                        <th class="text-end">Quantity</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="height: 72px;">
                                        <td class="bg-primary text-white fs-3"><?php echo $invoice_data["id"]; ?></td>
                                        <td>
                                            <span class="fw-bold text-primary text-decoration-underline p-2"><?php echo $oid; ?></span><br />
                                            <span class="fw-bold text-primary fs-3 p-2"><?php echo $invoice_data["title"]; ?></span>
                                        </td>
                                        <td class="fw-bold fs-6 text-end pt-3 bg-secondary text-white">Rs. <?php echo $invoice_data["price"]; ?>.00</td>
                                        <td class="fw-bold fs-6 text-end pt-3"><?php echo $invoice_data["qty"]; ?></td>
                                        <td class="fw-bold fs-6 text-end pt-3 bg-secondary text-white">Rs. <?php echo $invoice_data["total"] ?> .00</td>
                                    </tr>
                                </tbody>
                                <tfoot>

                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold">SUBTOTAL</td>
                                        <td class="text-end">Rs. <?php echo $invoice_data["total"] ?> .00</td>
                                    </tr>
                                    <tr>
                                        <?php

                                        $city_rs = Database::search("SELECT * FROM `city` WHERE city_id='" . $address_data["city_city_id"] . "' ");
                                        $city_data = $city_rs->fetch_assoc();

                                        $delivery = 0;
                                        if ($city_data["district_district_id"] == 1) {
                                            $delivery = $invoice_data["delivery_fee_colombo"];
                                        } else {
                                            $delivery = $invoice_data["delivery_fee_other"];
                                        }

                                        $t = $invoice_data["total"];

                                        $gt = $t + $delivery;




                                        ?>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold border-primary">Delivery Fee</td>
                                        <td class="text-end border-primary">Rs. <?php echo  $delivery ?> .00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-4 text-end fw-bold border-primary text-danger">Final Price</td>
                                        <td class="fs-5 text-end fw-bold border-primary text-primary">Rs. <?php echo $gt ?> .00</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="col-4 text-start">
                            <span class="fs-3 text-success">Thank You for shopping with us !</span>
                        </div>

                        <div class="col-12 mt-3 mb-3 border-0 border-start border-5 border-primary rounded" style="background-color: #e7f2ff;">
                            <div class="row">
                                <div class="col-12 mt-3 mb-3">
                                    <label class="form-label fs-5 fw-bold">Important : </label>
                                    <br />
                                    <label class="form-label fs-6">Unfortunately we decided to not accept return requests for few months.</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="border border-1 border-primary" />
                        </div>

                        <div class="col-12 text-center mb-3">
                            <label class="form-label fs-5 text-black-50 fw-bold">
                                Invoice was created on a computer and is valid without the Signature and Seal.
                            </label>
                        </div>

                    </div>
                </div>

                <?php include "footer.php"; ?>
            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>
<?php
}
?>
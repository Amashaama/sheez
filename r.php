<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $mail = $_SESSION["u"]["email"];


?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Review Section</title>


        <link href="style.css" rel="stylesheet">
        <link rel="stylesheet" href="bootstrap.css">
        <!-- CsS -->
        <style>
            body {
                background-color: #f8f9fa;
            }

            .tab-content {
                margin-top: 20px;
                padding: 20px;
                background-color: #fff;
                border: 1px solid #dee2e6;
                border-top: none;
                border-radius: 0 0 0.25rem 0.25rem;
            }

            .nav-tabs .nav-link.active {
                background-color: #fff;
                border-color: #dee2e6 #dee2e6 #fff;
            }


            .no-review-content {
                text-align: center;
                padding: 50px 0;
            }

            .no-review-content img {
                width: 100px;
                margin-bottom: 20px;
            }
        </style>
    </head>
    
  
    <body class="container-fluid" style="background-image: url(resources/r1\ \(1\).png);">
    <?php
    include "header.php";
    ?>
    
        <div class=" mt-3 mb-3">
       

            <div class=" row justify-content-center border-1 border-white">
                <div class="col-12 col-lg-12 mt-3 ">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active text-dark fw-bold" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Purchased History</button>
                        </li>
                       
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <?php
                            $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $mail . "' ");
                            $invoice_num = $invoice_rs->num_rows;



                            if ($invoice_num == 0) {
                            ?>
                                <div class="no-review-content">
                                    <img src="resources/empty2.svg" alt="No items">
                                    <p>There's no item to review</p>
                                    <a href="home5.php" class="btn btn-warning">Back to Homepage</a>
                                </div>

                            <?php




                            } else {
                            ?>
                            <div class="col-12 d-flex justify-content-center">
                               <a href="home5.php" class="btn btn-outline-success rounded border border-1 border-success fs-5">Back to home</a>
                            </div>

                                <div class="col-12 recent-orders-table mt-3">

                                    <table class="table table-success table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Invoice No</th>
                                                <th>Date</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <?php

                                        for ($x = 0; $x < $invoice_num; $x++) {
                                            $invoice_data = $invoice_rs->fetch_assoc();
                                            $pid = $invoice_data["product_id"];
                                            $inid = $invoice_data["id"];


                                            $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_img` ON 
                                            product_img.Product_id= product.id WHERE product.id='" . $pid . "' ");

                                            $product_data = $product_rs->fetch_assoc();




                                        ?>

                                            <tbody id="tbd">

                                                <tr>
                                                    <td><img src="<?php echo $product_data["img_path"]; ?>" width="100" height="150"></td>
                                                    <td><?php echo $product_data["title"]  ?></td>
                                                    <td><?php echo $invoice_data["total"]  ?></td>
                                                    <td><?php echo $invoice_data["qty"]  ?></td>
                                                    <td><?php echo $invoice_data["id"]  ?></td>
                                                    <td class="text-danger"><?php echo $invoice_data["date"] ?></td>

                                                    <td>


                                                        <div class="row">

                                                            <?php

                                                            $cut_rs = Database::search("SELECT * FROM `feedback` WHERE invoice_id='" . $inid . "' ");
                                                            $cut_num = $cut_rs->num_rows;

                                                            if ($cut_num < 1) {

                                                            ?>



                                                                <div class="col-6 d-grid">
                                                                    <a href="feedbackForm.php?inid=<?php echo $invoice_data['id']; ?>" class="btn btn-secondary rounded border border-1 border-primary mt-5 fs-5" onclick="addFeedback(<?php echo $invoice_data['id']; ?>);">
                                                                        <i class="bi bi-info-circle-fill"></i> Feedback
                                                                    </a>
                                                                </div>
                                                                <div class="col-6 d-grid">
                                                                    <a class="btn btn-danger rounded mt-5 fs-5">
                                                                        <i class="bi bi-trash3-fill"></i> Delete
                                                                    </a>
                                                                </div>


                                                            <?php
                                                            } else {
                                                            ?>
                                                          
                                                                <div class="col-12 d-grid">
                                                                    <a class="btn btn-danger rounded mt-5 fs-5">
                                                                        <i class="bi bi-trash3-fill"></i> Delete
                                                                    </a>
                                                                </div>


                                                            <?php
                                                            }
                                                            ?>


                                                        </div>





                                                    </td>

                                                </tr>







                                            </tbody>
                                        <?php

                                        }
                                        ?>
                                    </table>



                                </div>

















                            <?php
                            }
                            ?>




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
}
?>
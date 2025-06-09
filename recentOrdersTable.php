<?php

session_start();

include "connection.php";

if (isset($_SESSION["a"])) {

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Users Details Table | Admin Panel</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <!-- moreee icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

        <!-- bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

        <link rel="icon" href="resource/logo.svg" />
    </head>

    <body class="container-fluid ">


        <div class="row ">

            <div class="col-12 text-center" style="font-size: 30px;">
                <div class="row d-flex justify-content-center" style="font-size: 30px;">
                    <label class="form-label fs-4 fw-bold text-success m-2">Recent Purchased Orders</label>
                </div>
            </div>



    

            <div class="col-12 table-responsive  recent-orders-table" id="printArea">
                <?php

                $recent_rs = Database::search("SELECT * FROM `recent` INNER JOIN `product` ON product.id=recent.product_id INNER JOIN `user` ON user.email=recent.user_email  INNER JOIN `invoice` ON recent.invoice_id=invoice.id  ");
                $recent_num = $recent_rs->num_rows;






                ?>
                <label class="form-label fs-4 fw-bold text-dark text-center m-2">Recent Orders</label>

                <table class="table table-success table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Product Name</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Price</th>
                            <th scope="col">invoice_id</th>
                            <th scope="col">Date</th>
                            <th scope="col">Customer Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($r = 0; $r < $recent_num; $r++) {
                            $recent_data = $recent_rs->fetch_assoc();
                        ?>


                            <tr>
                                <td><?php echo $recent_data["title"] ?></td>
                                <td><?php echo $recent_data["qty"] ?></td>
                                <td><?php echo $recent_data["price"] ?></td>
                                <td><?php echo $recent_data["invoice_id"] ?></td>
                                <td><?php echo $recent_data["date"] ?></td>
                                <td class="text-danger"><?php echo $recent_data["email"] ?></td>

                            </tr>

                        <?php
                        }


                        ?>



                    </tbody>



                </table>

            </div>

            <div class="col-12">
                    <div class="row d-flex justify-content-center">
                        <a href="adminPanel.php" class="col-2 btn btn-outline-success me-4">Back to Admin Panel</a>

                        <button class=" col-2 btn btn-outline-danger " onclick="printDiv();">Print Report</button>






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
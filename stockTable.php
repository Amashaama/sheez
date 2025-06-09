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


        <div class="row mb-5 ">

            <div class="col-12 text-center" style="font-size: 30px;">
                <div class="row d-flex justify-content-center" style="font-size: 30px;">
                    <label class="form-label fs-4 fw-bold text-dark m-2">Stock Data</label>
                </div>
            </div>


            <div class="col-12">
                <div class="row d-flex justify-content-end mt-3 me-1">
                    <div class=" d-none" id="msgDiv">
                        <div class="alert alert-success" id="msg"></div>
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" placeholder="Product Id" id="pid">
                    </div>
                    <button class=" col-2 btn btn-outline-success" onclick="changeStatusProduct();">Change Status</button>
                </div>
            </div>

            <div class="col-12 table-responsive  recent-orders-table" id="printArea">
                <?php

                $stock_rs = Database::search("SELECT * FROM `product` ");
                $stock_num = $stock_rs->num_rows;


                ?>
                <label class="form-label fs-4 fw-bold text-dark text-center m-2"></label>

                <table class="table table-success table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Product Id</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>

                        </tr>
                    </thead>
                    <tbody class="">
                        <?php
                        for ($s = 0; $s < $stock_num; $s++) {
                            $stock_data = $stock_rs->fetch_assoc();
                        ?>


                            <tr >
                                <td><?php echo $stock_data["id"] ?></td>
                                <td><?php echo $stock_data["title"] ?></td>
                                <td><?php echo $stock_data["qty"] ?></td>
                                <td><?php echo $stock_data["price"] ?></td>
                                <td><?php
                                    if ($stock_data["status_status_id"] == 1) {
                                        echo ("Available");
                                    } else {
                                        echo ("Not Available");
                                    }


                                    ?>
                                </td>


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

                    <button class=" col-2 btn btn-outline-danger " onclick="printDiv()">Print Report</button>






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
<?php
session_start();
if (isset($_SESSION["a"])) {
    require "connection.php";

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User`s Spend Amount | Admin Panel</title>

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
            <div class="col-12 text-center mt-5" style="font-size: 30px;">
                <div class="row d-flex justify-content-center" style="font-size: 30px;">
                    <label class="form-label fs-4 fw-bold text-dark m-2">Customer Spend amount</label>
                </div>
            </div>



            <div class="col-12 table-responsive  recent-orders-table" id="printArea">

                <?php

                $top_customer_rs = Database::search("SELECT `user_email`, SUM(`total`) AS total
                FROM `invoice` GROUP BY `user_email` ORDER BY SUM(`total`) DESC ");

                $top_customer_num = $top_customer_rs->num_rows;



                //  $top_cus_rs= Database::search("SELECT  ")

                ?>
                <label class="form-label fs-4 fw-bold text-dark text-center m-2"></label>

                <table class="table table-success table-hover">
                    <thead>
                        <tr>
                            <th scope="col">User Email</th>
                            <th scope="col">Total Amount Spend</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        for($x=0; $x<$top_customer_num;$x++){

                            $top_customer_data=$top_customer_rs->fetch_assoc();

                        
                      
                        ?>

                            <tr>
                                <td><?php echo $top_customer_data["user_email"] ?></td>
                                <td>LKR. <?php echo $top_customer_data["total"] ?>.00</td>



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
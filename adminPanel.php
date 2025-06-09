<?php

session_start();

include "connection.php";

if (isset($_SESSION["a"])) {

?>

    <!DOCTYPE html>
    <html lang="en" data-bs-theme="light">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Admin Panel | sheez</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <!-- google icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

        <!-- bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

        <link rel="icon" href="resources/logo.svg" />
    </head>

    <body style="background-color: rgb(247, 246, 252); " onload="loadUser();">

        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-lg-2">
                    <div class="row">
                        <div class="col-12 align-items-start " style="background-color:rgb(34,139,34); height:1080px;">
                            <div class="row g-1 ">
                                <div class="col-12 mt-2 text-center">
                                    <img src="resources/logo/1.svg" width="50" height="60">
                                    <hr class="border border-1 border-white" />


                                </div>

                                <div class="col-12 align-content-lg-start">

                                    <ul class="sidebar-list">
                                        <li class="sidebar-list-item">
                                            <a href="#" class=" text-white">
                                                <span class="material-icons-outlined">dashboard</span> Dashboard
                                            </a>
                                        </li>
                                        <li class="sidebar-list-item">
                                            <a href="myProducts.php" class=" text-white">
                                                <span class="material-icons-outlined">inventory_2</span> My Products
                                            </a>
                                        </li>
                                        <li class="sidebar-list-item">
                                            <a href="addProduct.php" class=" text-white">
                                                <span class="material-icons-outlined">add_to_photos</span> Add Products
                                            </a>
                                        </li>
                                        <li class="sidebar-list-item">
                                            <a href="table.php" class=" text-white">
                                                <span class="material-icons-outlined">bar_chart</span> Graph Data
                                            </a>
                                        </li>
                                        <li class="sidebar-list-item">
                                            <a href="productlifeed.php" class=" text-white">
                                                <span class="material-icons-outlined">rate_review</span> Feedback Graph
                                            </a>
                                        </li>
                                        <li class="sidebar-list-item">
                                            <a href="reply.php" class=" text-white">
                                                <span class="material-icons-outlined">email</span> Client Questions
                                            </a>
                                        </li>
                                        <li class="sidebar-list-item">
                                            <a href="homePageAdd.php" class=" text-white">
                                                <span class="material-icons-outlined">home</span> Home Page add
                                            </a>
                                        </li>
                                    </ul>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-lg-10">
                    <div class="row">

                        <div class="text-dark fw-bold mb-1 mt-3">
                            <h2 class="fw-bold">Dashboard</h2>
                        </div>

                        <?php
                        $today = date("Y-m-d");
                        $thismonth = date("m");
                        $thisyear = date("Y");

                        $a = "0";
                        $b = "0";
                        $c = "0";
                        $e = "0";
                        $q = "0";

                        $invoice_rs = Database::search("SELECT * FROM `invoice` ");
                        $invoice_num = $invoice_rs->num_rows;

                        for ($h = 0; $h < $invoice_num; $h++) {
                            $invoice_data = $invoice_rs->fetch_assoc();

                            $q = $q + $invoice_data["qty"];

                            $d = $invoice_data["date"];
                            $splitDate = explode(" ", $d); //split date frm time
                            $pdate = $splitDate[0]; //sold date

                            if ($pdate == $today) {
                                $a = $a + $invoice_data["total"];
                                $c = $c + $invoice_data["qty"];
                            }

                            $splitMonth = explode("-", $pdate); // seperate date into year, month, date
                            $pyear = $splitMonth[0]; // year
                            $pmonth = $splitMonth[1]; //month

                            if ($pyear == $thisyear) {

                                if ($pmonth == $thismonth) {

                                    $b = $b + $invoice_data["total"];
                                    $e = $e + $invoice_data["qty"];
                                }
                            }
                        }

                        // most sold item finding

                        $most_sold_rs = Database::search("SELECT product_id, SUM(qty) 
                        AS total_sold FROM `invoice`
                        GROUP BY `product_id` ORDER BY total_sold DESC LIMIT 1");

                        $most_sold_data = $most_sold_rs->fetch_assoc();

                        $msp_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $most_sold_data["product_id"] . "'  ");
                        $msp_data = $msp_rs->fetch_assoc();

                        // most sold item finding

                        //least sold

                        $least_sold_rs = Database::search("SELECT `product_id`, SUM(`qty`) FROM 
                        `invoice` GROUP BY `product_id` ORDER BY SUM(`qty`) ASC LIMIT 1  ");

                        $least_sold_data = $least_sold_rs->fetch_assoc();

                        $lsp_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $least_sold_data["product_id"] . "'  ");
                        $lsp_data = $lsp_rs->fetch_assoc();




                        ?>

                        <div>
                            <hr />
                        </div>
                        <div class="col-12">
                            <div class="row g-1">
                                <div class="main-cards col-12 col-md-6 col-lg-3 ">

                                    <div class="admin-card" style=" background-color: rgb(230, 14, 14);">
                                        <div class="card-inner">
                                            <h5>Daily Earnings</h5>
                                            <span class="material-icons-outlined">monetization_on</span>
                                        </div>
                                        <h1>Rs. <?php echo $a; ?> .00</h1>
                                    </div>
                                </div>

                                <div class="main-cards col-12 col-md-6 col-lg-3 ">

                                    <div class="admin-card " style=" background-color: rgb(255, 111, 0);">
                                        <div class="card-inner">
                                            <h5>Sold items today</h5>
                                            <span class="material-icons-outlined">inventory</span>
                                        </div>
                                        <h1><?php echo $c; ?> Items </h1>
                                    </div>
                                </div>

                                <div class="main-cards col-12 col-md-6 col-lg-3 " onclick="loadb();">

                                    <div class="admin-card " style=" background-color: rgb(46, 125, 50); cursor:pointer;">
                                        <div class="card-inner">
                                            <h5>Monthly Earnings</h5>
                                            <span class="material-icons-outlined">monetization_on</span>
                                        </div>
                                        <h1>Rs. <?php echo $b; ?> .00</h1>
                                    </div>
                                </div>


                                <div class="main-cards col-12 col-md-6 col-lg-3 " onclick="loada();">
                                    <div class="admin-card " style=" background-color: rgb(29, 38, 154); cursor:pointer;">
                                        <div class="card-inner">
                                            <h5>Sold Items Monthly</h5>
                                            <span class="material-icons-outlined">inventory</span>
                                        </div>
                                        <h1><?php echo $e; ?> Items</h1>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-1">
                                <div class="main-cards col-12 col-md-6 col-lg-3 ">

                                    <div class="admin-card" style=" background-color: #64858E;">
                                        <div class="card-inner">
                                            <h5 class="text-dark fw-bold">Most Sold Product</h5>
                                            <span class="material-icons-outlined">favorite</span>
                                        </div>
                                        <h5><?php echo $most_sold_data["product_id"] ?>. <?php echo $msp_data["title"] ?></h2>
                                    </div>
                                </div>

                                <div class="main-cards col-12 col-md-6 col-lg-3 ">

                                    <div class="admin-card " style=" background-color: #7A568C;">
                                        <div class="card-inner">
                                            <h5 class="text-dark fw-bold">Least Sold Product</h5>
                                            <span class="material-icons-outlined">sentiment_dissatisfied</span>
                                        </div>
                                        <h5><?php echo $least_sold_data["product_id"] ?>. <?php echo $lsp_data["title"] ?> </h5>
                                    </div>
                                </div>



                                <?php

                                $top_customer_rs = Database::search("SELECT `user_email`, SUM(`total`)
                                FROM `invoice` GROUP BY user_email ORDER BY SUM(`total`) DESC LIMIT 1");

                                $top_customer_data = $top_customer_rs->fetch_assoc();

                                //  $top_cus_rs= Database::search("SELECT  ")

                                ?>
                                <div class="main-cards col-12 col-md-6 col-lg-3"  onclick="loadcmS();">
                                    <div class="admin-card " style=" background-color: #39D5AB; cursor:pointer;">
                                        <div class="card-inner">
                                            <h5 class="text-dark fw-bold">Top Customer</h5>
                                            <span class="material-icons-outlined">person</span>
                                        </div>
                                        <h5><?php echo $top_customer_data["user_email"] ?></h5>
                                    </div>
                                </div>

                                <?php 

                                $cusq_rs= Database::search("SELECT COUNT(`question`) AS `qcount`
                                FROM `qna` WHERE `status`=1 ");

                                $cusq_data= $cusq_rs->fetch_assoc();
                                
                                
                                ?>


                                <div class="main-cards col-12 col-md-6 col-lg-3" onclick="loadReplyPageAgain();">
                                    <div class="admin-card " style=" background-color: #CCD539; cursor:pointer;">
                                        <div class="card-inner">
                                            <h5 class="text-dark fw-bold">Customer Questions</h5>
                                            <span class="material-icons-outlined">question_mark</span>
                                            
                                        </div>
                                        <h5><?php echo $cusq_data["qcount"] ?> Left</h5>
                                    </div>
                                </div>


                            </div>








                        </div>

                        <div class="col-12 bg-dark">
                            <div class="row">
                                <div class="col-12 col-lg-2 text-center my-3">
                                    <label class="form-label fs-4 fw-bold text-white">Table Data</label>
                                </div>
                                <div class="col-12 col-lg-10 text-center my-3">

                                    <label class="form-label fs-4 fw-bold text-warning">

                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 table-responsive  recent-orders-table">
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
                                <tbody class="tt">
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
                            <a href="recentOrdersTable.php">Show All</a>
                        </div>
                        <hr />
                        <div class="col-12 table-responsive">


                            <label class="form-label fs-4 fw-bold text-dark text-start m-2">Users</label>

                            <div class="row d-flex justify-content-end mt-3">
                                <div class=" d-none" id="msgDiv">
                                    <div class="alert alert-danger" id="msg"></div>
                                </div>
                                <div class="col-6">
                                    <input type="email" class="form-control" placeholder="User Email" id="user_email">
                                </div>
                                <button class=" col-2 btn btn-outline-success me-3" onclick="changeStatusAdmin();">Change Status</button>
                            </div>




                            <div class="col-12 recent-orders-table mt-3">

                                <table class="table table-success table-hover">
                                    <thead>
                                        <tr>
                                            <th>Profile Picture</th>
                                            <th>User Name</th>
                                            <th>User Email</th>
                                            <th>Gender</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody class="tt" id="tb">

                                    </tbody>



                                </table>
                                <a href="usersTable.php">Show All</a>
                            </div>
                            <hr />

                        </div>

                        <div class="col-12 table-responsive  recent-orders-table">
                            <?php

                            $stock_rs = Database::search("SELECT * FROM `product` ");
                            $stock_num = $stock_rs->num_rows;


                            ?>
                            <label class="form-label fs-4 fw-bold text-dark text-center m-2">Stock</label>

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
                                <tbody class="tt">
                                    <?php
                                    for ($s = 0; $s < $stock_num; $s++) {
                                        $stock_data = $stock_rs->fetch_assoc();
                                    ?>


                                        <tr>
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
                            <a href="stockTable.php">Show All</a>
                        </div>
                        <hr />





                    </div>
                </div>

            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>
<?php




} else {
    //back to login 

    echo ("your are not a valid addmin");
}


?>
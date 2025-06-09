<?php

session_start();
require "connection.php";

if (isset($_SESSION["a"])) {

    $pid = $_GET["id"];

    $pf_rs = Database::search("SELECT `product_id`, `type`,COUNT(*) AS type_count
FROM `feedback` WHERE `product_id`='" . $pid . "' GROUP BY `product_id`,`type`  ");


    $pf_num = $pf_rs->num_rows;

    $dataPoints = array();

    for ($f = 0; $f < $pf_num; $f++) {

        $pf_data = $pf_rs->fetch_assoc();
        if ($pf_data["type"] == 1) {
            $rate = "Positive";
        } else if ($pf_data["type"] == 2) {
            $rate = "Neutral";
        } else if ($pf_data["type"] == 3) {
            $rate = "Negative";
        }

        $type_count = $pf_data["type_count"];

        $dataPoints[] = array("y" => $type_count, "label" => $rate);
    }
        //product details

        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'  ");
        $product_data = $product_rs->fetch_assoc();






?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Feedback Analyze table | Admin</title>

            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
            <link rel="stylesheet" href="style.css" />

            <!-- moreee icons -->
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

            <!-- bootstrap Icons -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

            <link rel="icon" href="resources/logo.svg" />


            <script>
                window.onload = function() {

                    var chart = new CanvasJS.Chart("chartContainer", {
                        animationEnabled: true,
                        title: {

                            text: "Product Feedback Analysis"

                        },
                        axisY: {
                            title: "feedback count",
                            includeZero: true,
                            prefix: "",
                            suffix: ""
                        },
                        data: [{

                            type: "bar",
                            yValueFormatString: "#,##0 comment",
                            indexLabel: "{y}",
                            indexLabelPlacement: "inside",
                            indexLabelFontWeight: "bolder",
                            indexLabelFontColor: "white",
                            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                        }]
                    });
                    chart.render();

                }
            </script>



        </head>

        <body>

            <div class="container-fluid">
                <div class="col-12">

                    <?php

                    if ($pf_num == 0) {
                    ?>

                        <div class="row">
                            <div class="offset-2 col-8">
                                <h1 class="text-center mt-5">There are no feedbacks about this product</h1>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="offset-4 col-4 d-grid">
                                <a class="btn btn-outline-primary" href="productlifeed.php">Back</a>
                            </div>
                        </div>


                    <?php
                    } else {



                    ?>
                        <a href="productlifeed.php" class=" text-dart">
                            <span class="material-icons-outlined mt-2">arrow_back</span>
                        </a>
                        <div class="row">

                            <div class="offset-2 col-8">
                                <h2 class="text-center mt-5"><?php echo $product_data["id"] ?>: <?php echo $product_data["title"] ?></h2>
                            </div>
                        </div>

                        <div class="col-12 table-responsive  recent-orders-table" id="printArea">
                        <?php


                        $feed_table_rs = Database::search("SELECT * FROM `feedback` WHERE `product_id`='" . $pid . "'  ");

                        $feed_table_num= $feed_table_rs->num_rows;
                    




                        ?>
                        <label class="form-label fs-4 fw-bold text-dark text-center m-2"></label>

                        <table class="table table-success table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Feedback Id</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Feedback</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">User Email</th>

                                </tr>
                            </thead>
                            <tbody class="">
                                <?php
                                for ($s = 0; $s < $feed_table_num; $s++) {
                                    $feed_table_data = $feed_table_rs->fetch_assoc();
                                ?>


                                    <tr>
                                        <td><?php echo $feed_table_data["id"] ?></td>
                                        <td><?php 
                                         if($feed_table_data["type"]==1 ){
                                            echo("Positive");

                                         }else if($feed_table_data["type"]==2){
                                            echo("Neutral");
                                         }else if($feed_table_data["type"]==3){
                                            echo("Negative");
                                         }
                                         
                                         ?>
                                         </td>
                                        <td><?php echo $feed_table_data["feedback"] ?></td>
                                        <td><?php echo $feed_table_data["date"] ?></td>
                                        <td><?php echo $feed_table_data["user_email"] ?>
                                        </td>


                                    </tr>

                                <?php
                                }


                                ?>



                            </tbody>



                        </table>

                        </div>
<?php
                            
                            ?>







                        <div class="chartCon mt-4 mb-4" id="chartContainer"></div>


                    <?php
                }
                    ?>

                </div>

            </div>





            <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>

        </body>

        </html>



    <?php


}

    ?>
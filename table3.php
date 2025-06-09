<?php

include "connection.php";


$selling_rs = Database::search("SELECT product_id, SUM(qty) AS total_sold FROM `invoice` GROUP BY product_id");
$selling_num = $selling_rs->num_rows;

//$qty_list = array();
//$pid_list = array();
$dataPoints = array();

for ($x = 0; $x < $selling_num; $x++) {
    $selling_data = $selling_rs->fetch_assoc();
    $total_sold = $selling_data["total_sold"];
    $product_id = $selling_data["product_id"];

    //add data to array
   // $qty_list[$x] = $total_sold;
   // $pid_list[$x] = $product_id;

    // Adding datapoints to array
    $dataPoints[] = array("y" => $total_sold, "label" => "Product ID: " . $product_id);
}

?>

<!DOCTYPE HTML>
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Table ms | Admin Panel</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <!-- moreee icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <link rel="icon" href="resource/logo.svg" />





    <script>

        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {

                    text: "Sold Products"
                },
                axisY: {
                    title: "Quantity",
                    includeZero: true,
                    prefix: "",
                    suffix: ""
                },
                data: [{
                    type: "bar",
                    yValueFormatString: "#,##0 Products Sold",
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
        <div class="row d-flex justify-content-end mt-3 me-1">
            <div class="d-none" id="msgDiv">
                
                    <table class="table-responsive table table-success table-hover  ">
                        <thead>
                            <tr>
                            <th scope="col">Product Id</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                            </tr>
                        </thead>

                        <tbody id="tbb">

                        </tbody>



                    </table>


                

            </div>
            <div class="col-6">
                <input type="text" class="form-control" placeholder="Product Id" id="pid">
            </div>
            <button class=" col-2 btn btn-outline-warning" onclick="tableSearchProduct();">Search Product</button>
        </div>

        <div class="row d-flex justify-content-end mt-3 mb-3 me-1">
            <div class=" d-none" id="msgDiv">
                <div class="alert alert-success" id="msg"></div>
            </div>
            <div class="col-6">
                <input type="text" class="form-control" placeholder="Product Id" id="pid">
            </div>
            <button class=" col-2 btn btn-outline-success" onclick="changeStatusProduct();">Change Status</button>
        </div>

        <div class="row d-flex justify-content-end mt-1 mb-5">
        <a href="adminPanel.php" class="col-2 btn btn-outline-primary me-3">Back to AdminPanel</a>
          
      
        </div>


    </div>




    <div class="chartCon" id="chartContainer"></div>




    </div>










    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>
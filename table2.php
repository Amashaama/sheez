<?php
include "connection.php";

$rs = Database::search("SELECT SUM(`total`) AS total, DATE(`date`) AS da FROM `invoice` GROUP BY DATE(`date`)");
$num = $rs->num_rows;

$dataPoints = array();

for ($x = 0; $x < $num; $x++) {
    $d = $rs->fetch_assoc();
    $date = strtotime($d["da"]) * 1000; // date eka millisec wlt convert krgnna
    $total = $d["total"];

    $dataPoints[] = array("x" => $date, "y" => $total);
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table ds | Admin Panel</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="icon" href="resource/logo.svg" />

    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>


    <script>
        window.onload = function() {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Revenue"
                },
                axisY: {
                    title: "Revenue in SLR",
                    valueFormatString: "",
                    suffix: ".00",
                    prefix: "Rs."
                },
                axisX: {
                    title: "Date",
                    valueFormatString: "DD MMM YYYY",
                },
                data: [{
                    type: "spline",
                    markerSize: 5,
                    xValueType: "dateTime",
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
           
           

            <div class="row d-flex justify-content-end mt-5 mb-5">
                <a href="adminPanel.php" class="col-2 btn btn-outline-primary me-3">Back to AdminPanel</a>
                <button class=" col-2 btn btn-outline-danger " onclick="window.print()">Print Report</button>


            </div>


        </div>

        <div id="chartContainer" style="height: 370px; width: 100%;"></div>

    </div>





    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>
<?php 


session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $mail = $_SESSION["u"]["email"];
    $inid = $_GET["inid"];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

    <link rel="icon" href="resources/logo/1.svg" />


    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap.css">
</head>

<body>
    <div class="mt-5 container mb-5">
        <div class="col-12">
            <div class="row">
                <h2 class="fw-bold text-center">Feedback Form</h2>
            </div>
        </div>
        <div class="col-12 container-fluid">
            <div class="row m-5">
                <div class="col-3 ">
                    <label class="form-label fw-bold ">Rate</label>
                </div>

                <div class="col-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="type1" />
                        <label class="form-check-label text-success fw-bold" for="type1">
                            Positive
                        </label>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="type2" checked />
                        <label class="form-check-label text-warning fw-bold" for="type2">
                            Neutral
                        </label>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="type3" />
                        <label class="form-check-label text-danger fw-bold" for="type3">
                            Negative
                        </label>
                    </div>
                </div>
            </div>




            <div class="row m-5">
                <div class="col-3 ">
                    <label class="form-label fw-bold">User's Email</label>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control" id="mail" value="<?php echo $mail; ?>" />
                </div>
            </div>
        </div>

        <div class="row m-5">
            <div class="col-3">
                <label class="form-label fw-bold">Feedback</label>
            </div>
            <div class="col-9">
                <textarea class="form-control" cols="50" rows="8" id="feed"></textarea>
            </div>
        </div>

        <div class="row">

            <div class="offset-lg-4 col-12 col-lg-6 ">
                <div class="row">
                    <div class="col-4 border border-primary rounded">
                        <img src="resources/empty2.svg" class="img-fluid" style="width: 250px;" id="i0" />
                    </div>
                    <div class="col-4 border border-primary rounded">
                        <img src="resources/empty2.svg" class="img-fluid" style="width: 250px;" id="i1" />
                    </div>
                    <div class="col-4 border border-primary rounded">
                        <img src="resources/empty2.svg" class="img-fluid" style="width: 250px;" id="i2" />
                    </div>
                </div>
            </div>
            <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3">
                <input type="file" class="d-none" id="imageuploader" multiple />
                <label for="imageuploader" class="col-12 btn btn-outline-success" onclick="changeProductImage();">Upload Images</label>
            </div>
        </div>

        <div class="row mt-3">

            <button type="button" class="col-12 btn btn-danger" onclick="saveFeedback(<?php echo $inid; ?>);">Save Feedback</button>
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
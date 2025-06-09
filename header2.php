<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width= device-width, initial-scale=1 ">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="icon" href="resources/logo1.svg" />




</head>

<body>






    <div class="row  hdtop_bc">





        <div class="col-12 jusified-content-center">
            <div class="row mt-3 mb-3  ">

                <div class="offset-lg-1 offset-4 col-4 col-lg-1 logo" style="height: 60px;"></div>

                <div class="col-12 col-lg-6">

                    <div class="input-group mb-3 mt-3 ">
                        <input type="text" id="kw" class="form-control" aria-label="Text input with dropdown button">

                        <select class="form-select" style="max-width: 250px;" id="c">
                            <option value="0">All Categories</option>
                            <?php

                            $category_rs = Database::search("SELECT * FROM `category`");
                            $category_num = $category_rs->num_rows;

                            for ($x = 0; $x < $category_num; $x++) {
                                $category_data = $category_rs->fetch_assoc();

                            ?>
                                <option value="<?php echo $category_data["cat_id"]  ?>"><?php echo $category_data["cat_name"] ?></option>



                            <?php
                            }


                            ?>
                        </select>

                    </div>
                </div>

                <div class="col-12 col-lg-2 ">
                    <button class="col-12 btn btn-success mt-3 mb-3" onclick="basicSearch(0);">Search</button>
                </div> <!-- pagination dana hinda tama 0 add kle -->

                <div class="col-12 col-lg-2 mt-3">
                    <a href="advancedSearch.php" class="text-decoration-none link-dark fw-bold text-white text-bg-success">Advanced Search</a>
                </div>

            </div>





        </div>





    </div>













    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>

</body>






</html>
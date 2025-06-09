<?php

session_start();

require "connection.php";

if (isset($_SESSION["a"])) {





?>


    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Add Product | sheez</title>
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resources/logo.svg" />

    </head>

    <body>

        <div class=" container-fluid p-4">

            <div class="row gy-3 d-flex justify-content-center ">



                <!-- add product -->

                <div class=" col-12 col-lg-6 add-product border border-1 border-black me-3">
                    <div class="row">

                        <div class="col-12 text-center mt-4 mb-4">
                            <h2 class="h2 text-dark fw-bold">Add New Product</h2>
                        </div>

                        <div class="col-12 ">
                            <div class="row">

                                <div class="col-12 border-end border-success">
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">Select Product Category</label>
                                        </div>

                                        <div class="col-12">
                                            <select class="form-select text-center" id="category" onchange="loadBrands();">
                                                <option value="0">Select Category</option>
                                                <?php



                                                $category_rs = Database::search("SELECT * FROM `category`");
                                                $category_num = $category_rs->num_rows;

                                                for ($x = 0; $x < $category_num; $x++) {
                                                    $category_data = $category_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $category_data["cat_id"]; ?>"><?php echo $category_data["cat_name"]; ?></option>

                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <!--
                                <div class="col-12 col-lg-6 border-end border-success">
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">Select Product Brand</label>
                                        </div>

                                        <div class="col-12">
                                            <select class="form-select text-center" id="brand">
                                                <option value="0">Select Brand</option>
                                                <?php

                                                $brand_rs = Database::search("SELECT * FROM `brand`");
                                                $brand_num = $brand_rs->num_rows;

                                                for ($x = 0; $x < $brand_num; $x++) {
                                                    $brand_data = $brand_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $brand_data["brand_id"]; ?>"><?php echo $brand_data["brand_name"]; ?></option>

                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                            -->


                                <div class="col-12">
                                    <hr class="border-success" />
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">
                                                Add a Title to your Product
                                            </label>
                                        </div>
                                        <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                            <input type="text" class="form-control" id="title" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-success" />
                                </div>

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 col-lg-6 border-end border-success">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">Select Product Condition</label>
                                                </div>
                                                <div class="col-12 mt-4">
                                                    <div class="form-check form-check-inline mx-5">
                                                        <input class="form-check-input" type="radio" id="b" name="c" checked />
                                                        <label class="form-check-label fw-bold" for="b">Brandnew</label>
                                                    </div>
                                                    <div class="form-check form-check-inline mx-5">
                                                        <input class="form-check-input" type="radio" id="u" name="c" />
                                                        <label class="form-check-label fw-bold" for="u">Used</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-6 border-end border-success">
                                            <div class="row">

                                                <div class="col-12">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">Select Product Colour</label>
                                                </div>

                                                <div class="col-12">

                                                    <select class="col-12 form-select" id="clr">
                                                        <option value="0">Select Colour</option>
                                                        <?php

                                                        $clr_rs = Database::search("SELECT * FROM `color`");
                                                        $clr_num = $clr_rs->num_rows;

                                                        for ($x = 0; $x < $clr_num; $x++) {
                                                            $clr_data = $clr_rs->fetch_assoc();
                                                        ?>

                                                            <option value="<?php echo $clr_data["clr_id"]; ?>"><?php echo $clr_data["clr_name"]; ?></option>

                                                        <?php
                                                        }

                                                        ?>
                                                    </select>

                                                </div>

                                                <div class="col-12">
                                                    <div class="input-group mt-2 mb-2">
                                                        <input type="text" class="form-control" placeholder="Add new Colour" id="clr_in" />
                                                        <button class="btn btn-outline-primary" type="button" id="button-addon2">+ Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-success" />
                                </div>



                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">Delivery Cost</label>
                                        </div>
                                        <div class="col-12 col-lg-6 border-end border-success">
                                            <div class="row">
                                                <div class="col-12 offset-lg-1 col-lg-3">
                                                    <label class="form-label">Delivery cost Within Colombo</label>
                                                </div>
                                                <div class="col-12 col-lg-8">
                                                    <div class="input-group mb-2 mt-2">
                                                        <span class="input-group-text">Rs.</span>
                                                        <input type="text" class="form-control" id="dwc" />
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="row">
                                                <div class="col-12 offset-lg-1 col-lg-3">
                                                    <label class="form-label">Delivery cost out of Colombo</label>
                                                </div>
                                                <div class="col-12 col-lg-8">
                                                    <div class="input-group mb-2 mt-2">
                                                        <span class="input-group-text">Rs.</span>
                                                        <input type="text" class="form-control" id="doc" />
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-success" />
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">Product Description</label>
                                        </div>
                                        <div class="col-12">
                                            <textarea cols="30" rows="15" class="form-control" id="desc"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-success" />
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">Add Product Images</label>
                                        </div>
                                        <div class="offset-lg-3 col-12 col-lg-6">
                                            <div class="row">
                                                <div class="col-3 border border-primary rounded">
                                                    <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i0" />
                                                </div>
                                                <div class="col-3 border border-primary rounded">
                                                    <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i1" />
                                                </div>
                                                <div class="col-3 border border-primary rounded">
                                                    <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i2" />
                                                </div>
                                                <div class="col-3 border border-primary rounded">
                                                    <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i3" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                            <input type="file" class="d-none" id="imageuploader" multiple />
                                            <label for="imageuploader" class="col-12 btn btn-primary" onclick="changeProductImageAp();">Upload Images</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-success" />
                                </div>

                                <div class="col-12 d-none" id="msgdiv">
                                    <div class="alert alert-danger " style="font-weight: bold;" role="alert" id="msg">

                                    </div>
                                </div>



                                <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                    <button class="btn btn-success" onclick="addProduct();">Save Product</button>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <!-- add product -->



                <!-- add Stock -->


                <div class="col-12 col-lg-5 add-stock ">
                    <div class="row border border-1 border-black" style="background-color: #eca3e6;">

                        <div class="col-12 text-center mt-4 mb-4">
                            <h2 class="h2 text-dark fw-bold">Add to Stock</h2>
                        </div>

                        <div class="col-12 ">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">
                                                Select Product Name
                                            </label>
                                        </div>
                                        <div class="col-12">
                                            <select class="form-select text-center" id="pid">
                                                <option value="0">Select Product Name</option>
                                                <?php

                                                $product_rs = Database::search("SELECT * FROM `product`");
                                                $product_num = $product_rs->num_rows;

                                                for ($x = 0; $x < $product_num; $x++) {
                                                    $product_data = $product_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $product_data["id"]; ?>"><?php echo $product_data["title"]; ?></option>

                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-success" />
                                </div>

                                <div class="col-12 col-lg-6 border-end border-success">
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">Select Product Model</label>
                                        </div>

                                        <div class="col-12">
                                            <select class="form-select text-center" id="model">
                                                <option value="0">Select Model</option>
                                                <?php

                                                $model_rs = Database::search("SELECT * FROM `model`");
                                                $model_num = $model_rs->num_rows;

                                                for ($x = 0; $x < $model_num; $x++) {
                                                    $model_data = $model_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $model_data["model_id"]; ?>"><?php echo $model_data["model_name"]; ?></option>

                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <div class="input-group mt-2 mb-2">
                                                <span class="input-group-text">+ New Model</span>
                                                <input type="text" class="form-control" placeholder="Add new Model" id="model_new" />

                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-12 col-lg-6 border-end border-success">
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">Select Product Brand</label>
                                        </div>

                                        <div class="col-12">
                                            <select class="form-select text-center" id="brand">
                                                <option value="0">Select Brand</option>
                                                <?php

                                                $brand_rs = Database::search("SELECT * FROM `brand`");
                                                $brand_num = $brand_rs->num_rows;

                                                for ($x = 0; $x < $brand_num; $x++) {
                                                    $brand_data = $brand_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $brand_data["brand_id"]; ?>"><?php echo $brand_data["brand_name"]; ?></option>

                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <div class="input-group mt-2 mb-2">
                                                <span class="input-group-text">+ New Brand</span>
                                                <input type="text" class="form-control" placeholder="Add new Brand" id="brand_new" />

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-success" />
                                </div>

                                <div class="col-12 col-lg-6 border-end border-success">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">Cost Per Item</label>
                                        </div>
                                        <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                            <div class="input-group mb-2 mt-2">
                                                <span class="input-group-text">Rs.</span>
                                                <input type="text" class="form-control" id="cost" />
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12 col-lg-6">
                                    <div class="row d-flex justify-content-center">

                                        <div class="col-6  border-success ">
                                            <div class="row ">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">Quantity</label>
                                                </div>
                                                <div class="offset-0  col-12 col-lg-12">
                                                    <div class="input-group mb-2 mt-2">

                                                        <input type="text" class="form-control" id="qty" />

                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>








                                <div class="col-12">
                                    <hr class="border-success" />
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">Status</label>
                                        </div>
                                        <div class="col-12 col-lg-6 border-end border-success">
                                            <select class="form-select text-center" id="status">
                                                <option value="0">Select Status</option>

                                                <?php

                                                $select_rs = Database::search("SELECT * FROM `status` ");


                                                for ($s = 0; $s < $select_rs->num_rows; $s++) {
                                                    $select_data = $select_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $select_data["status_id"] ?>"><?php echo $select_data["status_name"] ?></option>
                                                <?php
                                                }


                                                ?>


                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-success" />
                                </div>




                                <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                    <button class="btn btn-success" onclick="addToStock();">Add to Stock</button>
                                </div>

                            </div>
                        </div>

                    </div>
                   
                        <div class="col-12 col-lg-4  mt-5 d-grid">
                            <a href="adminPanel.php" class="btn btn-outline-warning" >Back to Admin Panel</a>
                        </div>

                  


                </div>
                <!-- add Stock -->






            </div>

        </div>


        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>

<?php

} else {
    header("Location:home5.php");
}

?>
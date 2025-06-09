<?php
require "connection.php";

?>

<div class="row">
    <div class="col-12">
        <label class="form-label fw-bold" style="font-size: 20px;">Add Brand Images</label>
    </div>
    <div class="col-6 d-flex justify-content-center flex-column">
        <select class="form-select text-center " id="brand_i">
            <option value="0">Select Brand</option>
            <?php

            $brand_rs = Database::search("SELECT * FROM `brand` ");

            for ($x = 0; $x < $brand_rs->num_rows; $x++) {
                $brand_data = $brand_rs->fetch_assoc();
            ?>
                <option value="<?php echo $brand_data["brand_id"]; ?>"><?php echo $brand_data["brand_name"]; ?></option>

            <?php

            }
            ?>
        </select>
    </div>
    <div class="col-6">
        <div class="row">
            <div class="col-3 border border-primary rounded">
                <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i0" />
            </div>
            <div class="col-6 d-flex justify-content-center flex-column">
                <input type="file" class="d-none" id="imageuploadb" multiple />
                <label for="imageuploadb" class=" btn btn-outline-success" onclick="ChangeProductImageApB();">Upload Image</label>

            </div>
        </div>
    </div>
    <div class="offset-3 col-6 mt-2">
        <div class="row">
            <button class="col-12 btn btn-danger" onclick="saveBrandImg();">Save Brand Image</button>
        </div>
    </div>

    <hr class="mt-5 border-2 border-black" />

    <div class="col-12">
        <label class="form-label fw-bold" style="font-size: 20px;">Add New Brand</label>
    </div>
    <div class="col-12 mt-3">
        <div class="row">
            <div class="col-4">
                <label class="form-label text-primary" style="font-size: 15px;">
                    Brand Name
                </label>
            </div>
            <div class="col-8">
                <input type="text" class="form-control" id="brand_name" />
            </div>
            <div class="offset-3 col-6 mt-5">

                <button class="col-12 btn btn-outline-danger" onclick="saveNewBrand();">Save New Brand</button>

            </div>
        </div>




    </div>
<?php
require "connection.php";
?>





<div class="row">
    <div class="col-12">
        <label class="form-label fw-bold" style="font-size: 20px;">Add Swiper Images</label>
    </div>
    <div class="offset-lg-3 col-12 col-lg-6 mt-5">
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
            <div class="col-3 border border-primary rounded">
                <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i4" />
            </div>
            <div class="col-3 border border-primary rounded">
                <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i5" />
            </div>
            <div class="col-3 border border-primary rounded">
                <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i6" />
            </div>
            <div class="col-3 border border-primary rounded">
                <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i7" />
            </div>
            <div class="col-3 border border-primary rounded">
                <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i8" />
            </div>
            <div class="col-3 border border-primary rounded">
                <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i9" />
            </div>
            <div class="col-3 border border-primary rounded">
                <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i10" />
            </div>
            <div class="col-3 border border-primary rounded">
                <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i11" />
            </div>
       
           
        </div>
    </div>
    <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
        <input type="file" class="d-none" id="imageupload" multiple />
        <label for="imageupload" class="col-12 btn btn-outline-success" onclick="ChangeProductImageApS();">Upload Images</label>
    </div>

    <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
    <button class="col-12 btn btn-outline-primary mb-2" onclick="swiperReload();">Clear Selection</button>
       
        <button class="col-12 btn btn-danger" onclick="saveSwiperImg();">Save Swiper Images</button>
    </div>

    
</div>

<script src="script.js"></script>
<?php


?>
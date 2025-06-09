<?php

session_start();
include "connection.php";

if (isset($_SESSION["u"])) {

    $email = $_SESSION["u"]["email"];


    $rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $email . "'  ");

    $num = $rs->num_rows;
    if ($num != 0) {
        for ($i = 0; $i < $num; $i++) {

            $d = $rs->fetch_assoc();
            $pid = $d["product_id"];
            $inid = $d["id"];


            $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_img` ON 
            product_img.Product_id= product.id WHERE product.id='" . $pid . "' ");

            $product_data = $product_rs->fetch_assoc();

?>


            <tr>
                <td><img src="<?php echo $product_data["img_path"]; ?>" width="100" height="150"></td>
                <td><?php echo $product_data["title"]  ?></td>
                <td><?php echo $d["total"]  ?></td>
                <td><?php echo $d["qty"]  ?></td>
                <td><?php echo $d["id"]  ?></td>
                <td class="text-danger"><?php echo $d["date"] ?></td>

                <td>
                    <div class="row">
                        <div class="col-6 d-grid">
                            <button class="btn btn-secondary rounded border border-1 border-primary mt-5 fs-5" onclick="addFeedback(<?php echo $inid ?>);">
                                <i class="bi bi-info-circle-fill"></i> Feedback
                            </button>
                        </div>
                        <div class="col-6 d-grid">
                            <button class="btn btn-danger rounded mt-5 fs-5">
                                <i class="bi bi-trash3-fill"></i> Delete
                            </button>
                        </div>
                    </div>




                </td>

            </tr>

        <?php
        }
        ?>
        <!-- model -->
        <div class="modal" tabindex="-1" id="feedbackModal<?php echo $inid; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Add New Feedback</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="form-label fw-bold text-danger">Rate Here</label>
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
                                                <label class="form-check-label text-danger-emphasis fw-bold" for="type3">
                                                    Negative
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="form-label fw-bold">User's Email</label>
                                        </div>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="mail" value="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="form-label fw-bold">Feedback</label>
                                        </div>
                                        <div class="col-9">
                                            <textarea class="form-control" cols="50" rows="8" id="feed"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-2">
                                    <div class="row">

                                        <div class="offset-lg-3 col-12 col-lg-6 ">
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
                                        <div class="offset-lg-3 col-12 col-lg-4 d-grid mt-3">
                                            <input type="file" class="d-none" id="imageuploader" multiple />
                                            <label for="imageuploader" class="col-12 btn btn-success" onclick="changeProductImage();">Upload Images</label>
                                        </div>
                                    </div>
                                </div>




                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline-primary" onclick="saveFeedback(<?php echo $inid; ?>);">Save Feedback</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- model -->



    <?php


    } else {
    ?>





<?php
    }
}


?>
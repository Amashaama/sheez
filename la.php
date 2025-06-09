<h4>Question ID: <?php echo $q_data["id"] ?> Details</h4>
                <div class="row mt-5">

                    <div class="col-2">
                        <label class="form-label fw-bold" style="font-size: 18px;">Question</label>
                    </div>
                    <div class="col-8">
                        <input type="text" class="form-control" disabled value="<?php echo $q_data["question"];  ?>" />
                    </div>


                </div>
                <div class="row mt-3">
                    <?php

                    $p_rs = Database::search("SELECT * FROM `product` WHERE id='" . $q_data["product_id"] . "' ");

                    $p_data = $p_rs->fetch_assoc();
                    ?>

                    <div class="col-2">
                        <label class="form-label fw-bold" style="font-size: 18px;">Product</label>
                    </div>
                    <div class="col-8">
                        <input type="text" class="form-control" disabled value="<?php echo $p_data["id"];  ?>. <?php echo $p_data["title"];  ?>" />
                    </div>


                </div>

                <div class="row mt-3">


                    <div class="col-2">
                        <label class="form-label fw-bold" style="font-size: 18px;">User Email</label>
                    </div>
                    <div class="col-8">
                        <input type="text" class="form-control" disabled value="<?php echo $q_data["user_email"];  ?>" />
                    </div>


                </div>

                <div class="row d-flex justify-content-start mt-3 me-1">
                    
                    <button class=" col-2 btn btn-outline-primary" onclick="tableSearchProduct();">Search Product</button>
                    <div class="col-6">
                        <input type="text" class="form-control" placeholder="Product Id" id="pid">
                    </div>

                    <div class="d-none " id="msgDiv">

                        <table class="table-responsive table table-success table-hover mt-4 ">
                            <thead>
                                <tr>
                                    <th scope="col">Product Id</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>

                            <tbody id="tbb">

                            </tbody>



                        </table>

                    </div>
                 
                </div>
                <div class="row mt-3 gy-1 ">
                    
                    <button class="col-5 btn btn-outline-success fw-bold me-2 " onclick="sendId(<?php echo $p_data['id']; ?>);" >Update Product</button>
                    <a href="addProduct.php" class="col-5 btn btn-outline-warning fw-bold">Add Product</a>
               
                  
                   
                </div>

                <div class="row mt-3">
                    <div class="col-2">
                    <label class="form-label fw-bold" style="font-size: 18px;">Your Answer</label>
                   

                    </div>
                    <div class="col-8">
                    <textarea  rows="6" class="form-control" id="answer"></textarea>
                    </div>
                </div>

                <button class=" col-12 d-grid btn btn-outline-danger fw-bold  mt-4 " onclick="sendId(<?php echo $p_data['id']; ?>);" >Update Product</button>
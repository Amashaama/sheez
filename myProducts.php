<?php

session_start();

require "connection.php";

if (isset($_SESSION["a"])){
    $email = $_SESSION["a"]["email"];

    $pageno;


?>


<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Products | sheez</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/logo.svg" />

</head>

<body style="background-color: #E9EBEE;">

    <div class="container-fluid">
        <div class="row">

            <!-- header -->
            <div class="col-12  hdtop_bc">
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="row">
                            <div class="col-12 col-lg-4 mt-1 mb-1 text-center">


                            <?php

                            $profile_img_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='".$email."'");

                            if ($profile_img_rs->num_rows ==1){

                                $profile_img_data = $profile_img_rs->fetch_assoc();

                                ?>
                                <img src="<?php  echo $profile_img_data["path"]?>" width="90px" height="90px" class="rounded-circle" />

                                
                                <?php

                            }else{

                                ?>
                                <img src="resources/profile_img/profile_img.svg" width="90px" height="90px" class="rounded-circle" />
<?php

                            }
                            
                            
                            
                            ?>

                               

                            </div>
                            <div class="col-12 col-lg-8">
                                <div class="row text-center text-lg-start">
                                    <div class="col-12 mt-0 mt-lg-4">
                                        <span class="text-dark fw-bold">
                                            <?php echo  $_SESSION["a"]["fname"]." ".$_SESSION["a"]["lname"];  ?>
                                        </span>
                                    </div>
                                    <div class="col-12">
                                        <span class="text-black-50 fw-bold">
                                            <?php echo $email   ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-8">
                        <div class="row">
                            <div class="col-12 col-lg-8 mt-2 my-lg-4">
                                <h1 class="offset-4 offset-lg-2 text-dark fw-bold">My Products</h1>
                            </div>
                            <div class="col-12 col-lg-2 mx-2 mb-2 my-lg-4 mx-lg-0 d-grid">
                                <button class="btn btn-success fw-bold" onclick="window.location='addProduct.php'">Add Product</button>
                            </div>

                            <div class="col-12 col-lg-2 mx-2 mb-2 my-lg-4 mx-lg-0 d-grid">
                                <button class="btn btn-outline-success fw-bold" onclick="window.location='adminPanel.php'">Back</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- header -->

            <!-- body -->
            <div class="col-12">
                <div class="row">
                    <!-- filter -->
                    <div class="col-11 col-lg-2 mx-3 my-3 border border-success rounded">
                        <div class="row">
                            <div class="col-12 mt-3 fs-5">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fw-bold fs-3">Sort Products</label>
                                    </div>
                                    <div class="col-11">
                                        <div class="row">
                                            <div class="col-10">
                                                <input type="text" placeholder="Search..." class="form-control" id="s" />
                                            </div>
                                            <div class="col-1 p-1">
                                                <label class="form-label"><i class="bi bi-search fs-5"></i></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <label class="form-label fw-bold">By Category</label>
                                    </div>
                                    <div class="col-12">
                                        <hr style="width: 80%;" />
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rc1" id="cwc">
                                            <label class="form-check-label" for="n">
                                            Women's Clothing
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rc1" id="cwa">
                                            <label class="form-check-label" for="o">
                                            Women's Accessories
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rc1" id="cnw">
                                            <label class="form-check-label" for="n">
                                            Night Wear
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rc1" id="cew">
                                            <label class="form-check-label" for="o">
                                            Ethnic Wear
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <label class="form-label fw-bold">Active Time</label>
                                    </div>
                                    <div class="col-12">
                                        <hr style="width: 80%;" />
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r1" id="n">
                                            <label class="form-check-label" for="n">
                                                Newest to oldest
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r1" id="o">
                                            <label class="form-check-label" for="o">
                                                Oldest to newest
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <label class="form-label fw-bold">By quantity</label>
                                    </div>
                                    <div class="col-12">
                                        <hr style="width: 80%;" />
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r2" id="h">
                                            <label class="form-check-label" for="h">
                                                High to low
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r2" id="l">
                                            <label class="form-check-label" for="l">
                                                Low to high
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <label class="form-label fw-bold">By condition</label>
                                    </div>
                                    <div class="col-12">
                                        <hr style="width: 80%;" />
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r3" id="b">
                                            <label class="form-check-label" for="b">
                                                Brandnew
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r3" id="u">
                                            <label class="form-check-label" for="u">
                                                Used
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12 text-center mt-3 mb-3">
                                        <div class="row g-2">
                                            <div class="col-12 col-lg-6 d-grid">
                                                <button class="btn btn-success fw-bold" onclick="sort(0);">Sort</button>
                                                                                            <!-- meya call wen welwe value ekk pass krnw 0 kiyl -->
                                            </div>
                                            <div class="col-12 col-lg-6 d-grid">
                                                <button class="btn btn-primary fw-bold" onclick="clearSort();">Clear</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- filter -->

                    <!-- product -->
                    <div class="col-12 col-lg-9 mt-3 mb-3 bg-secondary ">
                        <div class="row" id="sort">

                            <div class="offset-1 col-10 text-center">
                                <div class="row justify-content-center">

                                <?php

                                if(isset($_GET["page"])){
                                    $pageno = $_GET["page"];
                                }else{
                                    $pageno= 1;
                                }
                                $product_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='".$email."'  ");
                                $product_num = $product_rs->num_rows;

                                $results_per_page = 5;
                                $number_of_pages = ceil($product_num/$results_per_page);
                                
                                $page_results = ($pageno-1) * $results_per_page;

                                $selected_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='".$email."' LIMIT ".$results_per_page." OFFSET ".$page_results."  ");

                                $selected_num = $selected_rs->num_rows;

                                for($x=0;$x<  $selected_num; $x++){
                                    $selected_data = $selected_rs->fetch_assoc();

                                    ?>
                                       <!-- card -->
                                       <div class="card mb-3 mt-3 col-12 col-lg-6  ">
                                        <div class="row ">
                                            <div class="col-md-4 mt-4 mb-2 ">


                                            <?php 

                                            $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `Product_id`='".$selected_data["id"]. "'");

                                            $product_img_data = $product_img_rs->fetch_assoc();
                                             ?>

                                                <img src="<?php echo $product_img_data["img_path"]; ?>" class="img-fluid rounded-start" />
                                            </div>
                                            <div class="col-md-8  ">
                                                <div class="card-body ">
                                                    <h5 class="card-title fw-bold"><?php echo $selected_data["title"] ;?></h5>
                                                    <span class="card-text fw-bold text-primary">Rs <?php echo $selected_data["price"]; ?>.00</span><br />
                                                    <span class="card-text fw-bold text-success"><?php echo $selected_data["qty"] ?></span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" 
                                                        id="<?php $selected_data["id"]; ?>"
                                                        onchange="changeStatus(<?php echo $selected_data['id']; ?>);"

                                                        <?php if($selected_data["status_status_id"]==2){ ?> checked <?php } ?> />

                                                        <label class="form-check-label fw-bold text-info" for="<?php $selected_data["id"]; ?>">
                                                          <?php  if($selected_data["status_status_id"] == 2){ ?>
                                                          Activate Product
                                                          <?php }else{
                                                            ?>
                                                            Deactivate Account
                                                            <?php
                                                          }

                                                          ?>
                                                        

                                                        </label>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="row g-1">
                                                                <div class="col-12 col-lg-12 d-grid">
                                                                    <button class="btn btn-outline-success fw-bold" onclick="sendId(<?php echo $selected_data['id']; ?>);" >Update</button>
                                                                </div>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- card -->


                                    <?php
                                }
                                
                                ?>

                                  
                            

                                </div>
                            </div>

                            <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination pagination-lg justify-content-center">
                                        <li class="page-item">
                                            <a class="page-link" href="
                                            <?php if($pageno <=1 ) {
                                                echo ("#"); // anker tag (#) ekakin yanne GET request ekk
                                            }else{
                                                echo "?page=".($pageno-1); //pageno ekn 1 k adu krl pagge kiyn variable ekt ekka meya GET reqeust ekk widht ywnw
                                                  // bind krnna kiynw PAGE("?page") myt api set krnw (=.)

                                            } ?>
                                            
                                            " aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>

                                        <?php

                                        for($y=1; $y<= $number_of_pages;$y++){
                                            if($y== $pageno){
                                                ?>
                                                <li class="page-item active">
                                        <a class="page-link" href="<?php echo "?page=" . ($y);    ?>"><?php echo $y; ?></a>
                                        </li>

                                                <?php
                                            }else{
                                                ?>
                                                 <li class="page-item">
                                        <a class="page-link" href="<?php echo "?page=" . ($y);  ?>" ><?php echo $y; ?></a>
                                        </li>
                                                
                                                <?php

                                            }
                                        }
                                        
                                        ?>

                                        

                                       

                                        <li class="page-item">
                                            <a class="page-link" href="
                                            <?php if($pageno >= $number_of_pages ) {
                                                echo ("#"); // anker tag (#) ekakin yanne GET request ekk
                                            }else{
                                                echo "?page=".($pageno+1); //pageno ekn 1 k adu krl pagge kiyn variable ekt ekka meya GET reqeust ekk widht ywnw
                                                  // bind krnna kiynw PAGE("?page") myt api set krnw (=.)

                                            } ?>
                                            " aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>

                        </div>
                    </div>
                    <!-- product -->

                </div>
            </div>
            <!-- body -->

        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>

<?php
}

?>
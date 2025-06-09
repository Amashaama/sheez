<?php
session_start();
require "connection.php";

$search_txt  = $_POST["t"];
$category  = $_POST["cat"];
$brand  = $_POST["b"];
$model = $_POST["mo"];
$condition  = $_POST["con"];
$color  = $_POST["col"];
$from  = $_POST["pf"];
$to = $_POST["pt"];
$sort  = $_POST["s"];

$query = "SELECT * FROM `product`";
$status =0;

if($sort == 0){

    if(!empty($search_txt)){
        $query .= " WHERE `title` LIKE '%".$search_txt."%' ";
        $status = 1;
    }

    if($category != 0 && $status==0){
        $query .= " WHERE `category_cat_id`='".$category."' ";
        $status = 1;
    }else if($category != 0 && $status !=0){
        $query .= " AND `category_cat_id`='".$category."' ";
    }

    $pid = 0;

    if($brand !=0 && $model ==0 ){
        $modelHasBrand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE
                                             `brand_brand_id`='".$brand."'");
        
        $modelHasBrand_num = $modelHasBrand_rs->num_rows;
        for($x =0;$x< $modelHasBrand_num;$x++){
            $modelHasBrand_data = $modelHasBrand_rs->fetch_assoc();
            $pid = $modelHasBrand_data["id"];
        }

        if($status==0){
            $query .= " WHERE `model_has_brand_id`='".$pid."'";
            $status = 1;
        }else if($status!=0){
            $query .= " AND `model_has_brand_id`='".$pid."' ";

        }
    }else if($brand ==0 && $model != 0){
        $modelHasBrand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `model_model_id`='".$model."'");

        $modelHasBrand_num = $modelHasBrand_rs->num_rows;

        for($x=0; $x < $modelHasBrand_num; $x++){
            $modelHasBrand_data = $modelHasBrand_rs->fetch_assoc();
            $pid = $modelHasBrand_data["id"];
        }

        if($status==0){
            $query .= " WHERE `model_has_brand_id`='".$pid."'";
            $status = 1;
        }else if($status!=0){
            $query .= " AND `model_has_brand_id`='".$pid."' ";

        }

    }else if($brand != 0 && $model != 0){

        $modelHasBrand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `model_model_id`='".$model."' AND `brand_brand_id`='".$brand."' ");

        $modelHasBrand_num = $modelHasBrand_rs->num_rows;

        for($x=0; $x < $modelHasBrand_num; $x++){
            $modelHasBrand_data = $modelHasBrand_rs->fetch_assoc();
            $pid = $modelHasBrand_data["id"];
        }
    

        if($status==0){
            $query .= " WHERE `model_has_brand_id`='".$pid."'";
            $status = 1;
        }else if($status!=0){
            $query .= " AND `model_has_brand_id`='".$pid."' ";

        }
    }

        if($condition != 0 && $status ==0){
            $query .= " WHERE `condition_condition_id`='".$condition."' ";
            $status = 1;
        }else if($condition != 0 && $status != 0){
            $query .= " AND `condition_condition_id`='".$condition."' ";

        }

        if($color != 0 && $status ==0){
            $query .= " WHERE `color_clr_id`='".$color."' ";
            $status = 1;
        }else if($color != 0 && $status != 0){
            $query .= " AND `color_clr_id`='".$color."' ";

        }

        if(!empty($from) && empty($to)){
            if($status == 0){
                $query .= " WHERE `price` >= '".$from."' ";
                $status =1;
            }else if($status !=0){
                $query .= " AND `price` >= '".$from."' ";

            }
        }else if(empty($from) && !empty($to)){
            if($status == 0){
                $query .= " WHERE `price` <= '".$to."' ";
                $status =1;
            }else if($status !=0){
                $query .= " AND `price` <= '".$to."' ";

            }

        }else if(!empty($from) && !empty($to)){
            if($status == 0){
                $query .= " WHERE `price` BETWEEN '".$from."' AND '".$to."' ";
                $status =1;
            }else if($status !=0){
                $query .= " AND `price` BETWEEN '".$from."' AND '".$to."' ";

            }

        }

}else if($sort == 1){

    if(!empty($search_txt)){
        $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `price` ASC";
        $status = 1;

        // sort wla ithuruwa danna home work
    }


}else if($sort ==2){

    if(!empty($search_txt)){
        $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `price` DESC";
        $status = 1;
    }


}else if($sort ==3){
    if(!empty($search_txt)){
        $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `qty` ASC";
        $status = 1;
    }


}else if($sort ==4){
    $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `qty` DESC";
    $status = 1;


}


?>
<div class="row">
    <div class="offset-lg-1 col-12 col-lg-12 text-center">
        <div class="row">

            <?php

            if ($_POST["page"] != "0") {
                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $product_rs = Database::search("$query");
            $product_num = $product_rs->num_rows;

            $results_per_page = 5;
            $number_of_pages = ceil($product_num / $results_per_page);
            $page_results = ($pageno - 1) * $results_per_page;

            $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results);

            $selected_num = $selected_rs->num_rows;

            for ($i = 0; $i < $selected_num; $i++) {
                $selected_data = $selected_rs->fetch_assoc();

            ?>
                <div class="card col-12 col-lg-2 mt-2 mb-2 " style="width: 20rem;">

                    <?php

                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `Product_id`='" .  $selected_data['id'] . "' ");
                    $img_num = $img_rs->num_rows;
                    $img_list = array();

                    if ($img_num != 0) {
                        for ($y = 0; $y < $img_num; $y++) {
                            $img_data = $img_rs->fetch_assoc();
                            $img_list[$y] = $img_data["img_path"];

                            if ($y == 1) {
                    ?>
                                <div class="adproduct-img">
                                    <img src="<?php echo $img_list[0] ?>" class="adcard_img_top img-thumbnail mt-2" style=" height:350px;" />
                                   <!-- <img src="<?php echo $img_list[1] ?>" class="adrear_img img-thumbnail mt-2" style=" height:350px;" /> -->
                                </div>
                    <?php

                            } else {
                            }
                        }
                    }
                    ?>



                    <div class="card-body ms-0 m-0 text-center">
                        <h5 class="card-title fw-bold fs-6"><?php echo $selected_data["title"]; ?></h5>
                        <span class="badge rounded-pill text-bg-info"><?php

                                                                        if ($selected_data["condition_condition_id"] == 1) {
                                                                            echo ("New");
                                                                        } else {
                                                                            echo ("Used");
                                                                        }


                                                                        ?></span>
                        <span class="card-text text-primary">Rs.<?php echo $selected_data["price"];  ?></span><br />
                        <span class="card-text text-warning fw-bold"> In Stock</span><br />
                        <span class="card-text text-success fw-bold"><?php echo $selected_data["qty"]; ?> Items Available </span><br />
                        <a href="<?php echo "spView.php?id=" . ($selected_data["id"]); ?>" class="col-12 btn btn-success">Buy Now</a><br />
                        <button class="col-12 btn btn-dark mt-2">
                            <i class="bi bi-cart4 text-white fs-5"></i>
                        </button>
                        <button onclick="addToWatchlist(<?php echo $selected_data['id']; ?>);" class="col-12 btn btn-outline-light mt-2 border border-danger">
                            <i class="bi bi-heart-fill text-danger fs-5"></i>
                        </button>

                    </div>
                </div>





            <?php

            }

            ?>




        </div>
    </div>

    <div class="offset-2 offest-lg-3 col-8 col-lg-6 text-center mb-3">
        <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if ($pageno <= 1) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="advancedSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                } ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php

                for ($y = 1; $y <= $number_of_pages; $y++) {
                    if ($y == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link" onclick="advancedSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" onclick="advancedSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                        </li>
                <?php
                    }
                }

                ?>

                <li class="page-item">
                    <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="advancedSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                } ?> aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
           
        </nav>
    </div>

</div>
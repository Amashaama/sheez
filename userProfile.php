<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width= device-width, initial-scale=1">

    <title>eShop | User Profile</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">


    <link rel="icon" href="resources/logo.svg" />

</head>

<body>

    <div class="container-fluid " >
        <div class="row " >

            <?php

            session_start();


            require "connection.php";

            if (isset($_SESSION["u"])) {

                $email = $_SESSION["u"]["email"];

                $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON user.gender_id = gender.id WHERE `email`='" . $email . "'");

                $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $email . "'");

                $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON user_has_address.city_city_id= city.city_id INNER JOIN `district` ON city.district_district_id = district.district_id INNER JOIN `province` ON district.province_province_id= province.province_id WHERE `user_email`='" . $email . "' ");

                $details_data = $details_rs->fetch_assoc();
                $image_data = $image_rs->fetch_assoc();
                $address_data = $address_rs->fetch_assoc();










            ?>
                <div class="col-12 bg-success" >
                    <div class="row ">
                        <div class="col-12  bg-body mt-4 mb-4 ">
                            <div class="row    ">
                                <div class="col-md-3 border-end" style=" background: #87A96B;">
                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">


                                        <?php

                                        if (empty(($image_data["path"]))) {
                                        ?>
                                            <img src="resources/profile_img/profile_img.svg" class="rounded mt-5" style="width:150px" />



                                        <?php

                                        } else {

                                        ?>
                                            <img src="<?php echo $image_data["path"]; ?>" class="rounded mt-5" style="width:150px" />



                                        <?php





                                        }

                                        ?>

                                        <br />
                                        <span class="fw-bold"><?php echo $details_data["fname"] . " " . $details_data["lname"]; ?></span>
                                        <span class="fw-bold text-black-50"><?php echo $details_data["email"]; ?></span>

                                        <input type="file" class="d-none" id="profileImage" />
                                        <label for="profileImage" class="btn btn-primary mt-5">Update Profile Image</label>
                                    </div>
                                </div>

                                <div class="col-md-5 border-end ">
                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-center align-items-center mb-3">
                                            <h4 class="fw-bold" style="color:green;">Profile Settings</h4>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-6">
                                                <label class="form-label">First Name</label>
                                                <input type="text" id="fname" class="form-control" value="<?php echo $details_data["fname"]; ?>" />
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" id="lname" class="form-control" value="<?php echo $details_data["lname"]; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Mobile Number</label>
                                                <input type="text" id="mobile" class="form-control" value="<?php echo $details_data["mobile"]; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Password</label>
                                                <div class="input-group">
                                                    <input type="password" id="pw" value="<?php echo $details_data["password"]; ?>" class="form-control" aaria-describedby="basic-addon2">
                                                    <span class="input-group-text" id="pwb" onclick="showPassword3();"><i class="bi bi-eye-fill"></i></span>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Email</label>
                                                <input type="text" id="email" class="form-control" value="<?php echo $details_data["email"]; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Register Date</label>
                                                <input type="text" class="form-control" readonly value="<?php echo $details_data["joined_date"] ?>" />
                                            </div>

                                            <?php

                                            if (empty($address_data["line1"])) {
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 01</label>
                                                    <input type="text" id="line1" class="form-control" placeholder="Enter Address Line 02" />
                                                </div>
                                            <?php


                                            } else {
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 01</label>
                                                    <input type="text" id="line1" class="form-control" value="<?php echo $address_data["line1"] ?>" />
                                                </div>
                                            <?php


                                            }





                                            ?>

                                            <?php

                                            if (empty($address_data["line2"])) {
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 02</label>
                                                    <input type="text" id="line2" class="form-control" placeholder="Enter Address Line 02" />
                                                </div>
                                            <?php


                                            } else {
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 02</label>
                                                    <input type="text" id="line2" class="form-control" value="<?php echo $address_data["line2"] ?>" />
                                                </div>
                                            <?php


                                            }


                                            $province_rs = Database::search("SELECT * FROM `province`");
                                            $district_rs = Database::search("SELECT * FROM `district`");
                                            $city_rs = Database::search("SELECT * FROM `city`");

                                            $province_num = $province_rs->num_rows;
                                            $district_num = $district_rs->num_rows;
                                            $city_num = $city_rs->num_rows;





                                            ?>






                                            <div class="col-6">
                                                <label class="form-label">Province</label>
                                                <select class="form-select" id="province">
                                                    <option value="0">Select Province</option>

                                                    <?php

                                                    for ($x = 0; $x < $province_num; $x++) {
                                                        $province_data = $province_rs->fetch_assoc();

                                                    ?>
                                                        <option value="<?php echo $province_data["province_id"]; ?>" <?php

                                                                                                                        if (!empty($address_data["province_province_id"])) {
                                                                                                                            if ($province_data["province_id"] == $address_data["province_province_id"]) {
                                                                                                                        ?> selected <?php
                                                                                                                                }
                                                                                                                            }





                                                                                                                                    ?>><?php echo $province_data["province_name"]; ?></option>

                                                    <?php
                                                    }


                                                    ?>


                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">District</label>
                                                <select class="form-select" id="district">
                                                    <option value="0">Select District</option>

                                                    <?php

                                                    for ($x = 0; $x < $district_num; $x++) {
                                                        $district_data = $district_rs->fetch_assoc();

                                                    ?>
                                                        <option value="<?php echo $district_data["district_id"]; ?>" <?php

                                                                                                                        if (!empty($address_data["district_district_id"])) {
                                                                                                                            if ($district_data["district_id"] == $address_data["district_district_id"]) {
                                                                                                                        ?> selected <?php
                                                                                                                                }
                                                                                                                            }
                                                                                                                                    ?>><?php echo $district_data["district_name"]; ?></option>

                                                    <?php
                                                    }


                                                    ?>








                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">City</label>
                                                <select class="form-select" id="city">
                                                    <option value="0">Select City</option>
                                                    <?php

                                                    for ($x = 0; $x < $city_num; $x++) {
                                                        $city_data = $city_rs->fetch_assoc();

                                                    ?>
                                                        <option value="<?php echo $city_data["city_id"]; ?>" <?php

                                                                                                                if (!empty($address_data["city_city_id"])) {
                                                                                                                    if ($city_data["city_id"] == $address_data["city_city_id"]) {
                                                                                                                ?> selected <?php
                                                                                                                        }
                                                                                                                    }
                                                                                                                            ?>><?php echo $city_data["city_name"]; ?></option>

                                                    <?php
                                                    }


                                                    ?>
                                                </select>
                                            </div>

                                            <?php

                                            if (empty($address_data["postal_code"])) {
                                            ?>
                                                <div class="col-6">
                                                    <label class="form-label">Postal Code</label>
                                                    <input type="text" id="pc" class="form-control" placeholder="Enter Your Postal Code" />

                                                </div>


                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-6">
                                                    <label class="form-label">Postal Code</label>
                                                    <input type="text" id="pc" class="form-control" value="<?php echo $address_data["postal_code"]; ?>" />

                                                </div>
                                            <?php

                                            }


                                            ?>


                                            <div class="col-12">
                                                <label class="form-label">Gender</label>
                                                <input type="text" class="form-control" readonly value="<?php echo $details_data["gender_name"] ?>" />

                                            </div>

                                            <div class="col-12 d-grid mt-2">
                                                <button class="btn btn-success" onclick="updateProfile();">Update My Profile</button>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 text-center " style=" background: #87A96B;">
                                    <div class="side-nav">
                                    <div class="row   " >
                                        <div class="up-list col-12 ">
                                            <ul>
                                                <li>
                                                <span class="material-icons-outlined">home</span >&nbsp;&nbsp;
                                                <a href="home5.php" class=" text-dark">
                                                         <p>Home Page</p>
                                                    </a>
                                                </li>
                                                <li>
                                                <span class="material-icons-outlined">inventory_2</span>&nbsp;&nbsp;
                                                    <a href="watchlist.php" class=" text-dark">
                                                         <p>My Wishlist</p>
                                                    </a>
                                                </li>
                                                <li>
                                                <span class="material-icons-outlined">add_to_photos</span>&nbsp;&nbsp;
                                                    <a href="cart.php" class=" text-dark">
                                                         <p>My Cart</p>
                                                    </a>
                                                </li>
                                                <li>
                                                <span class="material-icons-outlined">update</span>&nbsp;&nbsp;
                                                    <a href="r.php" class=" text-dark">
                                                        <p>Purchased History</p>
                                                    </a>
                                                </li>
                                                <li>
                                                <span class="material-icons-outlined">phone</span>&nbsp;&nbsp;
                                                    <a href="#" class=" text-dark">
                                                        <p> Support</p>
                                                    </a>
                                                </li>
                                                <li>
                                                <span class="material-icons-outlined">email</span>&nbsp;&nbsp;
                                                    <a href="#" class=" text-dark">
                                                      <p>Messages</p> 
                                                    </a>
                                                </li>
                                            </ul>



                                        </div>
                                        <div class="up-list">
                                            <ul>
                                                <li>
                                                <span class="material-icons-outlined">logout</span>&nbsp;&nbsp;
                                                    <a href="index.php" class=" text-dark">
                                                       <p>Log out</p> 
                                                    </a>

                                                </li>
                                            </ul>
                                        </div>

                                    </div>

                                    </div>
                                </div>







                            </div>







                        <?php

                    } else {
                    }

                        ?>


                        </div>
                    </div>
                </div>





                <?php

                require "footer.php";


                ?>


        </div>
    </div>



    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>
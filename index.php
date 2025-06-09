<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sheez</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="icon" href="resources/logo/1.svg" />

</head>

<body class="main-body">

    <div class="container-fluid vh-100 d-flex justify-content-center  ">
        <div class="row align-content-center ">

            <!--header-->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"> </div>
                    <div class="col-12">
                        <p class="text-center " style="font-family: Josefin Sans; font-size:30px; letter-spacing:3px;font-weight:bold; color: aliceblue; ">Elegance, Defined by Sheez</p>
                    </div>
                </div>
            </div>

            <!--header-->

            <!--content-->
            <div class="col-12 p-3">

                <div class="row">
                    <div class="col-3 d-none d-lg-block background">

                    </div>
                    <!--signup box-->

                    <div class="col-12 col-lg-6  form-box  " id="signupbox">
                        <div class="row g-2">
                            <div class="col-12 ">
                                <p class="title02">Create New Account</p>
                            </div>
                            <div class="col-12 d-none" id="msgdiv">
                                <div class="alert alert-danger " style="font-weight: bold;" role="alert" id="msg">

                                </div>
                            </div>

                            <div class="col-6">
                                <label class="form-label1">First Name</label>
                                <input class="form-control" type="text" placeholder="ex: Aaron" id="fname" />
                            </div>

                            <div class="col-6">
                                <label class="form-label1">Last Name</label>
                                <input class="form-control" type="text" placeholder="ex: Warner" id="lname" />
                            </div>

                            <div class="col-12">
                                <label class="form-label1">Email</label>
                                <input class="form-control" type="email" placeholder="ex: aaronwarner@gmail.com" id="email" />
                            </div>

                            <div class="col-12">
                                <label class="form-label1">Password</label>
                                <input class="form-control" type="password" id="password" />
                            </div>

                            <div class="col-6">
                                <label class="form-label1">Mobile</label>
                                <input class="form-control" type="text" placeholder="ex: 0776567893" id="mobile" />
                            </div>

                            <div class="col-6">
                                <label class="form-label1">Gender</label>
                                <select class="form-control" id="gender">
                                    <option value="0">Select your gender</option>

                                    <?php

                                    require "connection.php";

                                    $rs = Database::search("SELECT * FROM `gender`");
                                    $n = $rs->num_rows;

                                    for ($x = 0; $x < $n; $x++) {
                                        $d = $rs->fetch_assoc();
                                    ?>

                                        <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?></option>

                                    <?php
                                    }




                                    ?>

                                </select>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="signUp();">Sign Up</button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger" onclick="changeView();">Already Have an Account? Sign In</button>
                            </div>







                        </div>

                    </div>
                    <!--signup box-->

                    <!--signin box-->

                    <div class="col-12 col-lg-6 d-none form2" id="signinbox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title02">Sign In to your Account</p>
                            </div>

                            <?php

                            $email = "";
                            $password = "";

                            if (isset($_COOKIE["email"])) {
                                $email = $_COOKIE["email"];
                            }

                            if (isset($_COOKIE["password"])) {
                                $password = $_COOKIE["password"];
                            }


                            ?>

                            <div class="col-12">
                                <label class="form-label1">Email</label>
                                <input class="form-control" type="email" id="email2" value=""  placeholder="ex: aaronwarner@gmail.com">


                            </div>

                            <div class="col-12">
                                <label class="form-label1">Password</label>
                                <input class="form-control" type="password" id="password2" value="<?php echo ($password); ?>" placeholder="ex: *********** " />
                            </div>

                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="rememberme">
                                    <label class="form-check-label form-label1" for="rememberme">Remember Me</label>

                                </div>
                            </div>

                            <div class="col-6 text-end">
                                <a href="#" class="link-primary" onclick="forgotPassword();">Forgot Password ?</a>
                            </div>

                            <div class="col-12 col-lg-6 d-grid  ">

                                <button class=" btn btn-primary" onclick="signin()">Sign In </button>

                            </div>

                            <div class="col-12 col-lg-6 d-grid  ">
                                <button class=" btn btn-danger" onclick="changeView();">New to eShop? Join Now</button>

                            </div>






                        </div>
                    </div>




                    <!--signin box-->
                </div>
            </div>
            <!--content-->
            <!--model-->

            <div class="modal" tabindex="-1" id="forgotPasswordModal">>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Forgot Password?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">


                                <div class="col-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="np" />
                                        <button class="btn btn-outline-secondary" type="button" id="npb" onclick="showPassword();"><i class="bi bi-eye-fill"></i></button>

                                    </div>


                                </div>
                                <div class="col-6">
                                    <label class="form-label">Retype New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="rnp" />
                                        <button class="btn btn-outline-secondary" type="button" id="rnbp" onclick="showPassword2();"><i class="bi bi-eye-fill"></i></button>

                                    </div>

                                </div>

                                <div class="col-12">
                                    <label class="form-label">Verification Code</label>
                                    <input type="text" class="form-control" id="vc" />


                                </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset Password</button>
                            </div>
                        </div>
                    </div>
                </div>








                <!--model-->

            </div>

            <!--footer-->

            <div class="col-12 d-none d-lg-block fixed-bottom">
                <p class="text-center">&copy;2023 sheez.lk ||  ALL Rights Reserved </p>
            </div>


            <!--footer-->


        </div>


        <script src="script.js"></script>
        <script src="bootstrap.js"></script>

</body>



</html>
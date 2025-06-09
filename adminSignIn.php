<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sheez | Addmin SignIn</title>
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
                        <p class="text-center " style="font-family: Josefin Sans; font-size:30px; letter-spacing:3px;font-weight:bold;color: aliceblue; ">Elegance, Defined by Sheez</p>
                    </div>
                </div>
            </div>

            <!--header-->

            <!--content-->
            
                   

            <!--signin box-->
            <div class="col-12 col-lg-6 offset-lg-3 form2" id="signinbox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title02">Sign In to your Addmin Account</p>
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
                                <input class="form-control" type="email" id="email2" value="<?php echo ($email); ?>" placeholder="ex: aaronwarner@gmail.com">


                            </div>

                            <div class="d-none" id="msgDiv">
                                <div class="alert alert-danger" id="msg"></div>
                            </div>

                           

                            <div class="col-12 col-lg-6 d-grid  ">

                                <button class=" btn btn-primary" onclick="adminSignIn();">Sign In </button>

                            </div>

                            <div class="col-12 col-lg-6 d-grid  ">
                         
                               
                              <a href="<?php echo "index.php" ?>" class="col-12 btn btn-danger">Back to Customer Sign In</a>

                            </div>






                        </div>
                    </div>

                    




            <!--signin box-->

             <!--  -->

             <div class="modal" tabindex="-1" id="verificationModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Admin Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Enter Your Verification Code</label>
                            <input type="text" class="form-control" id="vcode">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--  -->
              
            <!--content-->
         

      
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
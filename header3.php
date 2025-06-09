<!DOCTYPE html>
<html>

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">

    <title>header3</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="css/responsive.css">

    <link rel="icon" href="images/fevicon.png" type="image/gif" />

    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">

    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">


</head>

<body >
    <!-- header -->
    <div class="row ">
        <div class=" col-12 header  ">


            <div class="row header_top d_none1">


                <div class="col-3">
                    <ul class="conta_icon ">
                        <li><a href="#"><img src="images/call.png" alt="#" />Call us: 077 890 5678</a> </li>
                    </ul>
                </div>


                <div class="col-3">
                    <ul class="conta_icon d_none1">
                        <li><a href="#"><img src="images/email.png" alt="#" /> sheez5@gmail.com</a> </li>
                    </ul>
                </div>

                <div class="col-3">
                    <ul class="social_icon">
                        <li> <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li> <a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li> <a href="#"> <i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li> <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                </div>


            </div>






            <div class="row header_bottom">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                    <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse ms-3" id="navbarsExample04">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="home5.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="cart.php">My Cart</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="watchlist.php">Watchlist</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="r.php">Purchasing History</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="userProfile.php">User Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="advancedSearch.php">Advanced Search</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>


                <div class="signin col-xl-4 col-lg-4 col-md-4 col-sm-4">
                    <div class="row">


                        <?php
                        if (isset($_SESSION["u"])) {
                            $session_data = $_SESSION["u"];

                        ?>


                            <div class="col-12">
                                <span class="text-lg-start"><b>Welcome</b>
                                    <?php echo $session_data["fname"] . " " . $session_data["lname"]; ?>
                                </span>
                                |
                                <span class="text-lg-start fw-bold text-white" onclick="signout();">Sign Out</span>

                            </div>



                        <?php
                        } else {
                        ?>
                            <a href="index.php" class=" text-decoration-none text-warning fw-bold">
                                Sign In or Register
                            </a>


                        <?php

                        }




                        ?>
                    </div>
                </div>

            </div>

        </div>

















        <!-- -->







    </div>




    <!-- end header -->


    <script src="js/jquery.min.js"></script>
    <script src="SCRIPT.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>

</body>

</html>
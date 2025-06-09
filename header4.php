<!DOCTYPE html>
<html>

<head>

    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>header3</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

</head>

<body>
    <!-- header -->
    <div>
        <!-- header inner -->
        <div class="header   ">

            <div class="row  header_top d_none1">


                <div class="col-3">
                    <ul class="conta_icon ">
                        <li><a href="#"><img src="images/call.png" alt="#" />Call us: 0126 - 922 - 0162</a> </li>
                    </ul>
                </div>


                <div class="col-3">
                    <ul class="conta_icon d_none1">
                        <li><a href="#"><img src="images/email.png" alt="#" /> demo@gmail.com</a> </li>
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

                <div class="col-3">
                    <div class="se_fonr1">
                        <form action="#">
                            <div class="select-box">
                                <label for="select-box1" class="label select-box1"><span class="label-desc">English</span> </label>
                                <select id="select-box1" class="select">
                                    <option value="Choice 1">English</option>
                                    <option value="Choice 1">Sinhala</option>
                                    <option value="Choice 2">Tamil</option>

                                </select>
                            </div>
                        </form>
                        <span class="time_o"> Open hour: 8.00 - 18.00</span>
                    </div>
                </div>
            </div>




            <div class="header_bottom">
                <div class="col-12 container">

                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                            <nav class="navigation navbar navbar-expand-md navbar-dark ">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarsExample04">
                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="index.html">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="about.html">About</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="products.html">Products</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="fashion.html">Fashion</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="news.html">News</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="contact.html">Contact Us</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <!-- 
                      <div class="col-md-4">
                        <div class="search">
                            <form action="/action_page.php">
                                <input class="form_sea" type="text" placeholder="Search" name="search">
                                <button type="submit" class="seach_icon"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>

                -->
                        <div class="signin col-xl-4 col-lg-4 col-md-4 col-sm-4">
                            <div class="row ">

                                <?php
                                if (isset($_SESSION["u"])) {
                                    $session_data = $_SESSION["u"];

                                ?>

                                    <span class="text-lg-start"><b>Welcome</b>
                                        <?php echo $session_data["fname"] . " " . $session_data["lname"]; ?>
                                    </span>

                                    <span class="text-lg-start fw-bold" onclick="signout();">Sign Out</span>


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

















                        <!-- -->
                    </div>

                </div>
            </div>
        </div>

    </div>



    <!-- end header inner -->
    <!-- end header -->

    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>

</body>

</html>
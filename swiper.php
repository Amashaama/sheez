<?php


$swiper_rs = Database::search("SELECT * FROM `swiper_img` ");
$swiper_num = $swiper_rs->num_rows;

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>swiper</title>

  <link rel="stylesheet" href="bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
  <link rel="stylesheet" href="style.css" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <style>
    .swiper {
      width: 100%;
      padding-top: 50px;
      padding-bottom: 50px;
    }

    .swiper-slide {
      background-position: center;
      background-size: cover;
      width: 350px;
      height: 350px;
    }

    .swiper-slide img {
      display: block;
      width: 100%;
      -webkit-box-reflect: below 1px liner-gradient(transparent, transparent, #0002, #0004);
    }
  </style>
</head>

<body>
  <!-- Swiper -->
  <div class="col-12">
    <div class="row">
      <div class="col-4 offset-2 offset-lg-2 mt-3">
        <h1 class="swiper1_text">Snap sheez</h1>
      </div>
    </div>



    <div class="swiper mySwiper mb-3">
      <div class="swiper-wrapper">

        <?php

        for ($y = 0; $y < $swiper_num; $y++) {
          $swiper_data = $swiper_rs->fetch_assoc();
        ?>

          <div class="swiper-slide">
            <img src="<?php echo $swiper_data["swiper_img_path"]; ?>" />
          </div>




        <?php

        }


        ?>
      


      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
  <!-- Swiper -->


  <script src="script.js"></script>
  <script src="bootstrap.bundle.js"></script>
  <!-- swiper js -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      coverflowEffect: {
        rotate: 30,
        stretch: 0,
        depth: 300,
        modifier: 1,
        slideShadows: true,
      },
      /*pagination: {
        el: ".swiper-pagination",
      }, */

      loop: true,
    });
  </script>

</body>

</html>
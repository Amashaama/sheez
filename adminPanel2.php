<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Admin Panel | eShop</title>

  <link rel="stylesheet" href="bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css" />

  <!-- moreee icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

  <!-- bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">


  <link rel="icon" href="resource/logo.svg" />
</head>

<body style="background-color:rgb(247, 246, 252);">

  <div class="container-fluid">
    <div class="row">

      <div class="col-12 col-lg-2">
        <div class="row">
          <div class="col-12 align-items-start bg-dark vh-100">
            <div class="row g-1 text-center">

              <div class="col-12 mt-5">
                <h4 class="text-white">amasha ashi</h4>
                <hr class="border border-1 border-white" />
              </div>
              <div class="col-12 align-content-lg-start">

                <ul class="sidebar-list">
                  <li class="sidebar-list-item">
                    <a href="#" class=" text-white">
                      <span class="material-icons-outlined">dashboard</span> Dashboard
                    </a>
                  </li>
                  <li class="sidebar-list-item">
                    <a href="myProducts.php" class=" text-white">
                      <span class="material-icons-outlined">inventory_2</span> My Products
                    </a>
                  </li>
                  <li class="sidebar-list-item">
                    <a href="addProduct.php" class=" text-white">
                      <span class="material-icons-outlined">add_to_photos</span> Add Products
                    </a>
                  </li>
                  <li class="sidebar-list-item">
                    <a href="updateProduct.php" class=" text-white">
                      <span class="material-icons-outlined">update</span> Update Products
                    </a>
                  </li>
                  <li class="sidebar-list-item">
                    <a href="#" class=" text-white">
                      <span class="material-icons-outlined">phone</span> Support
                    </a>
                  </li>
                  <li class="sidebar-list-item">
                    <a href="#" class=" text-white">
                      <span class="material-icons-outlined">email</span> Messages
                    </a>
                  </li>
                </ul>
              </div>
              <div class="col-12 mt-5">
                <hr class="border border-1 border-white" />
                <h4 class="text-white fw-bold">Selling History</h4>
                <hr class="border border-1 border-white" />
              </div>
              <div class="col-12 mt-3 d-grid">
                <label class="form-label fs-6 fw-bold text-white">From Date</label>
                <input type="date" class="form-control" />
                <label class="form-label fs-6 fw-bold text-white mt-2">To Date</label>
                <input type="date" class="form-control" />
                <a href="#" class="btn btn-primary mt-2">Search</a>
                <hr class="border border-1 border-white" />
                <label class="form-label fs-6 fw-bold text-white">Daily Sellings</label>
                <hr class="border border-1 border-white" />
                <hr class="border border-1 border-white" />
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-10">
        <div class="row">

          <div class="text-white fw-bold mb-1 mt-3">
            <h2 class="fw-bold">Dashboard</h2>
          </div>
          <div class="col-12">
            <hr />
          </div>
          <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-white text-black text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Earnings</span>
                                            <br />

                                            <span class="fs-5">Rs..00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-dark text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Today Sellings</span>
                                            <br />
                                            <span class="fs-5"> Items</span>
                                        </div>
                                    </div>
                                </div>


        </div>
      </div>

      <div class="col-12">
        <hr />
      </div>

      <div class="col-12 bg-dark">
        <div class="row">
          <div class="col-12 col-lg-2 text-center my-3">
            <label class="form-label fs-4 fw-bold text-white">Total Active Time</label>
          </div>
          <div class="col-12 col-lg-10 text-center my-3">

            <label class="form-label fs-4 fw-bold text-warning">

            </label>
          </div>
        </div>
      </div>

      <div class="offset-1 col-10 col-lg-4 my-3 rounded bg-body">
        <div class="row g-1">
          <div class="col-12 text-center">
            <label class="form-label fs-4 fw-bold text-decoration-underline">Mostly Sold Item</label>
          </div>

          <div class="col-12 text-center shadow">
            <img src="<?php echo $image_data["code"]; ?>" class="img-fluid rounded-top" style="height: 250px;" />
          </div>
          <div class="col-12 text-center my-3">
            <span class="fs-5 fw-bold"></span><br />
            <span class="fs-6"> items</span><br />
            <span class="fs-6">.00</span>
          </div>



          <div class="col-12 text-center shadow">
            <img src="resource/empty.svg" class="img-fluid rounded-top" style="height: 250px;" />
          </div>
          <div class="col-12 text-center my-3">
            <span class="fs-5 fw-bold">-----</span><br />
            <span class="fs-6">--- items</span><br />
            <span class="fs-6">Rs. ----- .00</span>
          </div>


          <div class="col-12">
            <div class="first-place"></div>
          </div>
        </div>
      </div>

      <div class="offset-1 col-10 col-lg-4 my-3 rounded bg-body">
        <div class="row g-1">

          <div class="col-12 text-center">
            <label class="form-label fs-4 fw-bold text-decoration-underline">Most Famouse Seller</label>
          </div>
          <div class="col-12 text-center shadow">
            <img src="<?php echo $profile_data["path"]; ?>" class="img-fluid rounded-top" style="height: 250px;" />
          </div>
          <div class="col-12 text-center my-3">
            <span class="fs-5 fw-bold"></span><br />
            <span class="fs-6"><?php echo $user_data1["email"]; ?></span><br />
            <span class="fs-6"><?php echo $user_data1["mobile"]; ?></span>
          </div>

          <div class="col-12 text-center">
            <label class="form-label fs-4 fw-bold text-decoration-underline">Most Famouse Seller</label>
          </div>
          <div class="col-12 text-center shadow">
            <img src="resource/new_user.svg" class="img-fluid rounded-top" style="height: 250px;" />
          </div>
          <div class="col-12 text-center my-3">
            <span class="fs-5 fw-bold">----- -----</span><br />
            <span class="fs-6">-----</span><br />
            <span class="fs-6">----------</span>
          </div>

          <div class="col-12">
            <div class="first-place"></div>
          </div>
        </div>
      </div>

    </div>
  </div>

  </div>
  </div>

  <script src="bootstrap.bundle.js"></script>
  <script src="script.js"></script>
</body>

</html>
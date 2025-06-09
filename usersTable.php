<?php

session_start();

if (isset($_SESSION["a"])) {

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Users Details Table | Admin Panel</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <!-- moreee icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

        <!-- bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

        <link rel="icon" href="resource/logo.svg" />
    </head>

    <body class="container-fluid " onload="loadUser();">


        <div class="row ">

            <div class="col-12 text-center" style="font-size: 30px;">
                <div class="row d-flex justify-content-center" style="font-size: 30px;">
                    <label class="form-label fs-4 fw-bold text-success m-2">Users</label>
                </div>
            </div>


            <div class="col-12">
                <div class="row d-flex justify-content-end mt-3 me-1">
                    <div class=" d-none" id="msgDiv">
                        <div class="alert alert-danger" id="msg"></div>
                    </div>
                    <div class="col-6">
                        <input type="email" class="form-control" placeholder="User Email" id="user_email">
                    </div>
                    <button class=" col-2 btn btn-outline-success" onclick="changeStatusAdmin();">Change Status</button>
                </div>
            </div>



            <div class="col-12 container-fluid" id="printArea">
                <div class="row ">
                    <table class="table table-success table-hover mt-3" >
                        <thead>
                            <tr>
                                <th>Profile Picture</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>Gender</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody id="tb">

                        </tbody>



                    </table>


                </div>
                
            </div>
            <div class="col-12">
                    <div class="row d-flex justify-content-center">
                        <a href="adminPanel.php" class="col-2 btn btn-outline-success me-4">Back to Admin Panel</a>

                        <button class=" col-2 btn btn-outline-danger " onclick="printDiv()">Print Report</button>






                    </div>



                </div>

        </div>


        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>

    </body>

    </html>
<?php

}
?>
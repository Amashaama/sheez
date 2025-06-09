<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>avatar effect products</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resources/logo/1.svg" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Quicksand";
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(#007bb2, #0d1423);

        }

        .avatar_card {
            position: relative;
            width: 320px;
            height: 450px;
            /*  background: #fff; */
            border-radius: 20px;
            box-shadow: 15px 15px 35px rgba(0, 0, 0, 0.25);
            /* horizontal_shdw vertical_sdw blur_radius shdw_color */
            overflow: hidden;

        }

        .avatar_card .poster {
            position: relative;
            overflow: hidden;


        }

        .avatar_card .poster::before {
            /*inserts somthng before the content of each selected element*/
            content: '';
            position: absolute;
            bottom: -180px;
            width: 100%;
            height: 100%;
            background: linear-gradient(0deg, #1064a6 50%, transparent);
            transition: 0.5s;
            z-index: 1;
        }

        .avatar_card:hover .poster::before {
            bottom: 0px;


        }


        .poster img {
            width: 100%;
            transition: 0.7s;




        }

        .avatar_card:hover .poster img {
            transform: translateY(-50px);
            filter: blur(5px);

        }


        .avatar_card .details {
            position: absolute;
            width: 100%;
            bottom: 0;
            left: 0;
            padding: 20px;
            z-index: 2;
            transition: 0.5s;

        }

        .avatar_card:hover .details {

            bottom: 40px;

        }

        .avatar_card .details .logoshit {
            max-width: 180px;


        }

        .avatar_card .details h3 {
            font-size: 14px;
            color: azure;
        }
    </style>

</head>

<body>

    

    <div class="avatar_card  ">
        <div class="poster">
            <img src="resources/avatar/poster.jpg">

        </div>
        <div class="details">
            <img src="resources/avatar/shit.png" class="logoshit">
            <h3>Directed By james Camoeron</h3>

        </div>

    </div> 











    <script src="https://storage.ko-fi.com/cdn/scripts/overlay-widget.js"></script>

</body>

</html>
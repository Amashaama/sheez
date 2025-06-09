<!DOCTYPE html>

<html>

<head>

    <title>Image Slider</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resources/logo/1.svg" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
      
        .fullBox1 {
            /*container-fluid 8*/
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            position: absolute;
            top: 50%;
            left:50%;
            transform: translate(-50%, -50%);
            /* this creates a new stacking content */
            width: 1000px;
            height: 600px;
            background: #f5f5f5;
            box-shadow: 0 30px 50px #dbdbdb;
        }

        body {
            background: white;
        }

        .item {

            width: 200px;
            height: 300px;
            position: absolute;
            /*in absolute,element position itself relative to the
                          nearest positioned ancestor 
                       //in relative it ask ancestors if there are positioned
                        if the answer is no then it poisitioned relative to body; */
            top: 50%;
            transform: translate(0, -50%);
            /* this property creates a new stacking content */
            border-radius: 20px;
            box-shadow: 0 30px 50px #505050;
            background-position: 50% 50%;
            background-size: cover;
            display: inline-block;
            transition: 0.5s;
        }

        .slide .item:nth-child(1),
        .slide .item:nth-child(2) {
            top: 0;
            left: 0;
            transform: translate(0, 0);
            border-radius: 0;
            width: 100%;
            height: 100%;
        }

        .slide .item:nth-child(3) {
            left: 50%;
        }

        .slide .item:nth-child(4) {
            left: calc(50% + 220px);
        }

        .slide .item:nth-child(5) {
            left: calc(50% + 440px);
        }

        /* n= 0,1,2,3,4.... */
        .slide .item:nth-child(n + 6) {
            left: calc(50%+ 660px);
            opacity: 0;
            /* this property creates a new stacking content */
        }

        .item .content {

            position: absolute;
            top: 50%;
            left: 100px;
            width: 300px;
            text-align: left;
            color: #eee;
            transform: translate(0, -50%);
            /* this property creates a new stacking content */
            font-family: "Quicksand";
            display: none;
        }

        .slide .item:nth-child(2) .content {
            display: block;
        }

        .content .name {
            font-size: 40px;
            text-transform: uppercase;
            font-weight: bold;
            opacity: 0;
            animation: animate 1s ease-in-out 0.3s 1 forwards;

        }

        .content .des {
            margin-top: 10px;
            margin-bottom: 20px;
            opacity: 0;
            animation: animate 1s ease-in-out 0.3s 1 forwards;
        }

        .content button {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            opacity: 0;
            animation: animate 1s ease-in-out 0.6s 1 forwards;

        }

        @keyframes animate {
            from {
                opacity: 0;
                transform: translate(0, 400px);
                filter: blur(33px);
            }

            to {
                opacity: 1;
                transform: translate(0);
                filter: blur(0);
            }
        }

        .button{
            width:100%;
            text-align: center;
            position:absolute;
            bottom: 20px;
        }

        .button button{
            width:40px;
            height:35px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            margin: 0 5px;
            border: 1px solid #000;
            transition: 0.3s;
        }

        .button button:hover{
            background: #ababab;
            color:#fff;
        }


    </style>


</head>

<body class="container-fluid fullBox1">
    <div class="row fullBox">

        <div class="slide col-12">


            <div class="row item" style="background-image: url(https://i.ibb.co/qCkd9jS/img1.jpg);">
                <div class="content">
                    <div class="name">Switzerland</div>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                    <button>See More</button>
                </div>
            </div>
            <div class="row item" style="background-image: url(https://i.ibb.co/jrRb11q/img2.jpg);">
                <div class="content">
                    <div class="name">Finland</div>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                    <button>See More</button>
                </div>
            </div>
            <div class="row item" style="background-image: url(https://i.ibb.co/NSwVv8D/img3.jpg);">
                <div class="content">
                    <div class="name">Iceland</div>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                    <button>See More</button>
                </div>
            </div>
            <div class="row item" style="background-image: url(https://i.ibb.co/Bq4Q0M8/img4.jpg);">
                <div class="content">
                    <div class="name">Australia</div>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                    <button>See More</button>
                </div>
            </div>
            <div class="row item" style="background-image: url(https://i.ibb.co/jTQfmTq/img5.jpg);">
                <div class="content">
                    <div class="name">Netherland</div>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                    <button>See More</button>
                </div>
            </div>
            <div class="row item" style="background-image: url(https://i.ibb.co/RNkk6L0/img6.jpg);">
                <div class="content">
                    <div class="name">Ireland</div>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                    <button>See More</button>
                </div>
            </div>

        </div>

        <div class="button">
            <button class="prev"><i class="fa-solid fa-arrow-left"></i></button>
            <button class="next"><i class="fa-solid fa-arrow-right"></i></button>
        </div>

    </div>

    <script src="app.js"></script>

    


</body>
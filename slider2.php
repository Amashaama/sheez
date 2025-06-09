<!DOCTYPE html>

<html>

<head>
<title>Women's Clothing | sheez</title>

<meta charset="utf-8">
<meta name="viewport" content="width= device-width, initial-scale=1">

<link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resources/logo/1.svg" />

    <style>

        /*home background*/
body,html{
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100vh;
  font-family: sans-serif;
}
.Section_top{
  width: 100%;
  height: 50%;
  overflow: hidden;
  position: relative;
  background-image: url();
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  text-align: center;
  justify-content: center;
  animation: change 20s infinite ease-in-out;
}
.content{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-transform: uppercase;

}
.content h1{
  color: #fff;
  font-size: 60px;
  letter-spacing: 15px;
}
.content h1 span{
  color: white;
}
.content p{
  color: white;
}

@keyframes change{
  0%
  {
      background-image: url(resources/slider_images/6new.jpg);
  }
  20%
  {
      background-image: url(resources/slider_images/7.jpg);
  }
  40%
  {
      background-image: url(resources/slider_images/8.jpg);
  }
  60%
  {
      background-image: url(resources/slider_images/9.jpg);
  }
  80%
  {
      background-image: url(resources/slider_images/10.jpg);
  }
  100%
  {
      background-image: url(resources/slider_images/11.jpg);
  }
}
/*home background*/


     
    </style>
</head>

<body>

<div class="Section_top">
        <div class="content">
            <h1>Sheez <span>Women's Clothing</span></h1>
          
        </div>
</div> 


<script src="script.js"></script>
</body>
</html>

    
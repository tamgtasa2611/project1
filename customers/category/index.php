<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- bootstrap file link -->
    <link rel="stylesheet" href="../../main/css/bootstrap.css">
    <!--  main css file link  -->
    <link rel="stylesheet" href="../../main/css/main_style.css">
    <!-- header css file link -->
    <link rel="stylesheet" href="../../main/css/header_style.css">

    <title>Category - Beautiful House</title>
</head>
<body>
<!-- Header -->
<?php
include("../../layout/header.php");
?>

<!-- Padding from header -->
<div id="about"></div>

<!-- category -->
<section>
    <div class="section-default mb-5 box-shadow-category"
         style='background-image: url("../../main/media/images/category-main/category_ban.jpg");'>
        <a class="text-decoration-none text-white" href="table.php">
            <h1 class="heading-center category-zoom">Table</h1>
        </a>
    </div>

    <div class="section-default mb-5 box-shadow-category"
         style='background-image: url("../../main/media/images/category-main/category_ghe.jpg");'>
        <a class="text-decoration-none text-white" href="seating.php">
            <h1 class="heading-center category-zoom">Seating</h1>
        </a>
    </div>

    <div class="section-default mb-5 box-shadow-category"
         style='background-image: url("../../main/media/images/category-main/category_giuong.jpg");'>
        <a class="text-decoration-none text-white" href="bed.php">
            <h1 class="heading-center category-zoom">Bed</h1>
        </a>
    </div>

    <div class="section-default mb-5 box-shadow-category"
         style='background-image: url("../../main/media/images/category-main/category_tuquanao.jpg");'>
        <a class="text-decoration-none text-white" href="wardrobe.php">
            <h1 class="heading-center category-zoom">Wardrobe</h1>
        </a>
    </div>

    <div class="section-default mb-5 box-shadow-category"
         style='background-image: url("../../main/media/images/category-main/category_kesach.jpg");'>
        <a class="text-decoration-none text-white" href="bookshelf.php">
            <h1 class="heading-center category-zoom">Bookshelf</h1>
        </a>
    </div>

    <div class="section-default mb-5 box-shadow-category"
         style='background-image: url("../../main/media/images/category-main/category_dongho.jpg");'>
        <a class="text-decoration-none text-white" href="clock.php">
            <h1 class="heading-center category-zoom">Clock</h1>
        </a>
    </div>
</section>

<!-- Footer -->
<?php
include("../../layout/footer.php");
?>
</body>
</html>
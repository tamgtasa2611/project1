<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- bootstrap file link -->
    <link rel="stylesheet" href="../../main/css/bootstrap.css">
    <!-- header css file link -->
    <link rel="stylesheet" href="../../main/css/header_style.css">
    <!--  main css file link  -->
    <link rel="stylesheet" href="../../main/css/main_style.css">

    <link href="https://unpkg.com/flickity@2/dist/flickity.min.css" rel="stylesheet">
    <title>Home - Beautiful House</title>
</head>
<body style="background-color: #FFFFFF">
<?php
//format USD $$$
if (!function_exists('currency_format')) {
    function currency_format($number, $suffix = '$')
    {
        if (!empty($number)) {
            return "{$suffix}" . number_format($number, 2, ".", ",");
        }
    }
}
?>

<!-- Header -->
<?php
include("../../layout/header.php");
?>
<!-- Padding from header -->
<div id="about"></div>


<!--About section-->
<section class="section-default"
         style='background-image: url("../../main/media/images/about_section.png");
         height: 90vh'>
    <div class="left-container">
        <h1 class="heading-left mb-5">Welcome to Beautiful House <span style="font-size: 48px">☻</span> <br>
            Your world of Furnitures is here!</h1>
        <a class="read-more w-25" href="../furniture/index.php">More</a>
    </div>
</section>

<!--  Discover  -->
<section>
    <div class="">
        <div>
            <h1 class="discover-header">Discover our products</h1>
        </div>

        <!--        category -->
        <div class="discover-container">
            <div class="discover-item" style="background-color: lightblue;border-radius: 10px;">
                <a href="../category/table.php" style="width: 40%">
                    <img
                            src="../../main/media/images/categories-home/ban.jpg" alt="">
                </a>
                <div class="ditem-text">
                    <h1>Introducing our beautifully crafted table, designed to bring elegance and functionality to any
                        space</h1>
                    <a href="../category/table.php" class="button-more">More</a>
                </div>
            </div>

            <div style="background-color: white; height: 40px; color: white"></div>

            <div class="discover-item flex-row-reverse" style="background-color: lightcoral;border-radius: 10px;">
                <a href="../category/seating.php" style="width: 40%">
                    <img
                            src="../../main/media/images/categories-home/ghe.jpg" alt="">
                </a>

                <div class="ditem-text">
                    <h1>Elevate your seating arrangements with our high-quality seat, exuding both style and
                        functionality for a truly exceptional experience</h1>
                    <a href="../category/seating.php" class="button-more">More</a>
                </div>
            </div>

            <div style="background-color: white; height: 40px; color: white"></div>

            <div class="discover-item" style="background-color: lightgoldenrodyellow;border-radius: 10px;">
                <a href="../category/bed.php" style="width: 40%">
                    <img
                            src="../../main/media/images/categories-home/giuong.avif" alt="">
                </a>
                <div class="ditem-text">
                    <h1>Transform your bedroom into a sanctuary of style and comfort with our elegant bed, a centerpiece
                        that exudes both beauty and functionality</h1>
                    <a href="../category/bed.php" class="button-more">More</a>
                </div>
            </div>

            <div style="background-color: white; height: 40px; color: white"></div>

            <div class="discover-item flex-row-reverse" style="background-color: lightgreen;border-radius: 10px;">
                <a href="../category/wardrobe.php" style="width: 40%">
                    <img
                            src="../../main/media/images/categories-home/tuquanao.webp" alt="">
                </a>
                <div class="ditem-text">
                    <h1>Experience the pinnacle of organization and convenience with our thoughtfully designed wardrobe,
                        featuring easy-to-access compartments and clever storage solutions</h1>
                    <a href="../category/wardrobe.php" class="button-more">More</a>
                </div>
            </div>

            <div style="background-color: white; height: 40px; color: white"></div>

            <div class="discover-item" style="background-color: lightsalmon;border-radius: 10px;">
                <a href="../category/bookshelf.php" style="width: 40%">
                    <img
                            src="../../main/media/images/categories-home/kesach.jpg" alt="">
                </a>
                <div class="ditem-text">
                    <h1>Welcome to a world of organized living with our innovative bookshelf, providing a beautiful and
                        practical solution for displaying and organizing your books</h1>
                    <a href="../category/bookshelf.php" class="button-more">More</a>
                </div>
            </div>

            <div style="background-color: white; height: 40px; color: white"></div>

            <div class="discover-item flex-row-reverse" style="background-color: lightpink;border-radius: 10px;">
                <a href="../category/clock.php" style="width: 40%">
                    <img
                            src="../../main/media/images/categories-home/dongho.jpg" alt="">
                </a>
                <div class="ditem-text">
                    <h1>Discover the perfect timekeeping companion with our high-quality clock, expertly crafted to
                        blend seamlessly into any interior while keeping you on track</h1>
                    <a href="../category/clock.php" class="button-more">More</a>
                </div>
            </div>

        </div>

        <!--        you may like -->
        <div class="like-container justify-content-center">
            <div class="w-100">
                <h1 class="discover-header">You may like</h1>
            </div>

            <div class="d-flex">
                <div class="w-100">
                    <div class="d-flex justify-content-center flex-md-wrap">
                        <!-- Database -->
                        <?php
                        include_once("../../connect/open.php");
                        $sqlQuery = "SELECT * FROM furnitures WHERE producer_id = 3 
                                        ORDER BY id ASC LIMIT 8";
                        $furnitures = mysqli_query($connect, $sqlQuery);
                        include_once("../../connect/close.php");
                        foreach ($furnitures

                        as $furniture) {
                        ?>
                        <div class="" style="width: 25%; height: 100%;">
                            <div class="card overflow-hidden">
                                <div>
                                    <a href="../furniture/furniture_detail.php?id=<?= $furniture['id'] ?>">
                                        <img
                                                src="../../admins/images/<?= $furniture['image'] ?> ?>"
                                                alt="<?= $furniture['image'] ?>"
                                                class="img-hover-zoom fur-img"
                                        />
                                    </a>
                                </div>
                                <div>
                                    <a href="../furniture/furniture_detail.php?id=<?= $furniture['id'] ?>"
                                       class="text-dark">
                                        <div class="card-body text-center">
                                            <div class='cvp'>
                                                <h3 class="card-title font-weight-bold"><?= $furniture['name'] ?></h3>
                                                <p class="card-text" style="color: #3e9c35">
                                                    <?= currency_format($furniture['price']) ?>
                                                </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div style="text-align: right; margin-top: 2rem">
        <a href="../furniture/index.php">More product <span class="fa-solid fa-arrow-right"></span></a>
    </div>
</section>


<!-- INSPIRATION -->
<section class="d-sm-flex w-75 container mt-sm-5 ps-4 rounded-one py-sm-5">
    <div class="text-center w-100">
        <p class="display-4 discover-header">Inspiration</p>
        <div class="carousel w-100 m-auto mt-sm-5 py-sm-0" data-flickity='{ "autoPlay": true }'>
            <div class="carousel-cell ">
                <a href="../inspiration/three.php">
                    <img src="../../main/media/images/inspiration/three.jpg" class=" rounded-one" height="400px"
                         style="color: black">
                    <div class="text-center fw-bold h2 mt-5" style="color: black">Ideas to upgrade living space</div>
                    <div class="is-diviver"></div>
                    <p class="text-center" style="color: black">After long days of "selling yourself to capital", people
                        have more and more needs
                        [...]</p>
                </a>
            </div>
            <div class="carousel-cell">
                <a href="../inspiration/six.php">
                    <img src="../../main/media/images/inspiration/six.jpg" class=" rounded-one" height="400px"
                         style="color: black">
                    <div class="text-center fw-bold h2 mt-5" style="color: black">The benefits of using a smart dining
                        table
                    </div>
                    <div class="is-diviver"></div>
                    <p class="text-center" style="color: black">The dining room is the place to create a cozy feeling
                        for the apartment, so the
                        [...]</p>
                </a>
            </div>
            <div class="carousel-cell">
                <a href="../inspiration/one.php">
                    <img src="../../main/media/images/inspiration/one.jpg" class=" rounded-one" height="400px"
                         style="color: black">
                    <div class="text-center fw-bold h2 mt-5" style="color: black">How to increase the visual experience
                        of the apartment?
                    </div>
                    <div class="is-diviver"></div>
                    <p class="text-center" style="color: black">The living space in the apartment can completely turn
                        into a work
                        [...]</p>
                </a>
            </div>
            <div class="carousel-cell">
                <a href="../inspiration/five.php">
                    <img src="../../main/media/images/inspiration/five.jpg" class=" rounded-one" height="400px"
                         style="color: black">
                    <div class="text-center fw-bold h2 mt-5" style="color: black">5 suggestions for luxurious modern
                        interior design for apartments
                    </div>
                    <div class="is-diviver"></div>
                    <p class="text-center" style="color: black">5 suggestions for luxurious modern interior design for
                        shared apartments
                        [...]</p>
                </a>
            </div>
            <div class="carousel-cell">
                <a href="../inspiration/two.php">
                    <img src="../../main/media/images/inspiration/two.jpg" class=" rounded-one" height="400px"
                         style="color: black">
                    <div class="text-center fw-bold h2 mt-5" style="color: black">The secret to choosing to buy
                        decorative goods
                    </div>
                    <div class="is-diviver"></div>
                    <p class="text-center" style="color: black">The decorations always help the space have more life,
                        copper
                        [...]</p>
                </a>
            </div>
            <div class="carousel-cell">
                <a href="../inspiration/four.php">
                    <img src="../../main/media/images/inspiration/four.jpg" class=" rounded-one" height="400px"
                         style="color: black">
                    <div class="text-center fw-bold h2 mt-5" style="color: black">How to arrange a small dining room to
                        optimize space
                    </div>
                    <div class="is-diviver"></div>
                    <p class="text-center" style="color: black">For dining rooms with a modest area, the arrangement of
                        objects
                        [...]</p>
                </a>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js">
    </script>
</section>

<!-- Library -->
<section style="margin-top: 60px">
    <div class="like-container" style="border-radius: 10px">
        <div class="w-100" style="overflow: hidden; border-radius: 10px">
            <img src="../../main/media/images/start/phong-khach.jpg"
                 width="100%" style="transform: scale(1.1)">
        </div>
    </div>
</section>
<?php
include("../../layout/footer.php");
?>

</body>
<!-- header js file link   -->
<script src="../../main/js/script.js"></script>
</html>

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
    <div></div>
</section>


<section>
    <div class="">
        <div>
            <h1 class="discover-header">Discover our products</h1>
        </div>

        <div class="discover-container d-block">
            <div class="d-flex ms-sm-5 pt-5">
                <h1 class="text-uppercase">you may like</h1>
                <p class="ms-sm-5 mt-md-2">
                    <a href="../furniture/index.php">More ></a>
                </p>

            </div>
            <div class="is-diviver-2" ></div>
            <div class="d-sm-flex">
                <div class= "w-100 m-5">


                    <div class="d-flex justify-content-center flex-md-wrap">
                        <!-- Database -->
                        <?php
                        include_once("../../connect/open.php");
                        $sqlQuery = "SELECT * FROM furnitures ORDER BY id DESC";
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
                                    <a href="../furniture/furniture_detail.php?id=<?= $furniture['id'] ?>" class="text-dark">
                                        <div class="card-body text-center">
                                            <div class='cvp'>
                                                <h4 class="card-title font-weight-bold"><?= $furniture['name'] ?></h4>
                                                <p class="card-text"><?= currency_format($furniture['price']) ?></p>
                                    </a>
                                </div>
                                <div class="d-flex justify-content-evenly align-items-center mt-5">
                                    <a href="../furniture/furniture_detail.php?id=<?= $furniture['id'] ?>">View details</a><br/>
                                    <button class="btn btn-primary">
                                        <a href="../carts/add_to_cart.php?id=<?= $furniture['id'] ?>" class="text-white">
                                            Add to cart
                                        </a>
                                    </button>
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
</section>


<!-- INSPIRATION -->

<section  class="d-sm-flex w-100 container mt-sm-5 ps-4 rounded-one py-sm-5">
    <div class="text-center w-100"><p class="display-4">Inspiration</p>
        <div class="carousel w-75 px-5 m-auto mt-sm-5 py-sm-5" data-flickity='{ "autoPlay": true }' >
            <div class="carousel-cell">
                <a href="../inspiration/three.php">
                    <img src="../../main/media/images/inspiration/three.jpg" class=" rounded-one" width="700px" height="435px" style="color: black">
                    <div class="text-center fw-bold h2" style="color: black">Ideas to upgrade living space</div>
                    <div class="is-diviver"></div>
                    <p class="text-center" style="color: black">After long days of "selling yourself to capital", people have more and more needs
                        [...]</p>
                </a>
            </div>
            <div class="carousel-cell">
                <a href="../inspiration/six.php">
                    <img src="../../main/media/images/inspiration/six.jpg" class=" rounded-one" width="700px" height="435px" style="color: black">
                    <div class="text-center fw-bold h2" style="color: black">The benefits of using a smart dining table</div>
                    <div class="is-diviver"></div>
                    <p class="text-center" style="color: black">The dining room is the place to create a cozy feeling for the apartment, so the
                        [...]</p>
                </a>
            </div>
            <div class="carousel-cell">
                <a href="../inspiration/one.php">
                    <img src="../../main/media/images/inspiration/one.jpg" class=" rounded-one" width="700px" height="435px" style="color: black">
                    <div class="text-center fw-bold h2" style="color: black">How to increase the visual experience of the apartment?</div>
                    <div class="is-diviver"></div>
                    <p class="text-center" style="color: black">The living space in the apartment can completely turn into a work
                        [...]</p>
                </a>
            </div>
            <div class="carousel-cell">
                <a href="../inspiration/five.php">
                    <img src="../../main/media/images/inspiration/five.jpg" class=" rounded-one" width="700px" height="405px" style="color: black">
                    <div class="text-center fw-bold h2" style="color: black">5 suggestions for luxurious modern interior design for apartments</div>
                    <div class="is-diviver"></div>
                    <p class="text-center" style="color: black">5 suggestions for luxurious modern interior design for shared apartments
                        [...]</p>
                </a>
            </div>
            <div class="carousel-cell">
                <a href="../inspiration/two.php">
                    <img src="../../main/media/images/inspiration/two.jpg" class=" rounded-one" width="700px" height="435px" style="color: black">
                    <div class="text-center fw-bold h2" style="color: black">The secret to choosing to buy decorative goods</div>
                    <div class="is-diviver"></div>
                    <p class="text-center" style="color: black">The decorations always help the space have more life, copper
                        [...]</p>
                </a>
            </div>
            <div class="carousel-cell">
                <a href="../inspiration/four.php">
                    <img src="../../main/media/images/inspiration/four.jpg" class=" rounded-one" width="700px" height="435px" style="color: black">
                    <div class="text-center fw-bold h2" style="color: black">How to arrange a small dining room to optimize space</div>
                    <div class="is-diviver"></div>
                    <p class="text-center" style="color: black">For dining rooms with a modest area, the arrangement of objects
                        [...]</p>
                </a>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js">
    </script>
</section>


<!-- SUPPORT LETTER -->
<section class="d-sm-flex w-100 container mt-sm-5 ps-4 pt-sm-5" style="background-color: ">
    <div class="d-flex w-50 ms-sm-2 bd-left" style="background-color: #b95016">
        <div class=" mx-sm-5 mt-md-5">
            <p class="text-uppercase display-4 fw-bold">do you need support ?</p>
            <p class="my-lg-5 display-6">Please leave your support request.</p>
            <div>
                <form class="d-flex mb-sm-5 display-6">
                    <input type="text" name="name"  aria-invalid="false" aria-required="true"
                           placeholder="Fullname" class="py-4 w-75 read-more">

                    <input type="number" name="phonenumber"  value size="9"  aria-required="true" aria-invalid="false"
                           placeholder="+(84) 0123 456 " class="mx-lg-2 w-50 read-more">


                </form>
                <form class="display-6">
                    <input type="email" name="email" value size="36" aria-invalid="false"
                           placeholder="Enter email" width="70%" class="py-4 read-more">
                </form>

                <form class="mt-md-5 display-6">
                            <textarea rows="5" cols="38"  aria-required="true" aria-invalid="false"
                                      placeholder="contact content" class="read-more text-start">
                            </textarea>
                </form>
                <div class="d-flex mt-md-4">
                    <input name="image" type="file" value="">
                    <button class="text-uppercase ms-sm-5 px-3 py-2" style="background-color: black">
                        <p style="color:#fff;">Send request</p>
                    </button>
                </div>
            </div>
        </div>

    </div>
    <div class="w-50">
        <img class="bd-right" src="../../main/media/images/start/phong-khach-pio-tao-nha-tinh-te-1-1.jpg" width="633px" height="936px">
    </div>
</section>
<?php
include("../../layout/footer.php");
?>
</body>
<!-- header js file link   -->
<script src="../../main/js/script.js"></script>
</html>
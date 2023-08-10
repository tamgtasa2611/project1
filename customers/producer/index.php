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

    <title>Collection - Beatiful House</title>
</head>
<body>
<!-- Header -->
<?php
include("../../layout/header.php");
?>
<!-- Padding from header -->
<div id="about"></div>

<!--  TITLE  -->
<div class="mt-5">
    <div class="text-center text-lg-start">
        <div class="container p-4 pb-0">
            <section>
                <!-- HEADER -->
                <div class="row mx-sm-4">
                    <div class="col-md-3 col-lg-3 col-xl-auto mx-auto mt-3">
                        <p class="display-4">Collection</p>
                    </div>
                    <!-- BODY   -->
                    <section class="d-sm-flex">
                        <!-- LEFT SIDEBAR   -->
                        <div class="d-block ms-md-2 me-md-5 my-lg-5 w-50 h-25"
                             style="background-color: lightsalmon; border-radius: 10px">
                            <div class="ms-md-5 my-lg-5">
                                <span class="fw-bold">Beautiful House's Collection</span>
                                <a href="one.php" style="color: black;">
                                    <li>IKEA Collection
                                </a>
                                <a href="two.php" style="color: black;">
                                    <li>Herman Miller Collection</li>
                                </a>
                                <a href="three.php" style="color: black;">
                                    <li>Crate & Barrel Collection</li>
                                </a>
                                <a href="four.php" style="color: black;">
                                    <li>Steelcase Collection</li>
                                </a>
                                <a href="five.php" style="color: black;">
                                    <li>RH Collection</li>
                                </a>
                                <a href="six.php" style="color: black;">
                                    <li>Okamura Collection</li>
                                </a>
                            </div>
                        </div>
                        <!-- RIGHT SIDEBAR   -->
                        <section>
                            <!-- BODY 1 -->
                            <div class="ms-md-5 d-sm-flex mt-md-5">
                                <!-- ONE -->
                                <div class="me-md-5  w-50">
                                    <a href="one.php " style="color: #2c3034">
                                        <img src="../../main/media/images/producers/one.jpg" class="bd-rd"
                                             width="420px"
                                             height="270px">
                                        <p class="fw-bold text-center mt-md-4">Collection IKEA</p>
                                        <div class="is-diviver"></div>
                                        <p>With its inspiration from square lines, the IKEA collection brings beauty
                                            firm and strong [...]</p>
                                    </a>

                                </div>

                                <!-- TWO -->
                                <div class=" w-50">
                                    <a href="two.php " style="color: #2c3034">
                                        <img src="../../main/media/images/producers/two.jpg" class="bd-rd"
                                             width="420px"
                                             height="270px">
                                        <p class="fw-bold text-center mt-md-4">Collection Herman Miller</p>
                                        <div class="is-diviver"></div>
                                        <p>Inspired by sophisticated, light, simple yet elegant interiors Herman
                                            Miller is a combination [...]</p>
                                    </a>
                                </div>
                            </div>

                            <!-- BODY 2 -->
                            <div class="ms-md-5 d-sm-flex mt-md-5">
                                <!-- THREE -->
                                <div class="me-md-5  w-50">
                                    <a href="three.php " style="color: #2c3034">
                                        <img src="../../main/media/images/producers/three.jpg" class="bd-rd"
                                             width="420px"
                                             height="270px">
                                        <p class="fw-bold text-center mt-md-4">Collection Crate & Barrel</p>
                                        <div class="is-diviver"></div>
                                        <p>Designer Huy Lan derives her inspirations from pure beauty
                                            the trick of the [...]</p>
                                    </a>
                                </div>

                                <!-- FOUR -->
                                <div class=" w-50">
                                    <a href="four.php " style="color: #2c3034">
                                        <img src="../../main/media/images/producers/four.jpg" class="bd-rd"
                                             width="420px"
                                             height="270px">
                                        <p class="fw-bold text-center mt-md-4">Collection Steelcase</p>
                                        <div class="is-diviver"></div>
                                        <p>Compact yet modern and elegant Steelcase collection helps space
                                            Active and pretty [...]</p>
                                    </a>
                                </div>
                            </div>

                            <!-- BODY 3 -->
                            <div class="ms-md-5 d-sm-flex mt-md-5">
                                <!-- FIVE -->
                                <div class="me-md-5  w-50">
                                    <a href="five.php " style="color: #2c3034">
                                        <img src="../../main/media/images/producers/six.jpg" class="bd-rd"
                                             width="420px"
                                             height="270px">
                                        <p class="fw-bold text-center mt-md-4">Collection Restoration Hardware</p>
                                        <div class="is-diviver"></div>
                                        <p>With its own youthful and innovative quality, the Restoration Hardware
                                            collection brings to
                                            The products are compact, modern [...]</p>
                                    </a>
                                </div>

                                <div class="me-md-5 w-50">
                                    <a href="six.php " style="color: #2c3034">
                                        <img src="../../main/media/images/producers/five.jpg" class="bd-rd"
                                             width="420px"
                                             height="270px">
                                        <p class="fw-bold text-center mt-md-4">Collection Okamura</p>
                                        <div class="is-diviver"></div>
                                        <p>Unique combination of Hi Tech Veneer Brown Oak and cooper metal legs
                                            help collection [...]</p>
                                    </a>
                                </div>
                            </div>
                        </section>
                    </section>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- Footer -->
<?php
include("../../layout/footer.php");
?>
</body>
<!-- header js file link   -->
<script src="../../main/js/script.js"></script>
</html>

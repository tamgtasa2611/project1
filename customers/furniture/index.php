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

    <title>Product - Beautiful House</title>
</head>
<body style="background-color: white">
<?php
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
?>

<!-- Header -->
<?php
include("../../layout/header.php");
//format vnd
if (!function_exists('currency_format')) {
    function currency_format($number, $suffix = 'đ')
    {
        if (!empty($number)) {
            return number_format($number, 0, ',', '.') . "{$suffix}";
        }
    }
}
?>
<!-- Padding from header -->
<div id="about"></div>

<!--Furniture-->
<section class="section-default">
    <div
            style='background-image: url("../../main/media/images/furnitures_index.jpg");
        height: 50vh; background-size: cover;'>
        <h1 class="heading-center">Products</h1>
    </div>
</section>

<!--  Categories  -->
<section id="furnitures-list">
    <div id="category-section" class="container mt-5" style="border-radius: 1rem !important;">
        <div class="d-flex justify-content-between m-5">
            <div class="d-flex">
                <div>
                    <div>Sort by</div>
                    <div>
                        <select name="" id="" class="bd-gray pb-2 mt-4">
                            <option value="">Newest</option>
                            <option value="">Lowest price</option>
                            <option value="">Highest price</option>
                        </select>
                    </div>
                </div>
                <div>
                    <div>Producer</div>
                    <div>
                        <select name="" id="" class="bd-gray pb-2 mt-4">
                            <option value="">IKEA</option>
                            <option value="">Herman Miller</option>
                            <option value="">Crate & Barrel</option>
                            <option value="">Steelcase</option>
                            <option value="">Restoration Hardware</option>
                            <option value="">Okamura</option>
                        </select>
                    </div>
                </div>
                <div>
                    <div>Category</div>
                    <div>
                        <select name="" id="" class="bd-gray pb-2 mt-4">
                            <option value="">Table</option>
                            <option value="">Seating</option>
                            <option value="">Bed</option>
                            <option value="">Wardrobe</option>
                            <option value="">Bookshelf</option>
                            <option value="">Clock</option>
                        </select>
                    </div>
                </div>
                <div>
                    <button class="sort-button">Apply</button>
                </div>
            </div>
            <form method="get">
                    <input type="text" name="search"
                           value="<?= $search; ?>"
                           placeholder="Search here..." class="search-bar">
            </form>


        </div>
        <div class="d-flex justify-content-center flex-md-wrap">
            <!-- Database -->
            <?php
            include_once("../../connect/open.php");
            $sql = "SELECT * FROM furnitures WHERE name LIKE '%$search%'";
            $furnitures = mysqli_query($connect, $sql);
            include_once("../../connect/close.php");
            foreach ($furnitures

            as $furniture) {
            ?>
            <div class="" style="width: 25%; height: 100%;">
                <div class="card overflow-hidden">
                    <div>
                        <a href="furniture_detail.php?id=<?= $furniture['id'] ?>">
                            <img
                                    src="../../admins/images/<?= $furniture['image'] ?> ?>"
                                    alt="<?= $furniture['image'] ?>"
                                    class="img-hover-zoom fur-img"
                            />
                        </a>
                    </div>
                    <div>
                        <a href="furniture_detail.php?id=<?= $furniture['id'] ?>" class="text-dark">
                            <div class="card-body text-center">
                                <div class='cvp'>
                                    <h4 class="card-title font-weight-bold"><?= $furniture['name'] ?></h4>
                                    <p class="card-text"><?= number_format($furniture['price']) ?><span>₫</span></p>
                        </a>
                    </div>
                    <div class="d-flex justify-content-evenly align-items-center mt-5">
                        <a href="furniture_detail.php?id=<?= $furniture['id'] ?>">View details</a><br/>
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
</section>

<!-- Footer -->
<?php
include("../../layout/footer.php");
?>
</body>
<!-- header js file link   -->
<script src="../../main/js/script.js"></script>
</html>
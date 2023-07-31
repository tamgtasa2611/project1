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

    <title>Search results - Beautiful House</title>
</head>
<body style="background-color: white">
<?php
//format usd
if (!function_exists('currency_format')) {
    function currency_format($number, $suffix = '$')
    {
        if (!empty($number)) {
            return "{$suffix}" . number_format($number, 2, ".");
        }
    }
}
?>

<?php
//search form
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
?>

<?php
//hàm xử lý: low high new
function sortByFunction($string): string
{
    $sortByString = "";
    if ($string === "low") {
        $sortByString = "price ASC";
    } else if ($string === "high") {
        $sortByString = "price DESC";
    } else if ($string === "new") {
        $sortByString = "id DESC";
    }
    return $sortByString;
}

//sort form
$sortBy = "new";
if (isset($_GET['sort-by'])) {
    $sortBy = $_GET['sort-by'];
}
$sortByOrder = sortByFunction($sortBy);

//sort nhà sản xuất
$sortProducer = "";
if (isset($_GET['sort-producer'])) {
    //nếu = 0 thì ko set giá trị
    if ($_GET['sort-producer'] > 0) {
        $sortProducer = $_GET['sort-producer'];
    }
}

//sort danh mục
$sortCategory = "";
if (isset($_GET['sort-category'])) {
    //nếu = 0 thì ko set giá trị
    if ($_GET['sort-category'] > 0) {
        $sortCategory = $_GET['sort-category'];
    }
}

//default
$sqlQuery = "SELECT * FROM furnitures
                    WHERE name LIKE '%$search%'
                    ORDER BY id DESC";

//kiểm tra nếu 2 biến sort đã set giá trị là id (>0)
//cả 2 đều set
if (is_numeric($sortProducer) and is_numeric($sortCategory)) {
    $sqlQuery = "SELECT * FROM furnitures
                    WHERE name LIKE '%$search%'
                    AND producer_id = '$sortProducer'
                    AND category_id = '$sortCategory'
                    ORDER BY " . $sortByOrder;
} //chỉ set nhà sản xuất
else if (is_numeric($sortProducer) and !is_numeric($sortCategory)) {
    $sqlQuery = "SELECT * FROM furnitures
                    WHERE name LIKE '%$search%'
                    AND producer_id = '$sortProducer'
                    ORDER BY " . $sortByOrder;
} //chỉ set danh mục
else if (!is_numeric($sortProducer) and is_numeric($sortCategory)) {
    $sqlQuery = "SELECT * FROM furnitures
                    WHERE name LIKE '%$search%'
                    AND category_id = '$sortCategory'
                    ORDER BY " . $sortByOrder;
} else if (!is_numeric($sortProducer) and !is_numeric($sortCategory)) {
    $sqlQuery = "SELECT * FROM furnitures
                    WHERE name LIKE '%$search%'
                    ORDER BY " . $sortByOrder;
}
?>

<!-- Header -->
<?php
include("../../layout/header.php");
?>
<!-- Padding from header -->
<div id="about"></div>

<!--Furniture-->
<section class="section-default">
    <div
            style='background-image: url("../../main/media/images/furnitures_search.jpg");
        height: 50vh; background-size: cover; background-position-y: center'>
        <h1 class="heading-center">Search results for "<?= $search ?>" </h1>
    </div>
</section>

<!--  Categories  -->
<section id="furnitures-list">
    <div id="category-section" class="container mt-5" style="border-radius: 1rem !important;">
        <div class="d-flex justify-content-between m-5">
            <form class="d-flex" method="get">
                <div>
                    <div class="d-none">
                        <input type="text" name="search" value="<?= $search ?>" readonly>
                    </div>
                    <div>Sort by</div>
                    <div>
                        <select name="sort-by" id="" class="bd-gray pb-2 mt-4">
                            <!--                            <option value="">Default</option>       -->
                            <option value="new"
                                <?php
                                if ($sortBy == "new") {
                                    echo "selected";
                                }
                                ?>>Newest
                            </option>
                            <option value="low"
                                <?php
                                if ($sortBy == "low") {
                                    echo "selected";
                                }
                                ?>>Lowest price
                            </option>
                            <option value="high"
                                <?php
                                if ($sortBy == "high") {
                                    echo "selected";
                                }
                                ?>>Highest price
                            </option>
                        </select>
                    </div>
                </div>
                <div>
                    <div>Producer</div>
                    <div>
                        <select name="sort-producer" id="" class="bd-gray pb-2 mt-4">
                            <option value="">Choose a producer</option>
                            <!-- Database -->
                            <?php
                            include_once("../../connect/open.php");
                            $sql2 = "SELECT * FROM producers";
                            $producers = mysqli_query($connect, $sql2);
                            foreach ($producers as $producer) {
                                ?>
                                <option value="<?= $producer['id'] ?>"
                                    <?php
                                    if ($producer['id'] == $sortProducer) {
                                        echo 'selected';
                                    }
                                    ?>
                                >
                                    <?= $producer['name'] ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div>
                    <div>Category</div>
                    <div>
                        <select name="sort-category" id="" class="bd-gray pb-2 mt-4">
                            <option value="">Choose a category</option>
                            <!-- Database -->
                            <?php
                            include_once("../../connect/open.php");
                            $sql3 = "SELECT * FROM categories";
                            $categories = mysqli_query($connect, $sql3);
                            foreach ($categories as $category) {
                                ?>
                                <option value="<?= $category['id'] ?>"
                                    <?php
                                    if ($category['id'] == $sortCategory) {
                                        echo "selected";
                                    }
                                    ?>
                                >
                                    <?= $category['name'] ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div>
                    <button class="sort-button" type="submit">Apply</button>
                </div>
            </form>

        </div>
        <div class="d-flex justify-content-center flex-md-wrap">
            <!-- Database -->
            <?php
            include_once("../../connect/open.php");
            $furnitures = mysqli_query($connect, $sqlQuery);
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
                                    <h3 class="card-title font-weight-bold"><?= $furniture['name'] ?></h3>
                                    <p class="card-text" style="color: #3e9c35">
                                        <?= currency_format($furniture['price']) ?>
                                    </p>
                        </a>
                    </div>

                    <?php
                    if ($furniture['quantity'] == 0) {
                        ?>
                        <div class="mt-5 d-flex justify-content-center align-items-center">
                            <div class="view-detail-btn text-center w-50">
                                OUT OF STOCK
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="d-flex justify-content-evenly align-items-center mt-5">
                            <a href="furniture_detail.php?id=<?= $furniture['id'] ?>" class="view-detail-btn"
                            >View details</a>
                            <button class="add-to-cart-btn">
                                <a href="../carts/add_to_cart.php?id=<?= $furniture['id'] ?>"
                                   class="text-white">
                                    Add to cart <span class="m-1 fa-solid fa-cart-plus"></span>
                                </a>
                            </button>
                        </div>
                        <?php
                    }
                    ?>
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
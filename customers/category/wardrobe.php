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

    <title>Wardrobe - Beautiful House</title>
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

//default
$sqlQuery = "SELECT * FROM furnitures
                    WHERE name LIKE '%$search%' AND category_id = 4
                    ORDER BY id DESC";

if (isset($_GET['sort-by'])) {
    $sqlQuery = "SELECT * FROM furnitures
                    WHERE name LIKE '%$search%' AND category_id = 4
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
    <div class="furniture-slider"
         style='background-image: url("../../main/media/images/category-main/category_tuquanao.jpg");'>
        <h1 class="heading-center">Wardrobe</h1>
    </div>
</section>

<!--Thong bao them sp vao gio hang-->
<?php
if (!isset($_SESSION['add-success'])) {
    $_SESSION['add-success'] = 0;
}
if ($_SESSION['add-success'] === 1) {
    echo '<div id="close-target" class="alert alert-success position-absolute success-alert" role="alert">
              Added to cart successfully! 
              <i id="click-close" class="fa-solid fa-x" style="font-size: 12px; padding: 8px" onclick="closeMes()"></i>
              </div>';
    $_SESSION['add-success'] = 0;
}
?>

<script>
    let clickClose = document.getElementById('click-close');
    let closeTarget = document.getElementById('close-target')

    function closeMes() {
        closeTarget.classList.add("d-none");
    }
</script>


<!--  Categories  -->
<section id="furnitures-list">
    <div id="category-section" class="container mt-5" style="border-radius: 1rem !important;">
        <div class="d-flex justify-content-between m-5">
            <form class="d-flex" method="get">
                <div>
                    <div>Sort by</div>
                    <div>
                        <select name="sort-by" id="" class="bd-gray pb-2 mt-4">
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
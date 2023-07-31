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
    <!-- header css file link -->
    <link rel="stylesheet" href="../../main/css/header_style.css">
    <!--  main css file link  -->
    <link rel="stylesheet" href="../../main/css/main_style.css">
    <!--    furnitures detail link-->
    <link rel="stylesheet" href="../../main/css/furnitures.css">

    <title>Furniture's Detail</title>
</head>
<body>
<!-- Header -->
<?php
include("../../layout/header.php");
?>
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

<!-- Padding from header -->
<div id="about"></div>

<?php
//Lấy id của sp
$id = $_GET['id'];
//Mở kết nối
include_once '../../connect/open.php';
//Viết query
$sql = "SELECT furnitures.*, categories.name as category_name, producers.name as producer_name
        FROM furnitures 
        INNER JOIN categories ON furnitures.category_id = categories.id
        INNER JOIN producers ON furnitures.producer_id = producers.id
         WHERE furnitures.id = '$id'";
//Chạy query
$furnitures = mysqli_query($connect, $sql);

//query tinh so san pham da ban
$soldQuery = "SELECT sum(order_details.quantity) AS sold_quantity
                    FROM furnitures
                    INNER JOIN order_details ON furnitures.id = order_details.furniture_id
                    INNER JOIN orders ON orders.id = order_details.order_id
                    WHERE (orders.status = 3) AND (furnitures.id = '$id')";
$soldQuantities = mysqli_query($connect, $soldQuery);

//Đóng kết nối
include_once '../../connect/close.php';
foreach ($furnitures as $furniture) {
    ?>
    <!--    san pham    -->
    <!--Thong bao them sp vao gio hang-->
    <?php
    if (!isset($_SESSION['add-success'])) {
        $_SESSION['add-success'] = 0;
    }
    if ($_SESSION['add-success'] === 1) {
        echo '<div id="close-target" class="alert alert-success position-absolute success-alert" role="alert"
                style="top: 14.5%">
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
    <!-- content -->
    <div id="furniture-detail-container" class="mt-5">
        <div id="furniture-img">
            <img style="margin: auto;" width="80%"
                 src="../../admins/images/<?= $furniture['image'] ?>"/>
        </div>
        <div id="furniture-info">
            <div>
                <h1 class="">
                    <?= $furniture['name'] ?>
                </h1>
            </div>

            <div class="d-flex justify-content-between">
                <span class="text-muted">
                    <i class="fas fa-shopping-basket fa-sm mx-1">
                    </i><?php
                    foreach ($soldQuantities as $soldQuantity) {
                        ?>
                        <span><?= $soldQuantity['sold_quantity'] ?></span>
                        <?php
                    }
                    ?>
                    sold
                </span>

                <span style="color: #3e9c35"><?= currency_format($furniture['price']) ?></span>
            </div>


            <div class="d-flex justify-content-between">
                <dt class="">Material:</dt>
                <dd class=""><?= $furniture['material'] ?></dd>
            </div>
            <div class="d-flex justify-content-between">
                <dt class="">Category:</dt>
                <dd class=""><?= $furniture['category_name'] ?></dd>
            </div>
            <div class="d-flex justify-content-between">
                <dt class="">Producer:</dt>
                <dd class=""><?= $furniture['producer_name'] ?></dd>
            </div>
            <div class="d-flex justify-content-between">
                <dt class="">In stock:</dt>
                <dd class=""><?= $furniture['quantity'] ?></dd>
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
                    <a href="../carts/buy_now.php?id=<?= $id ?>" id="buy-now-btn" class="view-detail-btn">
                        Buy now <span class="me-1 fa fa-shopping-basket"></span></a>
                    <a href="../carts/add_to_cart.php?id=<?= $id; ?>" id="add-to-cart-btn" class="add-to-cart-btn">
                        Add to cart <span class="m-1 fa-solid fa-cart-plus"></a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <!-- content -->
    <?php
}
?>

<!-- Footer -->
<?php
include("../../layout/footer.php");
?>
</body>
</html>
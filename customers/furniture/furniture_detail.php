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
//Đóng kết nối
include_once '../../connect/close.php';
foreach ($furnitures as $furniture) {
    ?>
    <!--    san pham    -->
    <!-- content -->
    <div id="furniture-detail-container" class="mt-5">
        <div id="furniture-img">
            <img style="max-height: 480px; margin: auto;" src="../../admins/images/<?= $furniture['image'] ?>"/>
        </div>
        <div id="furniture-info">
            <div>
                <h1 class="">
                    <?= $furniture['name'] ?>
                </h1>
            </div>

            <div class="">
                <span class="text-muted">
                    <i class="fas fa-shopping-basket fa-sm mx-1">
                    </i>Đã bán ... sản phẩm
                </span>
            </div>

            <div class="">
                <span class=""><?= $furniture['price'] ?>đ</span>
            </div>

            <div class="">
                <dt class="">Danh mục:</dt>
                <dd class=""><?= $furniture['category_name'] ?></dd>

                <dt class="">Chất liệu:</dt>
                <dd class=""><?= $furniture['material'] ?></dd>

                <dt class="">Nhà sản xuất:</dt>
                <dd class=""><?= $furniture['producer_name'] ?></dd>
            </div>

            <div class="">
                <div class="">
                    <label class="">Số lượng</label>
                    <input type="number" placeholder="1">
                </div>
            </div>
            <a href="../carts/buy_now.php?id=<?= $id ?>" id="buy-now-btn" class="btn">Mua ngay</a>
            <a href="../carts/add_to_cart.php?id=<?= $id; ?>" id="add-to-cart-btn" class="btn">
                <i class="me-1 fa fa-shopping-basket"></i>Thêm vào giỏ</a>
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
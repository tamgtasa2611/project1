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

    <title>Giỏ hàng</title>
</head>
<body>
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
<!--Content-->
<form action="update_cart.php" method="post">
    <table class="table-bordered text-center w-100">
        <tr>
            <td colspan="2">Sản phẩm</td>
            <td>Đơn giá</td>
            <td>Số lượng</td>
            <td>Thành tiền</td>
            <td>Thao tác</td>
        </tr>
        <?php
        include_once("../../connect/open.php");
        //    truong hop chua co cart tren session
        $carts = array();
        //    thanh tien mac dinh
        $count_money = 0;
        //    lay cart tu session ve trong truong hop da co cart
        if (isset($_SESSION['cart'])) {
            $carts = $_SESSION['cart'];
        }
        foreach ($carts as $id => $quantity) {
            //    query lay thong tin sp theo id
            $sql = "SELECT * FROM furnitures WHERE id = '$id'";
            //        chay query
            $furnitures = mysqli_query($connect, $sql);
            //        hien thi thong tin san pham vua lay dc
            foreach ($furnitures as $furniture) {
                ?>
                <tr>
                    <td> <?= $furniture['name'] ?></td>
                    <td><img src="../../admins/images/<?= $furniture['image'] ?>" height="100px" width="100px" alt="">
                    </td>
                    <td> <?= number_format($furniture['price']) ?>d</td>
                    <td><input type="number" min="1" value="<?= $quantity; ?>" name="quantity[<?= $id; ?>]"></td>
                    <td> <?php
                        $money = $furniture['price'] * $quantity;
                        $count_money += $money;
                        echo number_format($money);
                        ?>d
                    </td>
                    <td><a href="delete_one_product.php?id=<?= $id ?>">delete one product</a></td>
                </tr>
                <?php
            }
        }
        ?>
        <tr>
            <td></td>
            <td><a href="order.php">Order</a></td>
            <td></td>
            <td>
                <button>Update quantity</button>
            </td>
            <td><span>Count: <?= number_format($count_money) ?>d</span> <br></td>
            <td><a href="delete_all_product.php">delete all</a></td>
        </tr>
    </table>
</form>


</body>
</html>

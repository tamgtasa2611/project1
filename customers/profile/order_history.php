<?php
//    chay session
session_start();
if (!isset($_SESSION['user-email'])) {
    header("Location: ../login_logout/login.php");
}
?>

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

    <title>Lịch sử đặt hàng</title>
</head>
<body>
<?php
include_once("../../connect/open.php");
$userId = $_SESSION['user-id'];
$sql = "SELECT orders.*, (SELECT SUM(quantity * price) FROM order_details 
            WHERE order_id = orders.id) AS total_cost
       FROM orders WHERE customer_id = '$userId'";
$orderLists = mysqli_query($connect, $sql);
include_once("../../connect/close.php");
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

<!-- Header -->
<?php
include("../../layout/header.php");
?>
<!-- Padding from header -->
<div id="about"></div>
<!-- Content -->
<table class="table">
    <thead>
    <tr>
        <td>ID don hang</td>
        <td>Ngay mua</td>
        <td>Trang thai</td>
        <td>Gia tien</td>
        <td>Chi tiet</td>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($orderLists as $orderList) {
        ?>
        <tr>
            <td><?= $orderList['id'] ?></td>
            <td><?= $orderList['date_buy'] ?></td>
            <td>
                <?php
                if ($orderList['status'] == 0) {
                    ?>
                    <a href="#"
                       class="btn btn-danger">
                        <span>Chờ xác nhận</span>
                    </a>
                    <?php
                } else if ($orderList['status'] == 1) {
                    ?>
                    <a href="#"
                       class="btn btn-success">
                        <span>Đã xác nhận</span>
                    </a>
                    <?php
                } else if ($orderList['status'] == 2) {
                    ?>
                    <a href="#"
                       class="btn btn-primary">
                        <span>Đang giao hàng</span>
                    </a>
                    <?php
                } else if ($orderList['status'] == 3) {
                    ?>
                    <a href="#"
                       class="btn btn-success">
                        <span>Đã giao hàng</span>
                    </a>
                    <?php
                } else if ($orderList['status'] == 4) {
                    ?>
                    <a href="#"
                       class="btn btn-danger">
                        <span>Đã hủy</span>
                    </a>
                    <?php
                }
                ?>
            </td>
            <td><?= currency_format($orderList['total_cost']) ?></td>
            <td>
                <a href="order_detail.php?id=<?= $orderList['id'] ?>" class="btn btn-primary">Xem</a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>

</body>
</html>

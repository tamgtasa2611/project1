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

    <title>Chi tiết đơn hàng</title>
</head>
<body>
<?php
include_once("../../connect/open.php");
$orderId = $_GET['id'];
$sql = "SELECT * FROM order_details WHERE order_id = '$orderId'";
$orderDetails = mysqli_query($connect, $sql);
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
$total_money = 0;
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
        <td>ID sp</td>
        <td>So luong</td>
        <td>Gia</td>
        <td>Thanh tien</td>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($orderDetails as $orderDetail) {
        ?>
        <tr>
            <td><?= $orderDetail['furniture_id'] ?></td>
            <td><?= $orderDetail['quantity'] ?></td>
            <td><?= currency_format($orderDetail['price']) ?></td>
            <td>
                <?php
                $sub_total = $orderDetail['quantity'] * $orderDetail['price'];
                $total_money += $sub_total;
                echo currency_format($sub_total);
                ?></td>
        </tr>
        <?php
    }
    ?>
    <tr>
        <td colspan="2"></td>
        <td>Tổng cộng:</td>
        <td><?= currency_format($total_money) ?></td>
    </tr>
    </tbody>
</table>


</body>
</html>

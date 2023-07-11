<?php
session_start();
if (!isset($_SESSION['email'])) {
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../main/css/bootstrap.css">
    <link rel="stylesheet" href="../../main/css/admin.css">
    <title>Chi tiết đơn hàng</title>
</head>
<body>
<?php
$id = $_GET['id'];
$total_money = 0;

include_once("../../connect/open.php");
$sql = "SELECT order_details.*, furnitures.image as furniture_image, furnitures.name as furniture_name
            FROM order_details
         INNER JOIN furnitures ON order_details.furniture_id = furnitures.id
         WHERE order_details.order_id = '$id'";
$order_details = mysqli_query($connect, $sql);
include_once("../../connect/close.php");
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

<div id="content">
    <div class="wrapper d-flex align-items-stretch">
        <div style="width: 250px"></div>
        <div class="position-fixed" style="height: 100%">
            <?php
            include("../../layout/admin_menu.php");
            ?>
        </div>
        <!--  content  -->
        <div class="content-container">
            <h4 class="content-heading">Chi tiết đơn hàng #<?= $id ?></h4>
            <table class="table table-striped table-hover table-borderless align-middle text-center nice-box-shadow">
                <thead class="text-white">
                <tr>
                    <th>Sản phẩm</th>
                    <th>Image</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                </tr>
                </thead>
                <tbody style="overflow-y: auto">
                <?php
                foreach ($order_details as $order_detail) {
                    ?>
                    <tr>
                        <td> <?= $order_detail['furniture_name'] ?> </td>
                        <td>
                            <img
                                    src="../images/<?= $order_detail['furniture_image'] ?>"
                                    alt=""
                                    width="100px"
                            >
                        </td>
                        <td> <?= $order_detail['quantity'] ?> </td>
                        <td> <?= currency_format($order_detail['price']) ?> </td>
                        <td> <?php
                            $sub_total = $order_detail['quantity'] * $order_detail['price'];
                            $total_money += $sub_total;
                            echo currency_format($sub_total);
                            ?></td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td colspan="3"></td>
                    <td>Tổng cộng:</td>
                    <td>
                        <?= currency_format($total_money) ?>
                    </td>
                </tr>
                </tbody>
            </table>
            <div style="margin-bottom: 40px">
                <a href="index.php" class="btn btn-primary nice-box-shadow">Quay lại</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
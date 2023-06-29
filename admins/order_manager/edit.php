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
$sql = "SELECT order_details.*, furnitures.image as furniture_image, furnitures.name as furniture_name,
            orders.status as order_status      
            FROM order_details
         INNER JOIN orders ON order_details.order_id = orders.id
         INNER JOIN furnitures ON order_details.furniture_id = furnitures.id
         WHERE order_details.order_id = '$id'";
$order_details = mysqli_query($connect, $sql);
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
            <h4 class="content-heading">Duyệt đơn hàng #<?= $id ?></h4>
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
                        <?php
                        echo currency_format($total_money);
                        ?>
                    </td>
                </tr>
                </tbody>
            </table>
            <div style="margin-bottom: 40px; display: flex; justify-content: space-between">
                <a href="index.php" class="btn btn-primary nice-box-shadow">Quay lại</a>
                <form action="update.php" method="post">
                    <?php
                    foreach ($order_details as $order_detail) {
                        ?>
                        <input class="d-none" name="order-id" value="<?= $order_detail['order_id'] ?>">
                        <?php
                    }
                    ?>
                    <select name="status" id="status" class="form-select">
                        <option value="0"
                            <?php
                            if ($order_detail['order_status'] == 0) {
                                echo 'selected';
                            }
                            ?>>Chờ xác nhận
                        </option>

                        <option value="1"
                            <?php
                            if ($order_detail['order_status'] == 1) {
                                echo 'selected';
                            }
                            ?>>Đã xác nhận
                        </option>

                        <option value="2"
                            <?php
                            if ($order_detail['order_status'] == 2) {
                                echo 'selected';
                            }
                            ?>>Đang giao hàng
                        </option>

                        <option value="3"
                            <?php
                            if ($order_detail['order_status'] == 3) {
                                echo 'selected';
                            }
                            ?>>Đã giao hàng
                        </option>

                        <option value="4"
                            <?php
                            if ($order_detail['order_status'] == 4) {
                                echo 'selected';
                            }
                            ?>>Đã hủy
                        </option>
                    </select>
                    <button href="" class="btn btn-primary nice-box-shadow">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
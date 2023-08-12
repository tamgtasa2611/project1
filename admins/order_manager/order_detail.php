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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../main/css/bootstrap.css">
    <link rel="stylesheet" href="../../main/css/admin.css">
    <title>Order details</title>
</head>
<body>
<?php
$id = $_GET['id'];
$total_money = 0;
$total_item = 0;
include_once("../../connect/open.php");
$sql = "SELECT order_details.*, furnitures.image as furniture_image, furnitures.name as furniture_name
            FROM order_details
         INNER JOIN furnitures ON order_details.furniture_id = furnitures.id
         WHERE order_details.order_id = '$id'";
$order_details = mysqli_query($connect, $sql);

//format usd
if (!function_exists('currency_format')) {
    function currency_format($number, $suffix = '$')
    {
        if (!empty($number)) {
            return "{$suffix}" . number_format($number, 2, ".");
        }
    }
}

$count_item = 0;
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
            <h4 class="content-heading">Order #<?= $id ?></h4>
            <table class="table table-striped table-hover table-borderless align-middle text-center nice-box-shadow">
                <thead class="text-white">
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total price</th>
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
                        <td>
                            <?php
                            $count_item += $order_detail['quantity'];
                            echo $order_detail['quantity']
                            ?> </td>
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
                    <td class="fw-bold">Total cost:</td>
                    <td class="fw-bold" style="color: #3e9c35">
                        <?= currency_format($total_money) ?>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="dashboard-block mb-4" style="height: 20vh">
                <div class="db-title">
                    Payment details
                </div>
                <div style="height: 100%; background-color: white; border-radius: 0px 0px 10px 10px; color: black"
                     class="d-flex align-items-center justify-content-between">
                    <?php
                    $orderQuery = "SELECT * FROM orders WHERE id = '$id'";
                    $payment_orders = mysqli_query($connect, $orderQuery);
                    foreach ($payment_orders as $order) {
                        ?>
                        <div class="d-flex justify-content-between w-100">
                            <div class="w-50">
                                <div>Receiver name: <?= $order['receiver_name'] ?></div>
                                <div>Receiver phone: <?= $order['receiver_phone'] ?> </div>
                                <div>Receiver address: <?= $order['receiver_address'] ?> </div>
                            </div>
                            <div class="w-50">
                                <div>Total items: <?= $count_item ?></div>
                                <div>Shipping cost: Free</div>
                                <div>Payment method: <?= $order['method'] ?></div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div style="margin-bottom: 40px; color: white" class="d-flex justify-content-between">
                <div>
                    <a onclick="window.history.go(-1)" class="btn btn-primary nice-box-shadow">Back</a>
                </div>
                <div>
                    <?php
                    $statusSql = "SELECT status FROM orders WHERE id = '$id'";
                    $orders = mysqli_query($connect, $statusSql);
                    foreach ($orders as $order) {
                        if ($order['status'] == 0) {
                            ?>
                            <div
                                    class="btn btn-danger nice-box-shadow">
                                <span>Pending</span>
                            </div>
                            <?php
                        } else if ($order['status'] == 1) {
                            ?>
                            <div
                                    class="btn btn-success nice-box-shadow">
                                <span>Confirmed</span>
                            </div>
                            <?php
                        } else if ($order['status'] == 2) {
                            ?>
                            <div
                                    class="btn btn-primary nice-box-shadow">
                                <span>Delivering</span>
                            </div>
                            <?php
                        } else if ($order['status'] == 3) {
                            ?>
                            <div
                                    class="btn btn-success nice-box-shadow">
                                <span>Completed</span>
                            </div>
                            <?php
                        } else if ($order['status'] == 4) {
                            ?>
                            <div
                                    class="btn btn-danger nice-box-shadow">
                                <span>Cancelled</span>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once("../../connect/close.php");
?>
</body>
</html>
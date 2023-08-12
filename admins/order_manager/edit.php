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
    <title> Update order details</title>
</head>
<body>
<?php
$id = $_GET['id'];
$total_money = 0;
$total_item = 0;
include_once("../../connect/open.php");
$sql = "SELECT order_details.*, furnitures.image as furniture_image, furnitures.name as furniture_name,
            orders.status as order_status      
            FROM order_details
         INNER JOIN orders ON order_details.order_id = orders.id
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
            <h4 class="content-heading">Update order #<?= $id ?></h4>
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
                        <td> <?php
                            $total_item += $order_detail['quantity'];
                            echo $order_detail['quantity'] ?> </td>
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
                                <div>Total items: <?= $total_item ?></div>
                                <div>Shipping cost: Free</div>
                                <div>Payment method: <?= $order['method'] ?></div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div style="margin-bottom: 40px; display: flex; justify-content: space-between; color: white">
                <a onclick="window.history.go(-1)" class="btn btn-primary nice-box-shadow">Back</a>
                <form action="update.php" method="post">
                    <?php
                    foreach ($order_details as $order_detail) {
                        ?>
                        <input class="d-none" type="hidden" name="order-id" value="<?= $order_detail['order_id'] ?>">
                        <?php
                    }
                    //neu status = 3 hoac 4 thi ko the huy
                    if ($order_detail['order_status'] == 0 or $order_detail['order_status'] == 1
                        or $order_detail['order_status'] == 2) {
                        ?>
                        <select name="status" id="status" class="form-select">

                            <option value="0"
                                <?php
                                if ($order_detail['order_status'] == 0) {
                                    echo 'selected';
                                }
                                ?>>Pending
                            </option>


                            <option value="1"
                                <?php
                                if ($order_detail['order_status'] == 1) {
                                    echo 'selected';
                                }
                                ?>>Confirmed
                            </option>

                            <option value="2"
                                <?php
                                if ($order_detail['order_status'] == 2) {
                                    echo 'selected';
                                }
                                ?>>Delivering
                            </option>

                            <option value="3"
                                <?php
                                if ($order_detail['order_status'] == 3) {
                                    echo 'selected';
                                }
                                ?>>Completed
                            </option>

                            <option value="4"
                                <?php
                                if ($order_detail['order_status'] == 4) {
                                    echo 'selected';
                                }
                                ?>>Cancelled
                            </option>
                        </select>
                        <button class="btn btn-primary nice-box-shadow">
                            Update
                        </button>
                        <?php
                    }
                    ?>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let clickClose = document.getElementById('click-close');
    let closeTarget = document.getElementById('close-target')

    function closeMes() {
        closeTarget.classList.add("d-none");
    }
</script>

<?php
include_once("../../connect/close.php");
?>
</body>
</html>
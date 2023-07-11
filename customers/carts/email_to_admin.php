<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="../../main/css/bootstrap.css">
    <title></title>

    <style>
        table, td, div, h1, p {font-family: Arial, sans-serif;}
    </style>
</head>

<body style="margin:0;padding:0;display: flex; justify-content: center">
<?php
include_once("../../connect/open.php");
$sql = "SELECT orders.*, customers.name as cus_name FROM orders 
         INNER JOIN customers ON orders.customer_id = customers.id
         WHERE orders.id = (SELECT MAX(orders.id) FROM orders)";
$orders = mysqli_query($connect, $sql);

$sql2 = "SELECT order_details.*, furnitures.name as furniture_name, furnitures.image as furniture_image  
            FROM order_details 
            INNER JOIN furnitures ON order_details.furniture_id = furnitures.id
            WHERE order_id = (SELECT MAX(id) FROM orders)";
$orderDetails = mysqli_query($connect, $sql2);

//format usd
if (!function_exists('currency_format')) {
    function currency_format($number, $suffix = '$')
    {
        if (!empty($number)) {
            return "{$suffix}" . number_format($number, 2, ".");
        }
    }
}

$total_items = 0;
$total_money = 0;
$total_cost = 0;
?>

<!--content-->
<div style="width: 600px; border: 1px solid #cccccc;
display: flex; justify-content: center; flex-direction: column; align-items: center">
    <div style="padding: 20px; width: 100%">
<!--
        <div style="display: flex; justify-content: center; padding: 40px 0px 60px 0px">
            <img src="../../main/media/images/logo.png" alt="" width="300" style="height:auto;" />
        </div>
-->
        <div>
            <h1 style="font-size:24px;margin-bottom: 20px;font-family:Arial,sans-serif;">
                A new order has been created
            </h1>
            <?php
            foreach ($orders as $order) {
            ?>
            <div style="display: flex; margin-bottom: 20px">
                <div style="width: 50%">
                    <div>
                        Order ID: <?= $order["id"] ?>
                    </div>
                    <div>
                        Date created: <?= $order["date_buy"] ?>
                    </div>
                    <div>
                        Customer: <?= $order["cus_name"] ?>
                    </div>
                </div>
                <div style="width: 50%">
                    <div>
                        Receiver name: <?= $order["receiver_name"] ?>
                    </div>
                    <div>
                        Receiver phone: <?= $order["receiver_phone"] ?>
                    </div>
                    <div>
                        Receiver address: <?= $order["receiver_address"] ?>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
            <div style="margin-bottom: 20px">
                <div style="display: flex; width: 100%; justify-content: center; text-align: center;
                    color: white; background-color: #303036; height: 48px; align-items: center !important;">
                    <div style="width: 300px">Product</div>
                    <div style="width: 90px">Price</div>
                    <div style="width: 72px">Quantity</div>
                    <div style="width: 95px">Total price</div>
                </div>
                <?php
                foreach ($orderDetails as $orderDetail) {
                ?>
                <div style="display: flex; width: 100%; justify-content: center; text-align: center;
                height: 100px; align-items: center !important; border: 1px solid #ccc">
                    <div style="width: 300px;">
                        <?= $orderDetail['furniture_name'] ?>
                    </div>
                    <div style="width: 90px">
                        <?= currency_format($orderDetail['price']) ?>
                    </div>
                    <div style="width: 72px">
                        <?php
                        $total_items += $orderDetail['quantity'];
                        echo $orderDetail['quantity'] ?>
                    </div>
                    <div style="width: 95px">
                        <?php
                        $sub_total = $orderDetail['quantity'] * $orderDetail['price'];
                        $total_money += $sub_total;
                        echo currency_format($sub_total);
                        ?>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>

            <div style="text-align: right; margin-bottom: 20px">
                <div>
                    Total items: <span style="font-weight: 700">
                        <?= $total_items ?>
                    </span>
                </div>
                <div>
                    Items price: <span style="font-weight: 700">
                        <?= currency_format($total_money) ?>
                    </span>
                </div>
                <div>
                    Shipping cost: <span style="font-weight: 700">
                        <?php
                    $shipping_cost = $total_money / 25;
                    echo currency_format($shipping_cost);
                        ?>
                    </span>
                </div>
                <div>
                    Payment method: <span style="font-weight: 700">Pay on delivery</span>
                </div>
                <div>
                    Total cost: <span style="font-weight: 700">
                        <?= currency_format($total_money + $shipping_cost) ?>
                    </span>
                </div>
            </div>
        </div>
        <div style="padding:30px; background:#303036; color: white;">
            © 2023 Copyright: Trademarks belonging to Beautiful House
        </div>
    </div>
</div>


<?php
include_once("../../connect/close.php");
?>
</body>
</html>

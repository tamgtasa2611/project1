<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
    <style>
        table, td, div, h1, p {
            font-family: Arial, sans-serif;
        }
    </style>
</head>

<body style="margin:0;padding:0;">

<?php
include_once("../../../connect/open.php");
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

<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
    <tr>
        <td align="center" style="padding:0;">
            <table role="presentation"
                   style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                <tr>
                    <td align="center" style="padding:40px 0 30px 0;background: white;">
                        <img src="https://i.imgur.com/8bAs278.png" alt="" width="300"
                             style="height:auto;display:block;"/>
                    </td>
                </tr>
                <tr>
                    <td style="padding:36px 30px 42px 30px;">
                        <table role="presentation"
                               style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                            <tr>
                                <td style="padding:0 0 36px 0;color:#153643;">
                                    <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">A new
                                        order has been created</h1>
                                    <table role="presentation" style="margin:0 0 12px 0;font-size:16px; width: 100%">
                                        <?php
                                        foreach ($orders as $order) {
                                            ?>
                                            <tr style="height: 40px">
                                                <td style="width: 260px">
                                                    Order ID: <?= $order["id"] ?>
                                                </td>
                                                <td style="width: 20px"></td>
                                                <td>
                                                    Receiver name: <?= $order["receiver_name"] ?>
                                                </td>
                                            </tr>
                                            <tr style="height: 40px">
                                                <td style="width: 260px">
                                                    Date created: <?= $order["date_buy"] ?>
                                                </td>
                                                <td style="width: 20px"></td>
                                                <td>
                                                    Receiver phone: <?= $order["receiver_phone"] ?>
                                                </td>
                                            </tr>
                                            <tr style="height: 40px">
                                                <td style="width: 260px">
                                                    Customer: <?= $order["cus_name"] ?>
                                                </td>
                                                <td style="width: 20px"></td>
                                                <td>
                                                    Receiver address: <?= $order["receiver_address"] ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:0;">
                                    <table role="presentation"
                                           style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                        <tr>
                                            <td style="width:260px;padding:0;vertical-align:top;color:#153643;">
                                                <table role="presentation"
                                                       style="width: 100%; text-align: center; border: 1px solid #303036; border-collapse: collapse;"
                                                       border="1px">
                                                    <thead style=" color: white; background-color: #ff9000; font-style: italic; font-size: 17px">
                                                    <th style="width: 45%; padding: 12px;">Products</th>
                                                    <th style="width: 15%">Price</th>
                                                    <th style="width: 20%">Quantity</th>
                                                    <th style="width: 20%">Total price</th>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    foreach ($orderDetails as $orderDetail) {
                                                        ?>
                                                        <tr>
                                                            <td style="width: 45%; padding: 8px">
                                                                <?= $orderDetail['furniture_name'] ?>
                                                            </td>
                                                            <td style="width: 15%; color: #3e9c35">
                                                                <?= currency_format($orderDetail['price']) ?>
                                                            </td>
                                                            <td style="width: 20%; color: dodgerblue">
                                                                <?php
                                                                $total_items += $orderDetail['quantity'];
                                                                echo $orderDetail['quantity'] ?>
                                                            </td>
                                                            <td style="width: 20%; color: #3e9c35; font-weight: 600">
                                                                <?php
                                                                $sub_total = $orderDetail['quantity'] * $orderDetail['price'];
                                                                $total_money += $sub_total;
                                                                echo currency_format($sub_total);
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 36px 0px 0px 0px">
                                    <table role="presentation"
                                           style="width: 100%;border-collapse:collapse;border:0;border-spacing:0;font-size:16px;text-align: right">
                                        <tr>
                                            <td style="width: 200px"></td>
                                            <td>
                                                <p style="margin: 8px 0px; font-style: italic; display: block">Total
                                                    items: <span style="color: dodgerblue"><?= $total_items ?></span>
                                                </p>
                                                <p style="margin: 8px 0px; font-style: italic; display: block">Items
                                                    price: <span
                                                            style=" color: #3e9c35"><?= currency_format($total_money) ?></span>
                                                </p>
                                                <p style="margin: 8px 0px; font-style: italic; display: block">Shipping
                                                    cost: <span style=" color: #3e9c35">
                                                    Free</p>
                                                <p style="margin: 8px 0px; font-style: italic; display: block">Payment
                                                    method: <span style="color: dodgerblue">
                                                        <?php
                                                        foreach ($orders as $order) {
                                                            echo $order['method'];
                                                        }
                                                        ?>
                                                    </span></p>
                                                <p style="font-style: italic; display: block; font-size: 20px; font-weight: 600">
                                                    Total cost: <span style="color: #3e9c35; font-weight: 700">
                                                        <?= currency_format($total_money) ?>
                                                    </span></p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding:30px;background:#303036;">
                        <table role="presentation"
                               style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                            <tr>
                                <td style="padding:0;width:50%;" align="left">
                                    <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                                        © 2023 Copyright: Trademarks belonging to Beautiful House
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php
include_once("../../../connect/close.php");
?>
</body>
</html>
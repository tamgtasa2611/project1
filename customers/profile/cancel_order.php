<?php
$orderId = $_GET['id'];
include_once("../../connect/open.php");
$sql = "UPDATE orders SET status = '4' WHERE id = '$orderId'";
mysqli_query($connect, $sql);
include_once("../../connect/close.php");
header("Location: order_history.php");
<?php
$orderId = $_GET['id'];
include_once("../../connect/open.php");
$sql = "UPDATE orders SET status = '4' WHERE id = '$orderId'";
mysqli_query($connect, $sql);
include_once("../../connect/close.php");
session_start();
$_SESSION['cancel_order'] = 1;
header("Location: order_history.php");
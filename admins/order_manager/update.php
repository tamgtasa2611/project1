<?php
session_start();
$orderId = $_POST['order-id'];
$orderStatus = $_POST['status'];
include_once("../../connect/open.php");
$sql = "UPDATE orders SET status = '$orderStatus' WHERE id = '$orderId'";
mysqli_query($connect, $sql);
include_once("../../connect/close.php");
if (isset($_SESSION['direction'])) {
    header('Location: ' . $_SESSION['direction']);
} else {
    header('Location: index.php');
}

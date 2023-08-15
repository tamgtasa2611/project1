<?php
session_start();
$orderId = $_POST['order-id'];
$orderStatus = $_POST['status'];
$admin_email = $_SESSION['email'];
include_once("../../connect/open.php");
$adminSql = "SELECT * FROM admins WHERE email = '$admin_email'";
$admins = mysqli_query($connect, $adminSql);
$admin_id = "";

foreach ($admins as $admin) {
    $admin_id = $admin['id'];
}

$sql = "UPDATE orders SET status = '$orderStatus', admin_id = '$admin_id' WHERE id = '$orderId'";
mysqli_query($connect, $sql);

include_once("../../connect/close.php");
$_SESSION['update-status'] = 1;
header("location: index.php");

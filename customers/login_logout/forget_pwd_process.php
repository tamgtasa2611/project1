<?php
session_start();
//
$userEmail = $_POST['user-email'];
//
include_once '../../connect/open.php';
$sql = "SELECT *, COUNT(id) as count_account FROM customers 
                    WHERE email = '$userEmail'";
$accounts = mysqli_query($connect, $sql);
include_once("../../connect/close.php");
foreach ($accounts as $account) {
    $userId = $account['id'];
    $count_user_account = $account['count_account'];
}
if ($count_user_account == 0) {
    $_SESSION['forget-pwd'] = 1;
    header("Location: forget_pwd.php");
} else {
    $_SESSION['forget-pwd-email'] = $userEmail;
    header("Location: send_email_to_customer.php");
}
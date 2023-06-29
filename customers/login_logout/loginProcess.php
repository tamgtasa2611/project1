<?php
session_start();
unset($_SESSION['error-msg']);
//
$userEmail = $_POST['user-email'];
$userPassword = $_POST['user-password'];
//
include_once '../../connect/open.php';
$sql = "SELECT *, COUNT(id) as count_account FROM customers 
                    WHERE email = '$userEmail' AND password = '$userPassword'";
$accounts = mysqli_query($connect, $sql);
include_once("../../connect/close.php");
foreach ($accounts as $account) {
    $userId = $account['id'];
    $count_user_account = $account['count_account'];
}
if ($count_user_account == 0) {
    $_SESSION['error-msg'] = 1;
    header("Location: login.php");
} else {
    $_SESSION['user-id'] = $userId;
    $_SESSION['user-email'] = $userEmail;
    header("Location: ../start/index.php");
}
<?php
session_start();
$email = $_POST['email'];
$password = $_POST['password'];
include_once '../../connect/open.php';
$sql = "SELECT *, COUNT(id) as count_account FROM admins 
                    WHERE email = '$email' AND password = '$password'";
$accounts = mysqli_query($connect, $sql);
include_once("../../connect/close.php");
foreach ($accounts as $account) {
    $id = $account['id'];
    $count_account = $account['count_account'];
}
if ($count_account == 0) {
    $_SESSION['failed'] = 1;
    header("Location: login.php");
} else {
    $_SESSION['id'] = $id;
    $_SESSION['email'] = $email;
    header("Location: ../manager/index.php");
}
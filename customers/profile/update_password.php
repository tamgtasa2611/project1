<?php
session_start();
//old password does not match
$_SESSION['cpwd-error'] = 0;
//new password === old password
$_SESSION['npwd-error'] = 0;
//change pwd status
$_SESSION['change-success'] = 0;

$userId = $_SESSION['user-id'];
$cpassword = $_POST['cpwd'];
$npassword = $_POST['npwd'];

include_once("../../connect/open.php");
$sql = "SELECT password FROM customers WHERE id = '$userId'";
$passwords = mysqli_query($connect, $sql);

foreach ($passwords as $password) {
    //old password does not match
    if ($cpassword != $password['password']) {
        $_SESSION['cpwd-error'] = 1;
        header("Location: change_password.php");
    } //new password === old password
    else if ($npassword === $cpassword) {
        $_SESSION['npwd-error'] = 1;
        header("Location: change_password.php");
    } //no error
    else {
        $changePasswordSql = "UPDATE customers SET password = '$npassword' WHERE id = '$userId'";
        mysqli_query($connect, $changePasswordSql);
        $_SESSION['change-success'] = 1;
        header("Location: change_password.php");
    }
}
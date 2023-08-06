<?php
session_start();
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$address = $_POST['address'];
include_once '../../connect/open.php';
if ($gender == 'Male') {
    $gender = 1;
} else {
    $gender = 0;
}
$sql = "UPDATE customers SET name = '$name', email = '$email', password = '$password',
                     phone = '$phone', gender = '$gender', address = '$address'
                     WHERE id = '$id'";
mysqli_query($connect, $sql);
include_once '../../connect/close.php';
$_SESSION['ad-edit'] = 1;
header('Location: index.php');
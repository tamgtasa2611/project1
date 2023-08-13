<?php
//    chay session
session_start();
if (!isset($_SESSION['user-id'])) {
    header("Location: ../login_logout/login.php");
}

//lay du lieu
$id = $_SESSION['user-id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$address = $_POST['address'];

include_once("../../connect/open.php");

if ($gender == 'male') {
    $gender = 1;
} else {
    $gender = 0;
}

$sql = "UPDATE customers SET name = '$name', email = '$email', phone = '$phone', 
                                 gender = '$gender', address = '$address'
                            WHERE id = '$id'";
mysqli_query($connect, $sql);
include_once '../../connect/close.php';

$_SESSION['update_profile'] = 1;
header("Location: index.php");

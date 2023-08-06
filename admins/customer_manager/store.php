<?php
session_start();
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
$sql = "INSERT INTO customers(name, email, password, phone, gender, address) VALUES 
            ('$name', '$email', '$password', '$phone', '$gender', '$address')";
mysqli_query($connect, $sql);
include_once '../../connect/close.php';
$_SESSION['ad-create'] = 1;
header('Location: index.php');
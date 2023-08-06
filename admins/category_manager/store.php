<?php
session_start();
$name = $_POST['name'];
include_once '../../connect/open.php';
$sql = "INSERT INTO categories(name) VALUES ('$name')";
mysqli_query($connect, $sql);
include_once '../../connect/close.php';
$_SESSION['ad-create'] = 1;
header('Location: index.php');
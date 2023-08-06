<?php
session_start();
$id = $_POST['id'];
$name = $_POST['name'];
include_once '../../connect/open.php';
$sql = "UPDATE producers SET name = '$name' WHERE id = '$id'";
mysqli_query($connect, $sql);
include_once '../../connect/close.php';
$_SESSION['ad-edit'] = 1;
header('Location: index.php');
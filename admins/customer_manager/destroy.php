<?php
$id = $_GET['id'];
include_once '../../connect/open.php';
$sql = "DELETE FROM customers WHERE id = '$id'";
mysqli_query($connect, $sql);
include_once '../../connect/close.php';
header('Location: index.php');
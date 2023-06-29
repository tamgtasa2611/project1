<?php
$name = $_POST['name'];
include_once '../../connect/open.php';
$sql = "INSERT INTO categories(name) VALUES ('$name')";
mysqli_query($connect, $sql);
include_once '../../connect/close.php';
header('Location: index.php');
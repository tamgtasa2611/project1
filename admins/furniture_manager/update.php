<?php
session_start();
$id = $_POST['id'];
$name = $_POST['name'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$material = $_POST['material'];
$length = $_POST['length'];
$width = $_POST['width'];
$height = $_POST['height'];
$room = $_POST['room'];
$category_id = $_POST['category_id'];
$producer_id = $_POST['producer_id'];
$image = $_FILES['image']['name'];

include_once '../../connect/open.php';

$sql = "UPDATE furnitures SET name = '$name', quantity = '$quantity', price = '$price', material = '$material', 
                      length = '$length', width = '$width', height = '$height', room = '$room', 
                      category_id = '$category_id', producer_id = '$producer_id', image = '$image'
                        WHERE id = '$id'";

mysqli_query($connect, $sql);
include_once("../../connect/close.php");
if (!file_exists("../images/" . $image)) {
    $path = $_FILES['image']['tmp_name'];
    move_uploaded_file($path, "../images/" . $image);
}

$_SESSION['ad-edit'] = 1;
header("Location: index.php");

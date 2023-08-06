<?php
session_start();
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
//lay ten anh
$image = $_FILES['image']['name'];

include_once '../../connect/open.php';

$sql = "INSERT INTO furnitures(name, quantity, price, material, 
                       length, width, height, room, category_id, producer_id, image)
VALUES ('$name', '$quantity', '$price', '$material', 
        '$length', '$width', '$height', '$room', '$category_id', '$producer_id', '$image')";

mysqli_query($connect, $sql);
include_once("../../connect/close.php");
//luu anh tu vi tri hien tai cua anh vao thu muc image
//kiem tra anh da ton tai hay chua
if (!file_exists("../images/" . $image)) {
    //lay duong dan hien tai cua anh
    $path = $_FILES['image']['tmp_name'];
    //luu anh tu duong dan hien tai vao folder
    move_uploaded_file($path, "../images/" . $image);
}

$_SESSION['ad-create'] = 1;
header("Location: index.php");
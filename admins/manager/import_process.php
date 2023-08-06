<?php
session_start();
$furniture_id = $_POST['furniture-id'];
$quantity = $_POST['quantity'];

if ($furniture_id == 0) {
    $_SESSION['import'] = 0;
    header('Location: import.php');
} else {
    include_once("../../connect/open.php");
    $sql = "UPDATE furnitures SET quantity = (quantity + '$quantity') WHERE id = '$furniture_id'";
    mysqli_query($connect, $sql);
    include_once("../../connect/close.php");
    $_SESSION['import'] = 1;
    header('Location: import.php');
}
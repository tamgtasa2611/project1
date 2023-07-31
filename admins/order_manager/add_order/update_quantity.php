<?php
session_start();
//lay mang quantity gom id san pham va so luong
$quantities = $_POST['quantity'];


//foreach lay id va quantity
foreach ($quantities as $id => $quantity) {
    //so luong < 0
    if ($quantity < 1) {
        header("Location: ../create.php");
    } else {
        //update quantity cua sp co id tuong ung tren cart
        $_SESSION['admin_cart'][$id] = $quantity;
    }
}

//Quay ve trang gio hang
header("Location: ../create.php");

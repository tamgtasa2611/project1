<?php
//    mo session
session_start();
$_SESSION['ad-add-success'] = 0;
//    lay id san pham them vao cart
$id = $_GET['id'];
//    kiem tra da ton tai cart tren session chua
if (isset($_SESSION['admin_cart'])) {
//          kiem tra xem da ton tai sp tren cart hay chua
    if (isset($_SESSION['admin_cart'][$id])) {
//            +1
        $_SESSION['admin_cart'][$id]++;
    } else {
//            them sp len cart voi quantity = 1
        $_SESSION['admin_cart'][$id] = 1;
    }
} else {
//        tao cart
    $_SESSION['admin_cart'] = array();
//        them sp co id len cart voi quantity = 1
    $_SESSION['admin_cart'][$id] = 1;
}

//thong bao add success
$_SESSION['ad-add-success'] = 1;

header('Location: ../create.php');
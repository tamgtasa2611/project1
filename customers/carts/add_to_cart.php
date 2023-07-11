<?php
//    mo session
session_start();
$_SESSION['add-success'] = 0;
//    lay id san pham them vao cart
$id = $_GET['id'];
//    kiem tra da ton tai cart tren session chua
if (isset($_SESSION['cart'])) {
//          kiem tra xem da ton tai sp tren cart hay chua
    if (isset($_SESSION['cart'][$id])) {
//            +1
        $_SESSION['cart'][$id]++;
    } else {
//            them sp len cart voi quantity = 1
        $_SESSION['cart'][$id] = 1;
    }
} else {
//        tao cart
    $_SESSION['cart'] = array();
//        them sp co id len cart voi quantity = 1
    $_SESSION['cart'][$id] = 1;
}

//thong bao add success
$_SESSION['add-success'] = 1;

//    ve trang truoc do
header('Location: ' . $_SERVER['HTTP_REFERER']);
//header("location:javascript://history.go(-1)");
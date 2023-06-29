<?php
session_start();
//lay id cua san pham can xoa
$id = $_GET['id'];
//xoa sp tren cart
unset($_SESSION['cart'][$id]);
//quay lai trang cart
header("Location: index.php");
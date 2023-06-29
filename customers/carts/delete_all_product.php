<?php
session_start();
//xoa sp tren cart
unset($_SESSION['cart']);
//quay lai trang cart
header("Location: index.php");
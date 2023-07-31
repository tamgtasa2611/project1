<?php
session_start();
//xoa sp tren cart
unset($_SESSION['admin_cart']);
//quay lai trang cart
header("Location: ../create.php");
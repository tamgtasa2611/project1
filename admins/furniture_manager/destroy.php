<?php
session_start();
$id = $_GET['id'];
include_once("../../connect/open.php");
$sql = "DELETE FROM furnitures WHERE id = '$id'";
mysqli_query($connect, $sql);
include_once("../../connect/close.php");
$_SESSION['ad-destroy'] = 1;
header('Location: index.php');
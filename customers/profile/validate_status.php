<?php
    session_start();
    $order_id = $_GET['id'];
    include_once("../../connect/open.php");
    $statusQuery = "SELECT status FROM orders WHERE id = '$order_id'";
    $status_orders = mysqli_query($connect, $statusQuery);
    foreach ($status_orders as $status_order) {
        if($status_order['status'] == 0) {
            header("Location: cancel_order.php?id=$order_id");
        } elseif ($status_order['status'] == 4) {
            $_SESSION['already-cancel'] = 1;
            header("Location: order_detail.php?id=$order_id");
        } else {
            $_SESSION['cant-cancel'] = 1;
            header("Location: order_detail.php?id=$order_id");
        }
    }
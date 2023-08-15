<?php
//    chay session
session_start();
//mo ket noi
include_once("../../connect/open.php");

//kiem tra da login chua
if (!isset($_SESSION['user-email'])) {
    header("Location: ../login_logout/login.php");
} else {
    //lay du lieu luu vao bang orders
    //lay ngay hien tai
    $dateBuy = date('Y-m-d');
    //lay status (status mac dinh la 0 tuong ung trang thai xac nhan don hang)
    $status = 0;
    //lay id cua customer
    $customer_id = $_SESSION['user-id'];

//    thong tin nhan hang
    $re_name = "";
    $re_phone = "";
    $re_address = "";
    $re_sql = "SELECT name, phone, address FROM customers WHERE id = '$customer_id'";
    $re_infos = mysqli_query($connect, $re_sql);
    foreach ($re_infos as $re_info) {
        $re_name = $re_info['name'];
        $re_phone = $re_info['phone'];
        $re_address = $re_info['address'];
    }

    //phuong thuc thanh toan
    $method = "VNPAY";
    if ($_POST['payment-method'] == 0) {
        $method = "Pay on delivery";
    }
    if (isset($_SESSION['payment-method'])) {
        $method = "VNPAY";
        $status = 1;
    }

    //query insert vao bang orders
    $sqlInsertOrder =
        "INSERT INTO orders(date_buy, status, customer_id, receiver_name, receiver_phone, receiver_address, method) 
        VALUES ('$dateBuy', '$status', '$customer_id', '$re_name', '$re_phone', '$re_address', '$method')";
    mysqli_query($connect, $sqlInsertOrder);

    //query la order_id lon nhat cua customer dang login hien tai
    $sqlMaxOrderID = "SELECT MAX(id) as max_order_id FROM orders WHERE customer_id = '$customer_id'";
    $maxOrderIds = mysqli_query($connect, $sqlMaxOrderID);
    //lay max_order_id
    foreach ($maxOrderIds as $maxOrderId) {
        $order_id = $maxOrderId['max_order_id'];
    }

    //lay gio hang ve
    $cart = $_SESSION['cart'];
    foreach ($cart as $product_id => $quantity) {
        //lay du lieu de insert vao bang order_details
        //query de lay price cua furniture
        $sqlSelectPrice = "SELECT price FROM furnitures WHERE id = '$product_id'";
        //chay query lay price
        $furniturePrices = mysqli_query($connect, $sqlSelectPrice);
        //foreach de lay price
        foreach ($furniturePrices as $furniturePrice) {
            $price = $furniturePrice['price'];
        }
        //query insert du lieu len bang order_details
        $sqlInsertOrderDetail = "INSERT INTO order_details VALUES
                              ('$order_id', '$product_id', '$price', '$quantity')";
        //chay query insert order_details
        mysqli_query($connect, $sqlInsertOrderDetail);
        //query -1 stock quantity furniture
        $sqlStock = "UPDATE furnitures SET quantity = quantity - '$quantity' WHERE id = '$product_id'";
        mysqli_query($connect, $sqlStock);
    }

    //xoa cart
    unset($_SESSION['cart']);
    unset($_SESSION['payment-method']);
    //quay ve trang gio hang
    header("Location: send_email_to_admin.php");
}



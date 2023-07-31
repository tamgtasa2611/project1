<?php
//    chay session
session_start();

//kiem tra da login chua
if (!isset($_SESSION['email'])) {
    header("Location: ../../login_logout/login.php");
} else {
    //lay du lieu luu vao bang orders
    //lay ngay hien tai
    $dateBuy = date('Y-m-d');
    //lay status (status mac dinh la 0 tuong ung trang thai xac nhan don hang)
    $status = 0;
    //lay id cua customer
    $customer_id = $_POST['customer'];
    //thong tin nhan hang
    $re_name = $_POST['re-name'];
    $re_phone = $_POST['re-phone'];
    $re_address = $_POST['re-address'];

    //mo ket noi
    include_once("../../../connect/open.php");

    //query insert vao bang orders
    $sqlInsertOrder =
        "INSERT INTO orders(date_buy, status, customer_id, receiver_name, receiver_phone, receiver_address) 
        VALUES ('$dateBuy', '$status', '$customer_id', '$re_name', '$re_phone', '$re_address')";
    mysqli_query($connect, $sqlInsertOrder);

    //query la order_id lon nhat cua customer dang login hien tai
    $sqlMaxOrderID = "SELECT MAX(id) as max_order_id FROM orders WHERE customer_id = '$customer_id'";
    $maxOrderIds = mysqli_query($connect, $sqlMaxOrderID);
    //lay max_order_id
    foreach ($maxOrderIds as $maxOrderId) {
        $order_id = $maxOrderId['max_order_id'];
    }

    //lay gio hang ve
    $cart = $_SESSION['admin_cart'];
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
    unset($_SESSION['admin_cart']);

    include_once("../../../connect/close.php");

    $_SESSION['send-email-to-user'] = $_POST['customer'];
    //quay ve trang gio hang
    header("Location: send_email_to_admin.php");
}



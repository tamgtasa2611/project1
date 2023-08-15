<?php
//    chay session
session_start();
if (!isset($_SESSION['user-id'])) {
    header("Location: ../login_logout/login.php");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- bootstrap file link -->
    <link rel="stylesheet" href="../../main/css/bootstrap.css">
    <script src="../../main/js/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous"></script>
    <!-- header css file link -->
    <link rel="stylesheet" href="../../main/css/header_style.css">
    <!--  main css file link  -->
    <link rel="stylesheet" href="../../main/css/main_style.css">
    <!--    profile css file link   -->
    <link rel="stylesheet" href="../../main/css/profile.css">

    <title>Order details - Beautiful House</title>
</head>
<body>
<?php
include_once("../../connect/open.php");
$orderId = $_GET['id'];
$sql = "SELECT order_details.*, furnitures.name as furniture_name, furnitures.image as furniture_image  
        FROM order_details 
        INNER JOIN furnitures ON order_details.furniture_id = furnitures.id
        WHERE order_id = '$orderId'";
$orderDetails = mysqli_query($connect, $sql);

//format usd
if (!function_exists('currency_format')) {
    function currency_format($number, $suffix = '$')
    {
        if (!empty($number)) {
            return "{$suffix}" . number_format($number, 2, ".");
        }
    }
}
$count_item = 0;
$total_money = 0;
?>

<!-- Header -->
<?php
include("../../layout/header.php");
?>
<!-- Padding from header -->
<div id="about"></div>

<!-- Content -->

<div id="main-container" class="mt-5">
    <div id="left-container">
        <?php
        include_once("../../layout/customer_profile.php");
        ?>

    </div>

    <div id="right-container" class="position-relative">
        <div style="height: auto; margin: 40px">
            <div>
                <div class="d-flex justify-content-between">
                    <div>
                        <h2>
                            Order details
                        </h2>
                        <h4 style="color: slategray; margin-bottom: 30px">
                            #<?= $orderId ?>
                        </h4>
                    </div>
                    <?php
                    if (!isset($_SESSION['cant-cancel'])) {
                        $_SESSION['cant-cancel'] = 0;
                    }
                    if ($_SESSION['cant-cancel'] === 1) {
                        echo '<div id="close-target" class="alert alert-danger position-absolute" role="alert"
        style="right: 25%; width: 482px">
        You cannot cancel this order! Its status has been changed
        <i id="click-close" class="fa-solid fa-x" style="font-size: 12px; padding: 8px; margin-left: 20px" 
        onclick="closeMes()"></i>
        </div>';
                        $_SESSION['cant-cancel'] = 0;
                    }

                    if (!isset($_SESSION['already-cancel'])) {
                        $_SESSION['already-cancel'] = 0;
                    }
                    if ($_SESSION['already-cancel'] === 1) {
                        echo '<div id="close-target" class="alert alert-danger position-absolute" role="alert"
        style="right: 32%; width: 348px">
        This order has already been cancelled!
        <i id="click-close" class="fa-solid fa-x" style="font-size: 12px; padding: 8px; margin-left: 20px" 
        onclick="closeMes()"></i>
        </div>';
                        $_SESSION['already-cancel'] = 0;
                    }
                    ?>
                    <div>
                        <?php
                        $orderStatusQuery = "SELECT status FROM orders WHERE id = '$orderId'";
                        $statusOrders = mysqli_query($connect, $orderStatusQuery);
                        foreach ($statusOrders as $statusOrder) {
                            if ($statusOrder['status'] == 0) {
                                ?>
                                <a href="#"
                                   class="btn btn-danger">
                                    <span>Pending</span>
                                </a>
                                <?php
                            } else if ($statusOrder['status'] == 1) {
                                ?>
                                <a href="#"
                                   class="btn btn-success">
                                    <span>Confirmed</span>
                                </a>
                                <?php
                            } else if ($statusOrder['status'] == 2) {
                                ?>
                                <a href="#"
                                   class="btn btn-primary">
                                    <span>Delivering</span>
                                </a>
                                <?php
                            } else if ($statusOrder['status'] == 3) {
                                ?>
                                <a href="#"
                                   class="btn btn-success">
                                    <span>Completed</span>
                                </a>
                                <?php
                            } else if ($statusOrder['status'] == 4) {
                                ?>
                                <a href="#"
                                   class="btn btn-danger">
                                    <span>Cancelled</span>
                                </a>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <hr>

                <div style="margin-top: 28px; width: 100%; border: 1px solid lightgrey">
                    <div class="d-flex justify-content-center text-center align-items-center"
                         style="background-color: #303036; color: #fff; height: 60px">
                        <div style="width: 500px">Product</div>
                        <div style="width: 150px">Price</div>
                        <div style="width: 100px">Quantity</div>
                        <div style="width: 153px">Total cost</div>
                    </div>

                    <div style="height: 280px; display: block; overflow-y: scroll;">
                        <?php
                        foreach ($orderDetails as $orderDetail) {
                            ?>
                            <div class="d-flex justify-content-center text-center align-items-center"
                                 style="padding: 20px 0px;">
                                <div style="width: 500px" class="d-flex  align-items-center">
                                    <div class="w-50"><?= $orderDetail['furniture_name'] ?></div>
                                    <div class="w-50">
                                        <img
                                                src="../../admins/images/<?= $orderDetail['furniture_image'] ?>" alt=""
                                                height="100px">
                                    </div>
                                </div>
                                <div style="width: 150px">
                                    <?= currency_format($orderDetail['price']) ?>
                                </div>
                                <div style="width: 100px">
                                    <?= $orderDetail['quantity'] ?>
                                </div>
                                <div style="width: 136px">
                                    <?php
                                    $count_item += $orderDetail['quantity'];
                                    $sub_total = $orderDetail['quantity'] * $orderDetail['price'];
                                    $total_money += $sub_total;
                                    echo currency_format($sub_total);
                                    ?>
                                </div>
                            </div>

                            <?php
                        }
                        ?>

                    </div>

                </div>

                <div class="d-flex justify-content-between" style="margin-top: 28px;">
                    <a href="order_history.php" class="btn btn-primary"
                       style="font-size: 16px; padding-left :24px; padding-right: 24px">
                        Back
                    </a>
                    <a href="#payment-modal" class="btn btn-success"
                       style="font-size: 16px; padding-left :24px; padding-right: 24px">
                        Payment details
                    </a>
                    <?php
                    foreach ($statusOrders as $statusOrder) {
                        if ($statusOrder['status'] == 0) {
                            ?>
                            <a href="#cancel-modal" class="btn btn-danger"
                               style="font-size: 16px; padding-left :24px; padding-right: 24px">
                                Cancel order
                            </a>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once("../../layout/footer.php");
?>

<!--modal payment details-->
<div id="payment-modal" class="my-modal">
    <div class="modal__content">
        <h1>Payment details</h1>
        <hr>
        <?php
        $orderQuery = "SELECT * FROM orders WHERE id = '$orderId'";
        $orders = mysqli_query($connect, $orderQuery);
        foreach ($orders as $order) {
            ?>
            <div class="d-flex justify-content-between w-100">
                <div class="w-50">
                    <div>Receiver name: <?= $order['receiver_name'] ?></div>
                    <div>Receiver phone: <?= $order['receiver_phone'] ?> </div>
                    <div>Receiver address: <?= $order['receiver_address'] ?> </div>
                </div>
                <div class="w-50">
                    <div>Total items: <?= $count_item ?></div>
                    <div>Shipping cost: Free</div>
                    <div>Payment method: <?= $order['method'] ?></div>
                </div>
            </div>
            <?php
        }
        ?>
        <hr>
        <div class="modal__footer">
            <h3 class="fst-italic fw-bold">Total cost: <span
                        style="color: #3e9c35"><?= currency_format($total_money) ?></span></h3>
        </div>
        <a href="#" class="modal__close">&times;</a>
    </div>
</div>
<!--end modal payment-->

<!--          modal  cancel        -->
<div id="cancel-modal" class="my-modal">
    <div class="modal__content">
        <h2>Confirm cancellation</h2>

        <p>
            Do you really want to cancel this order?
        </p>

        <div class="modal__footer">
            <div>
                <a href="validate_status.php?id=<?= $orderId ?>" class="btn btn-danger" style="font-size: 16px;">
                    Cancel order</a>
            </div>
        </div>

        <a href="#" class="modal__close">&times;</a>
    </div>
</div>
<!--          end modal          -->
<?php
include_once("../../connect/close.php");
?>

<script>
    let clickClose = document.getElementById('click-close');
    let closeTarget = document.getElementById('close-target')

    function closeMes() {
        closeTarget.classList.add("d-none");
    }
</script>
</body>
</html>

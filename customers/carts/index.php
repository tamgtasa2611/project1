<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- bootstrap file link -->
    <link rel="stylesheet" href="../../main/css/bootstrap.css">
    <!-- header css file link -->
    <link rel="stylesheet" href="../../main/css/header_style.css">
    <!--  main css file link  -->
    <link rel="stylesheet" href="../../main/css/main_style.css">
    <!--  cart css file link -->
    <link rel="stylesheet" href="../../main/css/cart.css">

    <title>My cart - Beautiful House</title>
</head>
<body>
<!-- Header -->
<?php
include("../../layout/header.php");

//format USD $$$
if (!function_exists('currency_format')) {
    function currency_format($number, $suffix = '$')
    {
        if (!empty($number)) {
            return "{$suffix}" . number_format($number, 2, ".", ",");
        }
    }
}
?>

<?php
include_once("../../connect/open.php");
//    truong hop chua co cart tren session
$carts = array();
//    thanh tien mac dinh
$total_cost = 0;
//    lay cart tu session ve trong truong hop da co cart
if (isset($_SESSION['cart'])) {
    $carts = $_SESSION['cart'];
}
?>
<!-- Padding from header -->
<div id="about"></div>
<!--Content-->
<div id="cart-container" class="d-flex" style="width: 81%">
    <!--left-->
    <div id="left-cart-container">
        <div id="left-content-container">
            <form action="update_cart.php" method="post">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div id="left-heading">
                        Shopping cart
                    </div>
                    <div id="total-item">
                        <?= count($carts) ?> items
                    </div>
                </div>

                <div class="d-flex text-center justify-content-between">
                    <div style="width: 400px">Product</div>
                    <div style="width: 104px">Quantity</div>
                    <div style="width: 150px">Price</div>
                    <div style="width: 120px">Action</div>
                </div>
                <hr>
                <?php
                if (count($carts) === 0) {
                    ?>
                    <div class="text-center">Your cart is empty</div>
                    <?php
                }
                ?>
                <div style="height: 48vh; overflow-y: scroll;">
                    <?php
                    foreach ($carts as $id => $quantity) {
                        //    query lay thong tin sp theo id
                        $sql = "SELECT * FROM furnitures WHERE id = '$id'";
                        //        chay query
                        $furnitures = mysqli_query($connect, $sql);
                        //        hien thi thong tin san pham vua lay dc
                        foreach ($furnitures as $furniture) {
                            ?>
                            <div class="d-flex justify-content-between align-items-center text-center mb-2 mt-2">
                                <div class="d-flex align-items-center" style="width: 400px">
                                    <div>
                                        <a href="../furniture/furniture_detail.php?id=<?= $id ?>">
                                            <img src="../../admins/images/<?= $furniture['image'] ?>"
                                                 class="cart-item-img">
                                        </a>
                                    </div>
                                    <div class="fw-bold w-100">
                                        <a href="../furniture/furniture_detail.php?id=<?= $id ?>" class="text-dark">
                                            <?= $furniture['name'] ?>
                                        </a>
                                    </div>
                                </div>
                                <div style="width: 104px;">
                                    <input value="<?= $quantity; ?>" name="quantity[<?= $id; ?>]"
                                           type="number" min="1"
                                           style="border: 1px solid lightgrey; text-align: center; width: 50%"
                                    >
                                </div>
                                <div class="fw-bold" style="color: green; width: 150px">
                                    <?php
                                    $cost = $furniture['price'] * $quantity;
                                    $total_cost += $cost;
                                    echo currency_format($cost);
                                    ?>
                                </div>
                                <div style="width: 103px;">
                                    <a href="delete_one_product.php?id=<?= $id ?>">
                                        <span class="fa-solid fa-xmark" style="color: red;"></span>
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                    }

                    ?>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="../furniture/index.php">
                            <span class="fa-solid fa-arrow-left"></span> Back to store
                        </a>
                    </div>
                    <?php
                    if (count($carts) === 0) {
                    } else {
                        ?>
                        <div class="d-flex justify-content-between" style="width: 45%">
                            <div>
                                <button style="background-color: transparent; color: #0d6efd;">
                                    Update quantity
                                </button>
                            </div>
                            <div>
                                <a href="delete_all_product.php" style="color: red">
                                    Delete my cart
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>

    <!--right-->
    <div id="right-cart-container">
        <div id="right-content-container">
            <?php
            if (count($carts) === 0) { ?>
            <form method="" action="">
                <?php
                } else { ?>
                <form method="post" action="order.php">
                    <?php
                    }
                    ?>
                    <div class="align-left mb-4">
                        <div id="right-heading">
                            Summary
                        </div>
                    </div>

                    <hr class="mb-2">

                    <div>
                        <?php
                        $userId = "";
                        if (isset($_SESSION['user-id'])) {
                            $userId = $_SESSION['user-id'];
                        }
                        $userInfoSql = "SELECT * FROM customers WHERE id = '$userId'";
                        $userInfo = mysqli_query($connect, $userInfoSql);
                        foreach ($userInfo as $information) {
                            ?>
                            <div class="d-flex justify-content-between mb-1 align-items-center">
                                <div>
                                    <h4>
                                        Receiver name:
                                    </h4>
                                </div>
                                <div>
                                    <h4 class="fw-bold">
                                        <?= $information['name'] ?>
                                    </h4>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mb-1 align-items-center">
                                <div>
                                    <h4>
                                        Receiver phone:
                                    </h4>
                                </div>
                                <div>
                                    <h4 class="fw-bold">
                                        <?= $information['phone'] ?>
                                    </h4>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mb-1 align-items-center">
                                <div>
                                    <h4>
                                        Receiver address:
                                    </h4>
                                </div>
                                <div>
                                    <h4 class="fw-bold">
                                        <?= $information['address'] ?>
                                    </h4>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center mb-1 align-items-center">
                                <div>
                                    <a href="../profile/index.php" style="font-size: 12px">Change receiver's
                                        information</a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="d-flex justify-content-between mb-1 align-items-center">
                            <div>
                                <h4>
                                    Total items:
                                </h4>
                            </div>
                            <div>
                                <h4>
                                    <?= array_sum($carts) ?>
                                </h4>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mb-1 align-items-center">
                            <div>
                                <h4>
                                    Items price:
                                </h4>
                            </div>
                            <div>
                                <h4>
                                    <?= currency_format($total_cost) ?>
                                </h4>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mb-1 align-items-center">
                            <div>
                                <h4>
                                    Shipping cost:
                                </h4>
                            </div>
                            <div>
                                <h4>
                                    Free
                                </h4>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mt-4 mb-2 align-items-center fw-bold">
                        <div>
                            <h3>
                                Total cost:
                            </h3>
                        </div>
                        <div>
                            <span style="color: #3e9c35"><?= currency_format($total_cost) ?></span>
                        </div>
                    </div>
                    <?php
                    if (isset($_SESSION['user-email'])) {
                        if (count($carts) > 0) {
                            ?>
                            <button style="width: 100%; height: 49.1px; font-size: 16px" class="btn btn-primary">
                                <input type="number" name="payment-method" value="0" style="display: none !important;">
                                Pay on delivery
                            </button>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="text-center w-100 fst-italic">Please <a href="../login_logout/login.php">login</a> to order</div>
                        <?php
                    }
                    ?>
                    <?php
                    $startTime = date("YmdHis");
                    $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));
                    ?>
                </form>
                <?php
                if (isset($_SESSION['user-email'])) {
                    if (count($carts) > 0) {
                        ?>
                        <form method="post" target="_blank" enctype="application/x-www-form-urlencoded"
                              action="../../banking/vnpay_process.php" style="margin-top: 12px">
                            <div class="d-flex justify-content-center align-items-center">
                                <input type="number" name="payment-method" value="1" style="display: none !important;">
                                <input type="number" value="<?= $total_cost ?>" name="amount"
                                       style="display: none !important;">
                                <input type="number" value="<?= $startTime ?>" name="start-time"
                                       style="display: none !important;">
                                <input type="number" value="<?= $expire ?>" name="expire"
                                       style="display: none !important;">

                                <button type="submit" name="redirect" style="width: 100%; font-size: 16px"
                                        class="btn btn-dark">
                                    Pay via VNPAY
                                    <img src="../../main/media/images/admin/vnpay.jpg" alt="" style="width: 40px"
                                         alt="button-png" style="border: 0; border-radius: 10px">
                                </button>
                            </div>
                        </form>
                        <?php
                    }
                }
                ?>

        </div>
    </div>
</div>
<?php
include_once("../../layout/footer.php");
?>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['email'])) {
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../main/css/bootstrap.css">
    <link rel="stylesheet" href="../../main/css/admin.css">
    <title>Create a new order</title>
</head>
<body>
<?php
//format USD $$$
if (!function_exists('currency_format')) {
    function currency_format($number, $suffix = '$')
    {
        if (!empty($number)) {
            return "{$suffix}" . number_format($number, 2, ".", ",");
        }
    }
}
include_once("../../connect/open.php");
$customerSql = "SELECT * FROM customers";
$customers = mysqli_query($connect, $customerSql);

$furnitureListSql = "SELECT * FROM furnitures WHERE quantity > 0";
$furniture_lists = mysqli_query($connect, $furnitureListSql);

//    truong hop chua co cart tren session
$admin_carts = array();
//    thanh tien mac dinh
$total_cost = 0;
//    lay cart tu session ve trong truong hop da co cart
if (isset($_SESSION['admin_cart'])) {
    $admin_carts = $_SESSION['admin_cart'];
}
?>

<div id="content" class="">
    <div class="wrapper d-flex align-items-stretch">
        <div style="width: 250px"></div>
        <div class="position-fixed" style="height: 100%">
            <?php
            include("../../layout/admin_menu.php");
            ?>
        </div>

        <!--  content  -->

        <div class="content-container">
            <h4 class="content-heading">Add an order</h4>
            <div class="dashboard-block">
                <div class="db-title">
                    Please fill the form below
                </div>
                <div style="height: 100%; background-color: white; border-radius: 0px 0px 10px 10px; color: black">
                    <div class="d-flex justify-content-between w-100 h-100 align-items-center">
                        <div class="h-100" style="width: 65%">
                            <form action="add_order/update_quantity.php" method="post" class="w-100 h-100">
                                <div class="m-4">
                                    <div class="d-flex text-center justify-content-between">
                                        <div style="width: 400px">Product</div>
                                        <div style="width: 104px">Quantity</div>
                                        <div style="width: 150px">Price</div>
                                        <div style="width: 120px">Action</div>
                                    </div>
                                    <hr style="border: 0">
                                    <div style="height: 36vh; overflow-y: scroll;">
                                        <?php
                                        foreach ($admin_carts as $id => $quantity) {
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
                                                            <a href="#">
                                                                <img src="../../admins/images/<?= $furniture['image'] ?>"
                                                                     class="cart-item-img" width="120px">
                                                            </a>
                                                        </div>
                                                        <div class="fw-bold w-100">
                                                            <a href="#" class="text-dark">
                                                                <?= $furniture['name'] ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div style="width: 104px;">
                                                        <input value="<?= $quantity; ?>"
                                                               name="quantity[<?= $id; ?>]"
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
                                                        <a href="add_order/delete_one.php?id=<?= $id ?>">
                                                                <span class="fa-solid fa-xmark"
                                                                      style="color: red;"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }

                                        ?>
                                    </div>
                                    <hr style="border: 0">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <a href="index.php">
                                                <span class="fa-solid fa-arrow-left"></span> Back
                                            </a>
                                        </div>
                                        <div>
                                            <a href="#add-modal">
                                                <span class="fa-solid fa-plus"></span> Add product
                                            </a>
                                        </div>
                                        <?php
                                        if (count($admin_carts) === 0) {
                                        } else {
                                            ?>
                                            <div class="d-flex justify-content-between" style="width: 45%">
                                                <div>
                                                    <button style="background-color: transparent; color: #0d6efd; border: 0">
                                                        Update quantity
                                                    </button>
                                                </div>
                                                <div>
                                                    <a href="add_order/delete_all.php" style="color: red">
                                                        Delete my cart
                                                    </a>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="h-100 d-flex flex-column justify-content-center"
                             style="background-color: #eee; width: 35%; border-radius: 0px 0px 10px 0px">
                            <?php
                            if (count($admin_carts) == 0) {
                            ?>
                            <form action="" method="" class="w-100 h-100">
                                <?php
                                } else {
                                ?>
                                <form action="add_order/order.php" method="post" class="w-100 h-100">
                                    <?php
                                    }
                                    ?>
                                    <div class="m-4">
                                        <div class="d-flex justify-content-between mb-1">
                                            Customer:
                                            <select name="customer" id="customer" class="form-select-sm">
                                                <?php
                                                foreach ($customers as $customer) {
                                                    ?>
                                                    <option value="<?= $customer['id'] ?>"><?= $customer['name'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="d-flex justify-content-between mb-1">
                                            Receiver name:
                                            <input name="re-name" type="text" placeholder="Name..."
                                                   class="add-order-input"
                                                   required>
                                        </div>
                                        <div class="d-flex justify-content-between mb-1">
                                            Receiver phone: <input name="re-phone" type="text"
                                                                   placeholder="Phone number..."
                                                                   class="add-order-input" required>
                                        </div>
                                        <div class="d-flex justify-content-between mb-1">
                                            Receiver address: <input name="re-address" type="text"
                                                                     placeholder="Address..."
                                                                     class="add-order-input" required>
                                        </div>
                                        <div class="d-flex justify-content-between mb-1">
                                            Total items:
                                            <div>
                                                <?= array_sum($admin_carts) ?>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mb-1">
                                            Items price:
                                            <div>
                                                <?= currency_format($total_cost) ?>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mb-1">
                                            Shipping cost:
                                            <div>
                                                Free
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mb-1">
                                            Payment method:
                                            <div>
                                                <select name="payment-method" class="form-select-sm" disabled>
                                                    <option value="0">Pay on delivery</option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr style="border: 0">
                                        <div class="d-flex justify-content-between mb-3">
                                            <h5>Total cost:</h5>
                                            <div class="fw-bold">
                                                <?= currency_format($total_cost) ?>
                                            </div>
                                        </div>
                                        <div class="w-100">
                                            <button type="submit" class="checkout-button">Create order</button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--modal add product-->
<div id="add-modal" class="my-modal">
    <div class="modal__content">
        <h5>Add product to order</h5>
        <hr>
        <div style="overflow-y: scroll; height: 48vh">
            <?php
            foreach ($furniture_lists as $furniture_list) {
                ?>
                <div class="d-flex text-center justify-content-center align-items-center">
                    <div class="w-25">
                        <img src="../images/<?= $furniture_list['image'] ?>" alt="" width="100px">
                    </div>
                    <div style="width: 40%">
                        <a href="add_order/add_to_order.php?id=<?= $furniture_list['id'] ?>">
                            <?= $furniture_list['name'] ?>
                        </a>
                    </div>
                    <div style="color: #3e9c35; width: 10%">
                        <?= currency_format($furniture_list['price']) ?>
                    </div>
                    <div class="w-25">
                        <a href="add_order/add_to_order.php?id=<?= $furniture_list['id'] ?>" class="btn btn-primary">
                            Add
                        </a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <a href="#" class="modal__close">&times;</a>
    </div>
</div>
<!--end modal add product-->
<?php
include_once("../../connect/close.php");
?>
</body>
</html>
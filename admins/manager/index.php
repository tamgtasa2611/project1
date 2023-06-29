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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../main/css/bootstrap.css">
    <link rel="stylesheet" href="../../main/css/admin.css">

    <title> Home </title>
</head>
<body>
<?php
include_once("../../connect/open.php");
$sqlCategory = "SELECT COUNT(*) as count_total FROM categories";
$categories = mysqli_query($connect, $sqlCategory);
$sqlFurniture = "SELECT COUNT(*) as count_total FROM furnitures";
$furnitures = mysqli_query($connect, $sqlFurniture);
$sqlCustomer = "SELECT COUNT(*) as count_total FROM customers";
$customers = mysqli_query($connect, $sqlCustomer);
$sqlOrder = "SELECT COUNT(*) as count_total FROM orders";
$orders = mysqli_query($connect, $sqlOrder);
$sqlProducer = "SELECT COUNT(*) as count_total FROM producers";
$producers = mysqli_query($connect, $sqlProducer);
include_once("../../connect/close.php");
?>

<div id="content" class="">
    <div class="wrapper d-flex align-items-stretch">
        <?php
        include("../../layout/admin_menu.php");
        ?>
        <!--  content  -->
        <div class="content-container d-flex">
            <table class="mg-12 table table-striped table-hover table-borderless align-middle text-center nice-box-shadow">
                <thead class="text-white">
                <tr>
                    <th><span class="fa fa-bars mr-3"></span> Số danh mục</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td> <?php
                        foreach ($categories as $category) {
                            echo $category['count_total'];
                        }
                        ?>
                        <a href="../category_manager/index.php" class="mt-2 btn btn-primary d-block">Xem tất cả</a>
                    </td>
                </tr>
                </tbody>
            </table>

            <table class="mg-12 table table-striped table-hover table-borderless align-middle text-center nice-box-shadow">
                <thead class="text-white">
                <tr>
                    <th><span class="fa fa-bed mr-3"></span> Số sản phẩm</th>
                </tr>
                </thead>
                <tbody>
                <td> <?php
                    foreach ($furnitures as $furniture) {
                        echo $furniture['count_total'];
                    }
                    ?>
                    <a href="../furniture_manager/index.php" class="mt-2 btn btn-primary d-block">Xem tất cả</a>
                </td>
                </tbody>
            </table>

            <table class="mg-12 table table-striped table-hover table-borderless align-middle text-center nice-box-shadow">
                <thead class="text-white">
                <tr>
                    <th><span class="fa fa-users mr-3"></span> Số khách hàng</th>
                </tr>
                </thead>
                <tbody>
                <td> <?php
                    foreach ($customers as $customer) {
                        echo $customer['count_total'];
                    }
                    ?>
                    <a href="../customer_manager/index.php" class="mt-2 btn btn-primary d-block">Xem tất cả</a>
                </td>
                </tbody>
            </table>

            <table class="mg-12 table table-striped table-hover table-borderless align-middle text-center nice-box-shadow">
                <thead class="text-white">
                <tr>
                    <th><span class="fa fa-clipboard mr-3"></span> Số đơn hàng</th>
                </tr>
                </thead>
                <tbody>
                <td> <?php
                    foreach ($orders as $order) {
                        echo $order['count_total'];
                    }
                    ?>
                    <a href="../order_manager/index.php" class="mt-2 btn btn-primary d-block">Xem tất cả</a>
                </td>
                </tbody>
            </table>

            <table class="mg-12 table table-striped table-hover table-borderless align-middle text-center nice-box-shadow">
                <thead class="text-white">
                <tr>
                    <th><span class="fa fa-tags mr-3"></span> Số nhà sản xuất</th>
                </tr>
                </thead>
                <tbody>
                <td> <?php
                    foreach ($producers as $producer) {
                        echo $producer['count_total'];
                    }
                    ?>
                    <a href="../producer_manager/index.php" class="mt-2 btn btn-primary d-block">Xem tất cả</a>
                </td>
                </tbody>
            </table>
        </div>

</body>
</html>
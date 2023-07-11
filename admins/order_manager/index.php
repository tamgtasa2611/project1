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
    <title>Quản lý đơn hàng</title>
</head>
<body>
<?php
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
include_once('../../connect/open.php');
//pagination
$recordOnePage = 5;
$sqlCountRecord = "SELECT COUNT(*) as count_record FROM orders 
                                INNER JOIN customers ON orders.customer_id = customers.id
                                WHERE customers.name LIKE '%$search%'";
$countRecords = mysqli_query($connect, $sqlCountRecord);
foreach ($countRecords as $countRecord) {
    $records = $countRecord['count_record'];
}

$countPage = ceil($records / $recordOnePage);

$page = 1;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

$start = ($page - 1) * $recordOnePage;
//main
$sql1 = "SELECT orders.*, customers.name as cus_name, 
        (SELECT SUM(quantity * price) FROM order_details 
            WHERE order_id = orders.id) AS total_cost
            FROM orders 
            INNER JOIN customers ON orders.customer_id = customers.id
             WHERE customers.name LIKE '%$search%' ORDER BY orders.id  
             LIMIT $start, $recordOnePage";
$orders = mysqli_query($connect, $sql1);
include_once('../../connect/close.php');
//format usd
if (!function_exists('currency_format')) {
    function currency_format($number, $suffix = '$')
    {
        if (!empty($number)) {
            return "{$suffix}" . number_format($number, 2, ".");
        }
    }
}
?>

<div id="content" class="">
    <div class="wrapper d-flex align-items-stretch">
        <?php
        include("../../layout/admin_menu.php");
        ?>

        <div class="content-container">
            <h4 class="content-heading">Danh sách đơn hàng</h4>
            <table class="table table-striped table-hover table-borderless align-middle text-center nice-box-shadow">
                <thead class="text-white">
                <tr>
                    <th>ID</th>
                    <th>Tên khách hàng</th>
                    <th>Ngày mua</th>
                    <th>Trạng thái</th>
                    <th>Thành tiền</th>
                    <th>Chi tiết</th>
                </tr>
                </thead>
                <?php
                foreach ($orders as $order) {

                    ?>
                    <tr>
                        <td><?= $order['id'] ?></td>
                        <td> <?= $order['cus_name'] ?> </td>
                        <td> <?= $order['date_buy'] ?> </td>
                        <td>
                            <?php
                            if ($order['status'] == 0) {
                                ?>
                                <a href="edit.php?id=<?= $order['id'] ?>"
                                   class="btn btn-danger">
                                    <span>Chờ xác nhận</span>
                                </a>
                                <?php
                            } else if ($order['status'] == 1) {
                                ?>
                                <a href="edit.php?id=<?= $order['id'] ?>"
                                   class="btn btn-success">
                                    <span>Đã xác nhận</span>
                                </a>
                                <?php
                            } else if ($order['status'] == 2) {
                                ?>
                                <a href="edit.php?id=<?= $order['id'] ?>"
                                   class="btn btn-primary">
                                    <span>Đang giao hàng</span>
                                </a>
                                <?php
                            } else if ($order['status'] == 3) {
                                ?>
                                <a href="edit.php?id=<?= $order['id'] ?>"
                                   class="btn btn-success">
                                    <span>Đã giao hàng</span>
                                </a>
                                <?php
                            } else if ($order['status'] == 4) {
                                ?>
                                <a href="edit.php?id=<?= $order['id'] ?>"
                                   class="btn btn-danger">
                                    <span>Đã hủy</span>
                                </a>
                                <?php
                            }
                            ?>
                        </td>
                        <td>
                            <?= currency_format($order['total_cost']) ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary">
                                <a href="order_detail.php?id=<?= $order['id'] ?>" class="text-white"
                                   style="text-decoration: none">Xem</a>
                            </button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>


            <div style="display: flex; justify-content: space-between">
                <button type="button" class="btn btn-primary nice-box-shadow">
                    <a href="create.php" class="text-white" style="text-decoration: none">Thêm đơn hàng</a>
                </button>
                <!-- for de hien thi so trang -->
                <div class="text-center">
                    <ul class="pagination justify-content-center">
                        <?php
                        for ($i = 1; $i <= $countPage; $i++) {
                            ?>
                            <a class="page-link" href="?page=<?= $i ?> & search=<?= $search ?>">
                                <?= $i; ?>
                            </a>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <form class="search-form" action="" method="get">
                    <input type="text" name="search" value="<?= $search; ?>" placeholder="Tìm kiếm tại đây..."
                           class="form-outline">
                    <button type="submit" class="btn btn-primary nice-box-shadow">
                        <a href="" class="text-white" style="text-decoration: none">Tìm kiếm</a>
                    </button>
                </form>
            </div>
        </div>
    </div>


</body>
</html>

<?php
session_start();
$_SESSION['direction'] = "incomplete.php";
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
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../main/css/bootstrap.css">
    <link rel="stylesheet" href="../../main/css/admin.css">
    <!--Pagination    -->
    <script src="../../main/js/pagination.js.org_dist_2.6.0_pagination.js"></script>
    <script src="../../main/js/pagination.js.org_dist_2.6.0_pagination.min.js"></script>

    <title>Incomplete orders</title>
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
                                WHERE customers.name LIKE '%$search%' AND orders.status BETWEEN 0 and 2";
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
             WHERE customers.name LIKE '%$search%' AND orders.status BETWEEN 0 and 2
             ORDER BY orders.id DESC
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
        <div style="width: 250px"></div>
        <div class="position-fixed" style="height: 100%">
            <?php
            include("../../layout/admin_menu.php");
            ?>
        </div>

        <!--  content  -->

        <div class="content-container">
            <h4 class="content-heading">Incomplete Orders List</h4>
            <table class="table table-striped table-hover table-borderless align-middle text-center nice-box-shadow">
                <thead class="text-white">
                <tr>
                    <th>ID</th>
                    <th>Customer name</th>
                    <th>Purchase date</th>
                    <th>Order status</th>
                    <th>Total cost</th>
                    <th>Detail</th>
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
                                    <span>Pending</span>
                                </a>
                                <?php
                            } else if ($order['status'] == 1) {
                                ?>
                                <a href="edit.php?id=<?= $order['id'] ?>"
                                   class="btn btn-success">
                                    <span>Confirmed</span>
                                </a>
                                <?php
                            } else if ($order['status'] == 2) {
                                ?>
                                <a href="edit.php?id=<?= $order['id'] ?>"
                                   class="btn btn-primary">
                                    <span>Delivering</span>
                                </a>
                                <?php
                            } else if ($order['status'] == 3) {
                                ?>
                                <a href="edit.php?id=<?= $order['id'] ?>"
                                   class="btn btn-success">
                                    <span>Completed</span>
                                </a>
                                <?php
                            } else if ($order['status'] == 4) {
                                ?>
                                <a href="edit.php?id=<?= $order['id'] ?>"
                                   class="btn btn-danger">
                                    <span>Cancelled</span>
                                </a>
                                <?php
                            }
                            ?>
                        </td>
                        <td>
                            <?= currency_format($order['total_cost']) ?>
                        </td>
                        <td>
                            <a href="order_detail.php?id=<?= $order['id'] ?>"
                               class="fa-solid fa-pen-to-square"
                               style="font-size: 24px; color: darkslategrey">
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>


            <div style="display: flex; justify-content: space-between">
                <div style="width: 160px"></div>
                <!-- for de hien thi so trang -->
                <div class="text-center d-flex" style="38px">
                    <ul class="pagination justify-content-center">
                        <li class="page-item" style="width: 40px">
                            <a class="page-link"
                                <?php
                                if ($page == 1) {
                                    echo 'href="#"';
                                } else {
                                    echo 'href="?page=' . ($page - 1) . ' & search=' . $search . '"';
                                }
                                ?>>
                                <span class="fa-solid fa-caret-left"></span>
                            </a>
                        </li>
                        <li class="page-item" style="width: 120px">
                            <?php
                            for ($i = 1; $i <= $countPage; $i++) {
                            }
                            ?>
                            <span class="page-link">
                            Page <?= $page ?> / <?= ($i - 1) ?>
                        </span>
                        </li>
                        <li class="page-item" style="width: 40px">
                            <a class="page-link"
                                <?php
                                if ($page == ($i - 1)) {
                                    echo 'href="#"';
                                } else {
                                    echo 'href="?page=' . ($page + 1) . ' & search=' . $search . '"';
                                }
                                ?>>
                                <span class="fa-solid fa-caret-right"></span>
                            </a>
                        </li>
                    </ul>
                    <div style="width: 40%; margin-left: 0.75rem">
                        <form method="get">
                            <input type="hidden" class="d-none" name="search" value="<?= $search ?>">
                            <input type="number" name="page" placeholder="Page" class="page-link"
                                   style="width: 100%; border-radius: 0.25rem" min="1" max="<?= $countPage ?>" required>
                        </form>
                    </div>
                </div>
                <form class="search-form" action="" method="get">
                    <input type="text" name="search" value="<?= $search; ?>" placeholder="Search here..."
                           class="form-outline">
                    <button type="submit" class="btn btn-primary nice-box-shadow text-white">
                        Search
                    </button>
                </form>
            </div>
        </div>
    </div>


</body>
</html>


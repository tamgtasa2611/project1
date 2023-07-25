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
    <!-- header css file link -->
    <link rel="stylesheet" href="../../main/css/header_style.css">
    <!--  main css file link  -->
    <link rel="stylesheet" href="../../main/css/main_style.css">
    <!--    profile css file link   -->
    <link rel="stylesheet" href="../../main/css/profile.css">

    <title>Order history - Beautiful House</title>
</head>
<body>
<?php
include_once("../../connect/open.php");
$userId = $_SESSION['user-id'];

//pagination
$recordOnePage = 5;
$sqlCountRecord = "SELECT COUNT(*) as count_record FROM orders 
                   INNER JOIN customers ON orders.customer_id = customers.id
                   WHERE orders.customer_id = '$userId'";

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
$sql = "SELECT orders.*, (SELECT SUM(quantity * price) FROM order_details 
            WHERE order_id = orders.id) AS total_cost
            FROM orders WHERE customer_id = '$userId'
            ORDER BY orders.status AND orders.date_buy
            LIMIT $start, $recordOnePage";
$orderLists = mysqli_query($connect, $sql);

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
                <h2>
                    My orders
                </h2>
                <h4 style="color: slategray; margin-bottom: 40px">
                    View and manage your order history
                </h4>
                <hr>
            </div>

            <div style="margin-top: 28px; width: 100%">
                <table class="table table-striped table-bordered align-middle w-100">
                    <thead class="fw-bold table-dark align-middle" style="height: 60px">
                    <tr>
                        <th>Order ID</th>
                        <th>Purchase date</th>
                        <th>Status</th>
                        <th>Total cost</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody style="height: 280px">
                    <?php
                    foreach ($orderLists as $orderList) {
                        ?>
                        <tr class="p-5">
                            <td><?= $orderList['id'] ?></td>
                            <td><?= $orderList['date_buy'] ?></td>
                            <td>
                                <?php
                                if ($orderList['status'] == 0) {
                                    ?>
                                    <a href="#"
                                       class="btn btn-danger">
                                        <span>Pending</span>
                                    </a>
                                    <?php
                                } else if ($orderList['status'] == 1) {
                                    ?>
                                    <a href="#"
                                       class="btn btn-success">
                                        <span>Confirmed</span>
                                    </a>
                                    <?php
                                } else if ($orderList['status'] == 2) {
                                    ?>
                                    <a href="#"
                                       class="btn btn-primary">
                                        <span>Delivering</span>
                                    </a>
                                    <?php
                                } else if ($orderList['status'] == 3) {
                                    ?>
                                    <a href="#"
                                       class="btn btn-success">
                                        <span>Completed</span>
                                    </a>
                                    <?php
                                } else if ($orderList['status'] == 4) {
                                    ?>
                                    <a href="#"
                                       class="btn btn-danger">
                                        <span>Cancelled</span>
                                    </a>
                                    <?php
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                $totalCost = $orderList['total_cost'];
                                echo currency_format($totalCost) ?>
                            </td>
                            <td>
                                <a href="order_detail.php?id=<?= $orderList['id'] ?>"
                                   class="fa-solid fa-pen-to-square"
                                   style="font-size: 24px; color: darkslategrey">
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>

                </table>
            </div>

            <!-- for de hien thi so trang -->
            <div class="text-center position-absolute" style="left: 0; right: 0; bottom: 50px">
                <ul class="pagination justify-content-center">
                    <li class="page-item" style="width: 40px">
                        <a class="page-link"
                            <?php
                            if ($page == 1) {
                                echo 'href="#"';
                            } else {
                                echo 'href="?page=' . ($page - 1) . '"';
                            }
                            ?>>
                            <span class="fa-solid fa-caret-left"></span>
                        </a>
                    </li>
                    <li class="page-item" style="width: 80px">
                        <?php
                        for ($i = 1; $i <= $countPage; $i++) {
                        }
                        ?>
                        <span class="page-link">
                            Page <?= $page ?>
                        </span>
                    </li>
                    <li class="page-item" style="width: 40px">
                        <a class="page-link"
                            <?php
                            if ($page == ($i - 1)) {
                                echo 'href="#"';
                            } else {
                                echo 'href="?page=' . ($page + 1) . '"';
                            }
                            ?>>
                            <span class="fa-solid fa-caret-right"></span>
                        </a>
                    </li>
                </ul>
            </div>

            <?php
            include_once("../../connect/close.php");
            ?>
        </div>
    </div>
</div>

<?php
include_once("../../layout/footer.php");
?>

</body>
</html>

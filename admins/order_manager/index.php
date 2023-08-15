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
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../main/css/bootstrap.css">
    <link rel="stylesheet" href="../../main/css/admin.css">

    <title>Order manager</title>
</head>
<body>
<?php
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
$status = "";
if (isset($_GET['status'])) {
    $status = $_GET['status'];
}
include_once('../../connect/open.php');
//pagination
$recordOnePage = 5;
$sqlCountRecord = "SELECT COUNT(*) as count_record FROM orders 
                                INNER JOIN customers ON orders.customer_id = customers.id
                                WHERE customers.name LIKE '%$search%' AND orders.status LIKE '%$status%'";
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
             WHERE customers.name LIKE '%$search%' AND orders.status LIKE '%$status%'
             ORDER BY (orders.status) ASC, (orders.id) DESC
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
            <!--            thong bao action-->
            <?php
            if (!isset($_SESSION['update-status'])) {
                $_SESSION['update-status'] = 0;
            }
            if ($_SESSION['update-status'] === 1) {
                echo '<div id="close-target" class="alert alert-success position-absolute success-alert" role="alert"
                style="top: 11%; right: 10%; box-shadow: 1px 1px green; animation: fadeOut 5s;">
              Update status successfully!
              <i id="click-close" class="fa-solid fa-x" style="font-size: 12px; padding: 8px; cursor: pointer" onclick="closeMes()"></i>
              </div>';
                $_SESSION['update-status'] = 0;
            }
            ?>
            <div class="d-flex justify-content-between align-items-center">
                <div></div>
                <h4 class="content-heading">Order list</h4>
                <div style="width: 20%; margin-top: 20px">
                    <form action="" method="get" class="d-flex justify-content-between">
                        <div>
                            <input type="hidden" class="d-none" name="search" value="<?= $search ?>">
                            <select name="status" id="status" class="form-select" style="font-size: 16px">
                                <option value="">
                                    All
                                </option>
                                <option value="0"
                                    <?php
                                    if ($status == 0) {
                                        echo 'selected';
                                    }
                                    ?>>Pending
                                </option>

                                <option value="1"
                                    <?php
                                    if ($status == 1) {
                                        echo 'selected';
                                    }
                                    ?>>Confirmed
                                </option>

                                <option value="2"
                                    <?php
                                    if ($status == 2) {
                                        echo 'selected';
                                    }
                                    ?>>Delivering
                                </option>

                                <option value="3"
                                    <?php
                                    if ($status == 3) {
                                        echo 'selected';
                                    }
                                    ?>>Completed
                                </option>

                                <option value="4"
                                    <?php
                                    if ($status == 4) {
                                        echo 'selected';
                                    }
                                    ?>>Cancelled
                                </option>
                            </select>
                        </div>
                        <div>
                            <button class="btn btn-primary" style="font-size: 16px">Sort</button>
                        </div>
                    </form>
                </div>
            </div>

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
                <button type="button" class="btn btn-primary nice-box-shadow">
                    <a href="create.php" class="text-white" style="text-decoration: none">Add an order</a>
                </button>
                <!-- for de hien thi so trang -->
                <div class="text-center d-flex" style="height: 38px">
                    <!--
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
-->
                    <ul class="pagination justify-content-center">
                        <li class="page-item" style="width: 40px">
                            <a class="page-link"
                                <?php
                                if ($page == 1) {
                                    echo 'href="#"';
                                } else {
                                    echo 'href="?page=' . ($page - 1) . ' & search=' . $search . '& status=' . ($status) . '"';
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
                                    echo 'href="?page=' . ($page + 1) . ' & search=' . $search . '& status=' . ($status) . '"';
                                }
                                ?>>
                                <span class="fa-solid fa-caret-right"></span>
                            </a>
                        </li>
                    </ul>
                    <div style="width: 40%; margin-left: 0.75rem">
                        <form method="get">
                            <input type="hidden" class="d-none" name="search" value="<?= $search ?>">
                            <input type="hidden" class="d-none" name="status" value="<?= $status ?>">
                            <input type="number" name="page" placeholder="Page" class="page-link"
                                   style="width: 100%; border-radius: 0.25rem" min="1" max="<?= $countPage ?>" required>
                        </form>
                    </div>
                </div>
                <form class="search-form" action="" method="get">
                    <input type="text" name="search" value="<?= $search; ?>" placeholder="Search here..."
                           class="form-outline">
                    <input type="hidden" class="d-none" name="status" value="<?= $status ?>">
                    <button type="submit" class="btn btn-primary nice-box-shadow text-white">
                        Search
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!--  js close button modal  -->
    <script>
        let clickClose = document.getElementById('click-close');
        let closeTarget = document.getElementById('close-target')

        function closeMes() {
            closeTarget.classList.add("d-none");
        }
    </script>
</body>
</html>

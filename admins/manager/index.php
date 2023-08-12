<?php
session_start();
//kiem tra admin da login chua
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
    <!--  font google  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!--    bootstrap-->
    <link rel="stylesheet" href="../../main/css/bootstrap.css">
    <!--    admin css-->
    <link rel="stylesheet" href="../../main/css/admin.css">

    <title> Home </title>
</head>
<body>
<?php
include_once("../../connect/open.php");

//lay ngay hien tai va hom qua
$currentDate = date('Y-m-d');
$yesterdayDate = date('Y-m-d', time() - 60 * 60 * 24);

//daily order
$sqlCountTodayOrder = "SELECT COUNT(*) as count_total FROM orders WHERE date_buy = '$currentDate'";
$countTodayOrders = mysqli_query($connect, $sqlCountTodayOrder);
$sqlCountYesOrder = "SELECT COUNT(*) as count_total FROM orders WHERE date_buy = '$yesterdayDate'";
$countYesOrders = mysqli_query($connect, $sqlCountYesOrder);

//daily sales
$sqlDailySaleQuery = "SELECT SUM(quantity * price) as sale_earn_day FROM order_details 
                        INNER JOIN orders ON orders.id = order_details.order_id
                        WHERE orders.date_buy = '$currentDate' and orders.status = '3'";
$dailySales = mysqli_query($connect, $sqlDailySaleQuery);
$sqlYesSaleQuery = "SELECT SUM(quantity * price) as sale_earn_yes FROM order_details 
                        INNER JOIN orders ON orders.id = order_details.order_id
                        WHERE orders.date_buy = '$yesterdayDate' and orders.status = '3'";
$YesSales = mysqli_query($connect, $sqlYesSaleQuery);

//total orders
$sqlCountTotalOrder = "SELECT COUNT(*) as count_total FROM orders";
$countTotalOrders = mysqli_query($connect, $sqlCountTotalOrder);
$sqlCompletedOrder = "SELECT COUNT(*) as count_total FROM orders WHERE status = '3'";
$countCompletedOrders = mysqli_query($connect, $sqlCompletedOrder);
$sqlIncompleteOrder = "SELECT COUNT(*) as count_total FROM orders WHERE status BETWEEN 0 and 2";
$countIncompleteOrders = mysqli_query($connect, $sqlIncompleteOrder);

//total sales
$sqlSaleQuery = "SELECT SUM(quantity * price) as sale_earn FROM order_details 
                        INNER JOIN orders ON orders.id = order_details.order_id
                        WHERE orders.status = '3'";
$sales = mysqli_query($connect, $sqlSaleQuery);

//running out of stock
$stockQuery = "SELECT * FROM furnitures
            ORDER BY quantity ASC LIMIT 5";
$stocks = mysqli_query($connect, $stockQuery);

//best seller
$last7days = date('Y-m-d', time() - 7 * (60 * 60 * 24));
$thisMonth = date('Y-m-01');
$lastMonth = "select last_day(curdate() - interval 2 month) + interval 1 day";
$endLastMonth = "select last_day(curdate() - interval 1 month)";

$bestSellerQuery = "SELECT furnitures.name AS fur_name, sum(order_details.quantity) AS sold_quantity,
                    orders.date_buy as time_sold
                    FROM furnitures
                    INNER JOIN order_details ON furnitures.id = order_details.furniture_id
                    INNER JOIN orders ON orders.id = order_details.order_id
                    WHERE (orders.date_buy BETWEEN '$last7days' AND '$currentDate') AND (orders.status = 3)
                    GROUP BY furnitures.name
                    ORDER BY sold_quantity DESC LIMIT 10";

//sort thoi gian bestseller
if (isset($_GET['time'])) {
    if ($_GET['time'] == 1) {
        $bestSellerQuery = "SELECT furnitures.name AS fur_name, sum(order_details.quantity) AS sold_quantity,
                    orders.date_buy as time_sold
                    FROM furnitures
                    INNER JOIN order_details ON furnitures.id = order_details.furniture_id
                    INNER JOIN orders ON orders.id = order_details.order_id
                    WHERE (orders.date_buy BETWEEN '$thisMonth' AND '$currentDate') AND (orders.status = 3)
                    GROUP BY furnitures.name
                    ORDER BY sold_quantity DESC LIMIT 10";
    } else if ($_GET['time'] == 2) {
        $bestSellerQuery = "SELECT furnitures.name AS fur_name, sum(order_details.quantity) AS sold_quantity,
                    orders.date_buy as time_sold
                    FROM furnitures
                    INNER JOIN order_details ON furnitures.id = order_details.furniture_id
                    INNER JOIN orders ON orders.id = order_details.order_id
                    WHERE (orders.date_buy BETWEEN ($lastMonth) AND ($endLastMonth)) AND (orders.status = 3)
                    GROUP BY furnitures.name
                    ORDER BY sold_quantity DESC LIMIT 10";
    }
}

$bestSellers = mysqli_query($connect, $bestSellerQuery);

//format usd
if (!function_exists('currency_format')) {
    function currency_format($number, $suffix = '$')
    {
        if (!empty($number)) {
            return "{$suffix}" . number_format($number, 2, ".");
        }
    }
}

include_once("../../connect/close.php");
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
        <div class="content-container d-flex flex-column">
            <div class="d-flex w-100 justify-content-between">
                <div class="dashboard-sm-block">
                    <div class="db-title">
                        Today's Order Received
                    </div>
                    <div style="color: cornflowerblue" class="db-num">
                        <div>
                            <a href="../order_manager/today_order.php">
                                <?php
                                $todayOrder = 0;
                                foreach ($countTodayOrders as $countTodayOrder) {
                                    $todayOrder = $countTodayOrder['count_total'];
                                }
                                echo $todayOrder;
                                ?>
                            </a>
                        </div>
                        <div style="color: darkgrey; font-style: italic; font-size: 14px">
                            <?php
                            $yesterdayOrder = 0;
                            foreach ($countYesOrders as $countYesOrder) {
                                $yesterdayOrder = $countYesOrder['count_total'];
                            }
                            $compareCountOrder = $todayOrder - $yesterdayOrder;
                            ?>

                            <?php
                            if ($compareCountOrder < 0) {
                                ?>
                                <span style="color: red" ;>
                                    <span class="fa-solid fa-arrow-trend-down"></span> <?= abs($compareCountOrder) ?>
                                </span>
                                <?php
                            } else if ($compareCountOrder > 0) {
                                ?>
                                <span style="color: #3e9c35" ;>
                                    <span class="fa-solid fa-arrow-trend-up"></span> <?= $compareCountOrder ?>
                                </span>
                                <?php
                            } else {
                                ?>
                                <span style="color: dodgerblue" ;>
                                    <span class="fa-solid fa-arrow-trend-up"></span> <?= $compareCountOrder ?>
                                </span>
                                <?php
                            }
                            ?>
                            than yesterday
                        </div>
                    </div>
                </div>

                <div class="dashboard-sm-block">
                    <div class="db-title">
                        Daily Sales
                    </div>
                    <div class="db-num">
                        <div>
                            <a href="../order_manager/today_completed.php" style="color: #3e9c35">
                                <?php
                                $todaySale = 0;
                                foreach ($dailySales as $dailySale) {
                                    $todaySale = $dailySale['sale_earn_day'];
                                }
                                if (is_null($todaySale)) {
                                    $todaySale = 0;
                                    echo "$" . $todaySale . ".00";
                                } else {
                                    echo currency_format($todaySale);
                                }
                                ?>
                            </a>
                        </div>
                        <div style="color: darkgrey; font-style: italic; font-size: 14px">
                            <?php
                            $yesterdaySale = 0;
                            foreach ($YesSales as $yesSale) {
                                $yesterdaySale = $yesSale['sale_earn_yes'];
                            }
                            if (is_null($yesterdaySale)) {
                                $yesterdaySale = 0;
                            }

                            $compareSale = $todaySale - $yesterdaySale;
                            ?>

                            <?php
                            if ($compareSale < 0) {
                                ?>
                                <span style="color: red" ;>
                                    <span class="fa-solid fa-arrow-trend-down"></span> <?= currency_format(abs($compareSale)) ?>
                                </span>
                                <?php
                            } else if ($compareSale > 0) {
                                ?>
                                <span style="color: #3e9c35" ;>
                                    <span class="fa-solid fa-arrow-trend-up"></span> <?= currency_format($compareSale) ?>
                                </span>
                                <?php
                            } else {
                                ?>
                                <span style="color: dodgerblue" ;>
                                    <span class="fa-solid fa-arrow-trend-up"></span> <?= "$0.00"; ?>
                                </span>
                                <?php
                            }
                            ?>
                            than yesterday
                        </div>
                    </div>
                </div>

                <div class="dashboard-sm-block">
                    <div class="db-title">
                        Order Status
                    </div>
                    <div class="db-num">
                        <div>
                            <a href="../order_manager/incomplete.php" style="color: red">
                                <?php
                                $totalOrders = 0;
                                foreach ($countTotalOrders as $countTotalOrder) {
                                    $totalOrders = $countTotalOrder['count_total'];
                                }
                                $completedOrders = 0;
                                foreach ($countCompletedOrders as $countCompletedOrder) {
                                    $completedOrders = $countCompletedOrder['count_total'];
                                }
                                $incompleteOrders = 0;
                                foreach ($countIncompleteOrders as $countIncompleteOrder) {
                                    $incompleteOrders = $countIncompleteOrder['count_total'];
                                    echo $incompleteOrders;
                                }
                                ?><span style="font-size: 16px"> incomplete</span>
                            </a>
                        </div>
                        <div style="color: darkgrey; font-style: italic; font-size: 14px">
                            <span>
                                <a href="../order_manager/completed.php">
                                    <span style="color: #3e9c35">
                                        <?= $completedOrders ?> completed
                                    </span>
                                </a>/
                                <a href="../order_manager/cancelled.php">
                                    <span style="color: darkgrey">
                                    <?= $totalOrders - ($completedOrders + $incompleteOrders) ?> cancelled
                                </span>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="dashboard-sm-block">
                    <div class="db-title">
                        Total Sales
                    </div>
                    <div style="color: #3e9c35" class="db-num">
                        <div>
                            <?php
                            foreach ($sales as $sale) {
                                echo currency_format($sale['sale_earn']);
                            }
                            ?>
                        </div>
                        <div style="color: darkgrey; font-style: italic; font-size: 14px">
                            <a href="revenue.php">Revenue details <i class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex w-100 justify-content-between mt-3">
                <div style="width: 74.6%" class="dashboard-block">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="db-title" style="letter-spacing: 1.2px">
                            BESTSELLER
                        </div>
                        <form action="" method="get">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <select name="time" id="time" style="background-color: #303036; color: white;
                                margin: 12px 12px; font-size: 16px; border: 0px">
                                        <option value="0"
                                            <?php
                                            if (!isset($_GET['time'])) {
                                                $_GET['time'] = 0;
                                            }
                                            if ($_GET['time'] == 0) {
                                                echo "selected";
                                            }
                                            ?>
                                        >The past 7 days
                                        </option>
                                        <option value="1"
                                            <?php
                                            if ($_GET['time'] == 1) {
                                                echo "selected";
                                            }
                                            ?>
                                        >This month
                                        </option>
                                        <option value="2"
                                            <?php
                                            if ($_GET['time'] == 2) {
                                                echo "selected";
                                            }
                                            ?>
                                        >Last month
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <button type="submit" class="apply-btn">
                                        Apply
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- bestseller body -->
                    <div style="height: 100%; background-color: white; border-radius: 0px 0px 10px 10px;
                    color: black">
                        <div id="barchart_material" style="height: 100%; width: 96%; padding: 48px 35px"></div>
                    </div>
                </div>
                <!-- in stock-->
                <div style="width: 24%" class="dashboard-block">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="db-title">
                            Stock
                        </div>
                        <div class="w-100">
                            <div class="d-flex align-items-center justify-content-end">
                                <a class="apply-btn" href="import.php" style="margin: 0 12px">
                                    Import
                                </a>
                            </div>
                        </div>
                    </div>
                    <div style="height: 100%; background-color: white; border-radius: 0px 0px 10px 10px;"
                         class="d-flex flex-column align-middle text-center justify-content-evenly">
                        <?php
                        foreach ($stocks as $stock) {
                            ?>
                            <div style="height: 68px; color: black; padding: 0px 16px"
                                 class="d-flex align-items-center justify-content-between">
                                <div class="w-50">
                                    <?= $stock['name'] ?>
                                </div>
                                <div class="w-50 fw-bold font-italic" style="color: red">
                                    <a href="import.php" style="color: red">
                                        <?= $stock['quantity'] ?> left
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!--       bestseller chart -->
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {'packages': ['bar']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['', 'Amount sold'],
                        <?php
                        foreach ($bestSellers as $bestSeller) {
                        ?>
                        ['<?=$bestSeller['fur_name']?>', <?=$bestSeller['sold_quantity']?>],
                        <?php
                        }
                        ?>
                    ]);

                    var options = {
                        animation: {
                            startup: true,
                            duration: 2000,
                            easing: 'in',
                        },
                        bars: 'horizontal' // Required for Material Bar Charts.
                    };

                    var chart = new google.charts.Bar(document.getElementById('barchart_material'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
            </script>

</body>
</html>
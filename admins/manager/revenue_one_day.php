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

    <title> Revenue details </title>
</head>
<body>
<?php
include_once("../../connect/open.php");

//format usd
if (!function_exists('currency_format')) {
    function currency_format($number, $suffix = '$')
    {
        if (!empty($number)) {
            return "{$suffix}" . number_format($number, 2, ".");
        }
    }
}

$selectedDay = $_GET['day'];
$selectedMonth = $_GET['month'];
$selectedYear = $_GET['year'];

$bestSellerQuery = "SELECT furnitures.name AS fur_name, sum(order_details.quantity) AS sold_quantity,
                    orders.date_buy as time_sold
                    FROM furnitures
                    INNER JOIN order_details ON furnitures.id = order_details.furniture_id
                    INNER JOIN orders ON orders.id = order_details.order_id
                    WHERE (orders.date_buy LIKE '%$selectedYear%-%$selectedMonth-%$selectedDay') 
                      AND (orders.status = 3)
                    GROUP BY furnitures.name
                    ORDER BY sold_quantity DESC";
$bestSellers = mysqli_query($connect, $bestSellerQuery);

$profitSql = "SELECT furnitures.name AS fur_name,
                    (furnitures.price * (sum(order_details.quantity))) AS profit
                    FROM furnitures
                    INNER JOIN order_details ON furnitures.id = order_details.furniture_id
                    INNER JOIN orders ON orders.id = order_details.order_id
                    WHERE (orders.date_buy LIKE '%$selectedYear%-%$selectedMonth-%$selectedDay') 
                      AND (orders.status = 3)
                    GROUP BY furnitures.name
                    ORDER BY profit DESC LIMIT 1";
$profits = mysqli_query($connect, $profitSql);

$quantity = "SELECT date_buy, SUM(quantity * price) as sale_earn 
                                FROM order_details
                                INNER JOIN orders ON orders.id = order_details.order_id
                                WHERE orders.date_buy LIKE '%$selectedYear%-%$selectedMonth-%$selectedDay'
                                GROUP BY orders.date_buy
                                ORDER BY orders.date_buy DESC";
$dates = mysqli_query($connect, $quantity);

$total_item = 0;
foreach ($bestSellers as $bestSeller) {
    $total_item += $bestSeller['sold_quantity'];
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
        <div class="content-container d-flex flex-column">
            <div class="d-flex w-100 justify-content-between align-items-center">
                <div class="d-flex justify-content-between w-100">
                    <div class="dashboard-block" style="width: 74.6%;">
                        <div class="db-title d-flex justify-content-between">
                            <span>Sales</span>
                            <span style="border: 1px solid white; border-radius: 10px; padding: 0px 4px">
                                <?= $selectedDay ?>/<?= $selectedMonth ?>/<?= $selectedYear ?>
                            </span>
                        </div>
                        <div style="height: 100%; background-color: white; border-radius: 0px 0px 10px 10px; color: black">
                            <div id="barchart_material" style="height: 100%; width: 96%; padding: 48px 35px"></div>
                        </div>
                    </div>
                    <div style="width: 24%;" class="d-flex flex-column justify-content-between">
                        <div class="dashboard-block" style="height: 31%">
                            <div class="db-title">Total sales</div>
                            <div class="h-100"
                                 style="background-color: white; border-radius: 0px 0px 10px 10px; color: black">
                                <div style="color: #3e9c35" class="db-num h-auto">
                                    <?php
                                    foreach ($dates as $date) {
                                        ?>
                                        <span><?= currency_format($date['sale_earn']) ?></span>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div>
                                    <?= $total_item ?> furnitures sold
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-block" style="height: 31%">
                            <div class="db-title">Most profit</div>
                            <div class="h-100"
                                 style="background-color: white; border-radius: 0px 0px 10px 10px; color: black">
                                <?php
                                foreach ($profits as $profit) {
                                    ?>
                                    <div class="db-num" style="height: auto">
                                        <span style="color: #3e9c35">
                                            <?= currency_format($profit['profit']) ?>
                                        </span>
                                    </div>
                                    <div><?= $profit['fur_name'] ?></div>
                                    <?php
                                    break;
                                }
                                ?>
                            </div>
                        </div>
                        <div class="dashboard-block" style="height: 31%">
                            <div class="db-title">Bestseller</div>
                            <div class="h-100"
                                 style="background-color: white; border-radius: 0px 0px 10px 10px; color: black">
                                <?php
                                foreach ($bestSellers as $bestSeller) {
                                    ?>
                                    <div class="db-num" style="height: auto">
                                        <span style="color: dodgerblue"><?= $bestSeller['sold_quantity'] ?></span>
                                    </div>
                                    <div><?= $bestSeller['fur_name'] ?></div>
                                    <?php
                                    break;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-top: 1rem" class="d-flex justify-content-between text-white">
                <a onclick="window.history.go(-1)" class="btn btn-primary nice-box-shadow">Back</a>
            </div>
        </div>
        <?php
        include_once("../../connect/close.php");
        ?>
        <!--        chart -->
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


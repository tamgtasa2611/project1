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

    <title> Compare revenue </title>
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

//bien chua ngay va nam
$selectedYear = date('Y');
$selectedMonth = date('m');
$selectedYear2 = date('Y');
$selectedMonth2 = date('m') - 1;

//lay du lieu vao bien tu method get
if (isset($_GET['buy-date-y'])) {
    $selectedYear = $_GET['buy-date-y'];
}
if (isset($_GET['buy-date-m'])) {
    $selectedMonth = $_GET['buy-date-m'];
}
if (isset($_GET['buy-date-y2'])) {
    $selectedYear2 = $_GET['buy-date-y2'];
}
if (isset($_GET['buy-date-m2'])) {
    $selectedMonth2 = $_GET['buy-date-m2'];
}

$sql1 = "SELECT date_buy, SUM(quantity * price) as sale_earn 
                                FROM order_details
                                INNER JOIN orders ON orders.id = order_details.order_id
                                WHERE orders.date_buy LIKE '%$selectedYear%-%$selectedMonth-%%'
                                GROUP BY orders.date_buy
                                ORDER BY orders.date_buy DESC";
$dates = mysqli_query($connect, $sql1);

$sql2 = "SELECT date_buy, SUM(quantity * price) as sale_earn 
                                FROM order_details
                                INNER JOIN orders ON orders.id = order_details.order_id
                                WHERE orders.date_buy LIKE '%$selectedYear2%-%$selectedMonth2-%%'
                                GROUP BY orders.date_buy
                                ORDER BY orders.date_buy DESC";
$dates2 = mysqli_query($connect, $sql2);

//tong sales tung thang
$month1 = 0;
$month2 = 0;
foreach ($dates as $date) {
    $month1 += $date['sale_earn'];
}

foreach ($dates2 as $date2) {
    $month2 += $date2['sale_earn'];
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
            <form action="" method="get">
                <div class="d-flex w-100 justify-content-between align-items-center">
                    <div class="d-flex justify-content-between" style="margin: auto; width: 560px">
                        <div style="height: 240px;" class="dashboard-block">
                            <div class="db-title">
                                <div class="d-flex justify-content-between align-items-center h-100">
                                    <!--                                select month-->
                                    <div>
                                        <select name="buy-date-m" id="buy-date-m" style="background-color: #303036; color: white;
                                margin: 12px 12px; font-size: 16px; border: 0px">
                                            <option value="1"
                                                <?php
                                                if (!isset($_GET['buy-date-m'])) {
                                                    $_GET['buy-date-m'] = date('m');
                                                }
                                                if ($_GET['buy-date-m'] == 1) {
                                                    echo "selected";
                                                    $selectedMonth = 1;
                                                }
                                                ?>
                                            >January
                                            </option>
                                            <option value="2"
                                                <?php
                                                if ($_GET['buy-date-m'] == 2) {
                                                    echo "selected";
                                                    $selectedMonth = 2;
                                                }
                                                ?>
                                            >February
                                            </option>
                                            <option value="3"
                                                <?php
                                                if ($_GET['buy-date-m'] == 3) {
                                                    echo "selected";
                                                    $selectedMonth = 3;
                                                }
                                                ?>
                                            >March
                                            </option>
                                            <option value="4"
                                                <?php
                                                if ($_GET['buy-date-m'] == 4) {
                                                    echo "selected";
                                                    $selectedMonth = 4;
                                                }
                                                ?>
                                            >April
                                            </option>
                                            <option value="5"
                                                <?php
                                                if ($_GET['buy-date-m'] == 5) {
                                                    echo "selected";
                                                    $selectedMonth = 5;
                                                }
                                                ?>
                                            >May
                                            </option>
                                            <option value="6"
                                                <?php
                                                if ($_GET['buy-date-m'] == 6) {
                                                    echo "selected";
                                                    $selectedMonth = 6;
                                                }
                                                ?>
                                            >June
                                            </option>
                                            <option value="7"
                                                <?php
                                                if ($_GET['buy-date-m'] == 7) {
                                                    echo "selected";
                                                    $selectedMonth = 7;
                                                }
                                                ?>
                                            >July
                                            </option>
                                            <option value="8"
                                                <?php
                                                if ($_GET['buy-date-m'] == 8) {
                                                    echo "selected";
                                                    $selectedMonth = 8;
                                                }
                                                ?>
                                            >August
                                            </option>
                                            <option value="9"
                                                <?php
                                                if ($_GET['buy-date-m'] == 9) {
                                                    echo "selected";
                                                    $selectedMonth = 9;
                                                }
                                                ?>
                                            >September
                                            </option>
                                            <option value="10"
                                                <?php
                                                if ($_GET['buy-date-m'] == 10) {
                                                    echo "selected";
                                                    $selectedMonth = 10;
                                                }
                                                ?>
                                            >October
                                            </option>
                                            <option value="11"
                                                <?php
                                                if ($_GET['buy-date-m'] == 11) {
                                                    echo "selected";
                                                    $selectedMonth = 11;
                                                }
                                                ?>
                                            >November
                                            </option>
                                            <option value="12"
                                                <?php
                                                if ($_GET['buy-date-m'] == 12) {
                                                    echo "selected";
                                                    $selectedMonth = 12;
                                                }
                                                ?>
                                            >December
                                            </option>
                                        </select>
                                    </div>
                                    <!--                                select year-->
                                    <div>
                                        <select name="buy-date-y" id="buy-date-y" style="background-color: #303036; color: white;
                                margin: 12px 12px; font-size: 16px; border: 0px">
                                            <option value="<?= date('Y') ?>"
                                                <?php
                                                if (!isset($_GET['buy-date-y'])) {
                                                    $_GET['buy-date-y'] = date('Y');
                                                }
                                                if ($_GET['buy-date-y'] == date('Y')) {
                                                    echo "selected";
                                                    $selectedYear = date('Y');
                                                }
                                                ?>
                                            > <?= date('Y') ?>
                                            </option>
                                            <option value="<?= date('Y') - 1 ?>"
                                                <?php
                                                if ($_GET['buy-date-y'] == date('Y') - 1) {
                                                    echo "selected";
                                                    $selectedYear = date('Y') - 1;
                                                }
                                                ?>
                                            > <?= date('Y') - 1; ?>
                                            </option>
                                            <option value="<?= date('Y') - 2 ?>"
                                                <?php
                                                if ($_GET['buy-date-y'] == date('Y') - 2) {
                                                    echo "selected";
                                                    $selectedYear = date('Y') - 2;
                                                }
                                                ?>
                                            > <?= date('Y') - 2; ?>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div style="height: 100%; background-color: white; border-radius: 0px 0px 10px 10px;
                            color: black" class="d-flex flex-column justify-content-center align-items-center">
                                <?php
                                if ($month1 != 0) {
                                    ?>
                                    <div class="db-num h-auto" style="color: #3e9c35">
                                        <?= currency_format($month1) ?>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="db-num h-auto" style="color: red">
                                        $<?= $month1 ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div style="height: 240px;" class="dashboard-block">
                            <div class="db-title">
                                <div class="d-flex justify-content-between align-items-center h-100">
                                    <!--                                select month-->
                                    <div>
                                        <select name="buy-date-m2" id="buy-date-m2" style="background-color: #303036; color: white;
                                margin: 12px 12px; font-size: 16px; border: 0px">
                                            <option value="1"
                                                <?php
                                                if (!isset($_GET['buy-date-m2'])) {
                                                    $_GET['buy-date-m2'] = date('m') - 1;
                                                }
                                                if ($_GET['buy-date-m2'] == 1) {
                                                    echo "selected";
                                                    $selectedMonth2 = 1;
                                                }
                                                ?>
                                            >January
                                            </option>
                                            <option value="2"
                                                <?php
                                                if ($_GET['buy-date-m2'] == 2) {
                                                    echo "selected";
                                                    $selectedMonth2 = 2;
                                                }
                                                ?>
                                            >February
                                            </option>
                                            <option value="3"
                                                <?php
                                                if ($_GET['buy-date-m2'] == 3) {
                                                    echo "selected";
                                                    $selectedMonth2 = 3;
                                                }
                                                ?>
                                            >March
                                            </option>
                                            <option value="4"
                                                <?php
                                                if ($_GET['buy-date-m2'] == 4) {
                                                    echo "selected";
                                                    $selectedMonth2 = 4;
                                                }
                                                ?>
                                            >April
                                            </option>
                                            <option value="5"
                                                <?php
                                                if ($_GET['buy-date-m2'] == 5) {
                                                    echo "selected";
                                                    $selectedMonth2 = 5;
                                                }
                                                ?>
                                            >May
                                            </option>
                                            <option value="6"
                                                <?php
                                                if ($_GET['buy-date-m2'] == 6) {
                                                    echo "selected";
                                                    $selectedMonth2 = 6;
                                                }
                                                ?>
                                            >June
                                            </option>
                                            <option value="7"
                                                <?php
                                                if ($_GET['buy-date-m2'] == 7) {
                                                    echo "selected";
                                                    $selectedMonth2 = 7;
                                                }
                                                ?>
                                            >July
                                            </option>
                                            <option value="8"
                                                <?php
                                                if ($_GET['buy-date-m2'] == 8) {
                                                    echo "selected";
                                                    $selectedMonth2 = 8;
                                                }
                                                ?>
                                            >August
                                            </option>
                                            <option value="9"
                                                <?php
                                                if ($_GET['buy-date-m2'] == 9) {
                                                    echo "selected";
                                                    $selectedMonth2 = 9;
                                                }
                                                ?>
                                            >September
                                            </option>
                                            <option value="10"
                                                <?php
                                                if ($_GET['buy-date-m2'] == 10) {
                                                    echo "selected";
                                                    $selectedMonth2 = 10;
                                                }
                                                ?>
                                            >October
                                            </option>
                                            <option value="11"
                                                <?php
                                                if ($_GET['buy-date-m2'] == 11) {
                                                    echo "selected";
                                                    $selectedMonth2 = 11;
                                                }
                                                ?>
                                            >November
                                            </option>
                                            <option value="12"
                                                <?php
                                                if ($_GET['buy-date-m2'] == 12) {
                                                    echo "selected";
                                                    $selectedMonth2 = 12;
                                                }
                                                ?>
                                            >December
                                            </option>
                                        </select>
                                    </div>
                                    <!--                                select year-->
                                    <div>
                                        <select name="buy-date-y2" id="buy-date-y2" style="background-color: #303036; color: white;
                                margin: 12px 12px; font-size: 16px; border: 0px">
                                            <option value="<?= date('Y') ?>"
                                                <?php
                                                if (!isset($_GET['buy-date-y2'])) {
                                                    $_GET['buy-date-y2'] = date('Y');
                                                }
                                                if ($_GET['buy-date-y2'] == date('Y')) {
                                                    echo "selected";
                                                    $selectedYear2 = date('Y');
                                                }
                                                ?>
                                            > <?= date('Y') ?>
                                            </option>
                                            <option value="<?= date('Y') - 1 ?>"
                                                <?php
                                                if ($_GET['buy-date-y2'] == date('Y') - 1) {
                                                    echo "selected";
                                                    $selectedYear2 = date('Y') - 1;
                                                }
                                                ?>
                                            > <?= date('Y') - 1; ?>
                                            </option>
                                            <option value="<?= date('Y') - 2 ?>"
                                                <?php
                                                if ($_GET['buy-date-y2'] == date('Y') - 2) {
                                                    echo "selected";
                                                    $selectedYear2 = date('Y') - 2;
                                                }
                                                ?>
                                            > <?= date('Y') - 2; ?>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div style="height: 100%; background-color: white; border-radius: 0px 0px 10px 10px;
                            color: black" class="d-flex flex-column justify-content-center align-items-center">
                                <?php
                                if ($month2 != 0) {
                                    ?>
                                    <div class="db-num h-auto" style="color: #3e9c35">
                                        <?= currency_format($month2) ?>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="db-num h-auto" style="color: red">
                                        $<?= $month2 ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin: auto; margin-top: 1rem; width: 560px"
                     class="d-flex justify-content-between text-white">
                    <a href="revenue.php" class="btn btn-primary nice-box-shadow">Back</a>
                    <div>
                        <button type="submit" class="btn btn-success nice-box-shadow">
                            Compare
                        </button>
                    </div>
                </div>
            </form>
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


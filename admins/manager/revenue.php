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

//bien ngay va thang
$selectedYear = date('Y');
$selectedMonth = date('m');

//lay du lieu vao bien tu method get
if (isset($_GET['buy-date-y'])) {
    $selectedYear = $_GET['buy-date-y'];
}
if (isset($_GET['buy-date-m'])) {
    $selectedMonth = $_GET['buy-date-m'];
}

$sql = "SELECT date_buy, SUM(quantity * price) as sale_earn 
                                FROM order_details
                                INNER JOIN orders ON orders.id = order_details.order_id
                                WHERE (orders.date_buy LIKE '%$selectedYear%-%$selectedMonth-%%')
                                AND (orders.status = 3)
                                GROUP BY orders.date_buy
                                ORDER BY orders.date_buy DESC";
$dates = mysqli_query($connect, $sql);
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
                <div class="dashboard-block" style="width: 100%;">
                    <div class="d-flex justify-content-between">
                        <div class="db-title">
                            Revenue
                        </div>
                        <form action="" method="get">
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
                                <div>
                                    <button type="submit" class="apply-btn">
                                        Apply
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--                    days -->
                    <div style="height: 100%; background-color: white; border-radius: 0px 0px 10px 10px;
                    color: black">
                        <div class="d-flex h-100 justify-content-evenly w-100 flex-wrap flex-column align-items-center">
                            <div class="d-flex w-100 justify-content-evenly">
                                <?php
                                $countDay = 1;
                                for ($countDay; $countDay <= 10; $countDay++) {
                                    ?>
                                    <div class="revenue-block">
                                        <div class="font-italic fw-bold" style="color: steelblue">
                                            Day <?= $countDay ?>
                                        </div>
                                        <div class="w-100 mt-2 fw-bold" style="color: #3e9c35">
                                            <?php
                                            $isZero = 0;
                                            foreach ($dates as $date) {
                                                $day_date = date('d', strtotime($date["date_buy"]));
                                                if ($day_date == $countDay) {
                                                    ?>
                                                    <a href="
                                                    revenue_one_day.php?day=<?= $day_date ?>&month=<?= $selectedMonth ?>&year=<?= $selectedYear ?>"
                                                       style="color: #3e9c35">
                                                        <?= currency_format($date['sale_earn']); ?>
                                                    </a>
                                                    <?php
                                                    $isZero++;
                                                }
                                            }
                                            if ($isZero == 0) {
                                                ?>
                                                <span style="color: red">$0</span>
                                                <?php
                                                $isZero = 0;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="d-flex w-100 justify-content-evenly">
                                <?php
                                $countDay = 11;
                                for ($countDay; $countDay <= 20; $countDay++) {
                                    ?>
                                    <div class="revenue-block">
                                        <div class="font-italic fw-bold" style="color: steelblue">
                                            Day <?= $countDay ?>
                                        </div>
                                        <div class="w-100 mt-2 fw-bold" style="color: #3e9c35">
                                            <?php
                                            $isZero = 0;
                                            foreach ($dates as $date) {
                                                $day_date = date('d', strtotime($date["date_buy"]));
                                                if ($day_date == $countDay) {
                                                    ?>
                                                    <a href="
                                                    revenue_one_day.php?day=<?= $day_date ?>&month=<?= $selectedMonth ?>&year=<?= $selectedYear ?>"
                                                       style="color: #3e9c35">
                                                        <?= currency_format($date['sale_earn']); ?>
                                                    </a>
                                                    <?php
                                                    $isZero++;
                                                }
                                            }
                                            if ($isZero == 0) {
                                                ?>
                                                <span style="color: red">$0</span>
                                                <?php
                                                $isZero = 0;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <!--                            kiem tra thang 2, thang 30 ngay, thang 31 ngay-->
                            <?php
                            if ($selectedMonth == 2) { //thang 2
                                ?>
                                <div class="d-flex w-100 justify-content-evenly">
                                    <?php
                                    $countDay = 21;
                                    for ($countDay; $countDay <= 28; $countDay++) {
                                        ?>
                                        <div class="revenue-block">
                                            <div class="font-italic fw-bold" style="color: steelblue">
                                                Day <?= $countDay ?>
                                            </div>
                                            <div class="w-100 mt-2 fw-bold" style="color: #3e9c35">
                                                <?php
                                                $isZero = 0;
                                                foreach ($dates as $date) {
                                                    $day_date = date('d', strtotime($date["date_buy"]));
                                                    if ($day_date == $countDay) {
                                                        ?>
                                                        <a href="
                                                        revenue_one_day.php?day=<?= $day_date ?>&month=<?= $selectedMonth ?>&year=<?= $selectedYear ?>"
                                                           style="color: #3e9c35">
                                                            <?= currency_format($date['sale_earn']); ?>
                                                        </a>
                                                        <?php
                                                        $isZero++;
                                                    }
                                                }
                                                if ($isZero == 0) {
                                                    ?>
                                                    <span style="color: red">$0</span>
                                                    <?php
                                                    $isZero = 0;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php //thang 30 ngay
                            } else if ($selectedMonth == 4 or $selectedMonth == 6 or $selectedMonth == 9 or $selectedMonth == 11) {
                                ?>
                                <div class="d-flex w-100 justify-content-evenly">
                                    <?php
                                    $countDay = 21;
                                    for ($countDay; $countDay <= 30; $countDay++) {
                                        ?>
                                        <div class="revenue-block">
                                            <div class="font-italic fw-bold" style="color: steelblue">
                                                Day <?= $countDay ?>
                                            </div>
                                            <div class="w-100 mt-2 fw-bold" style="color: #3e9c35">
                                                <?php
                                                $isZero = 0;
                                                foreach ($dates as $date) {
                                                    $day_date = date('d', strtotime($date["date_buy"]));
                                                    if ($day_date == $countDay) {
                                                        ?>
                                                        <a href="
                                                        revenue_one_day.php?day=<?= $day_date ?>&month=<?= $selectedMonth ?>&year=<?= $selectedYear ?>"
                                                           style="color: #3e9c35">
                                                            <?= currency_format($date['sale_earn']); ?>
                                                        </a>
                                                        <?php
                                                        $isZero++;
                                                    }
                                                }
                                                if ($isZero == 0) {
                                                    ?>
                                                    <span style="color: red">$0</span>
                                                    <?php
                                                    $isZero = 0;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php //thang 31 ngay
                            } else {
                                ?>
                                <div class="d-flex w-100 justify-content-evenly">
                                    <?php
                                    $countDay = 21;
                                    for ($countDay; $countDay <= 30; $countDay++) {
                                        ?>
                                        <div class="revenue-block">
                                            <div class="font-italic fw-bold" style="color: steelblue">
                                                Day <?= $countDay ?>
                                            </div>
                                            <div class="w-100 mt-2 fw-bold" style="color: #3e9c35">
                                                <?php
                                                $isZero = 0;
                                                foreach ($dates as $date) {
                                                    $day_date = date('d', strtotime($date["date_buy"]));
                                                    if ($day_date == $countDay) {
                                                        ?>
                                                        <a href="
                                                        revenue_one_day.php?day=<?= $day_date ?>&month=<?= $selectedMonth ?>&year=<?= $selectedYear ?>"
                                                           style="color: #3e9c35">
                                                            <?= currency_format($date['sale_earn']); ?>
                                                        </a>
                                                        <?php
                                                        $isZero++;
                                                    }
                                                }
                                                if ($isZero == 0) {
                                                    ?>
                                                    <span style="color: red">$0</span>
                                                    <?php
                                                    $isZero = 0;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="d-flex w-100 justify-content-evenly">
                                    <div class="revenue-block">
                                        <div class="font-italic fw-bold" style="color: steelblue">
                                            Day <?= $countDay ?>
                                        </div>
                                        <div class="w-100 mt-2 fw-bold" style="color: #3e9c35">
                                            <?php
                                            $isZero = 0;
                                            foreach ($dates as $date) {
                                                $day_date = date('d', strtotime($date["date_buy"]));
                                                if ($day_date == $countDay) {
                                                    ?>
                                                    <a href="
                                                    revenue_one_day.php?day=<?= $day_date ?>&month=<?= $selectedMonth ?>&year=<?= $selectedYear ?>"
                                                       style="color: #3e9c35">
                                                        <?= currency_format($date['sale_earn']); ?>
                                                    </a>
                                                    <?php
                                                    $isZero++;
                                                }
                                            }
                                            if ($isZero == 0) {
                                                ?>
                                                <span style="color: red">$0</span>
                                                <?php
                                                $isZero = 0;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-top: 1rem" class="d-flex justify-content-between text-white">
                <a href="index.php" class="btn btn-primary nice-box-shadow">Back</a>
                <div class="d-flex">
                    <div style="background-color: white; color: black; border-radius: 8px; font-size: 14px; border: 2px solid #303036; width: 200px; height: 37px"
                         class="d-flex justify-content-evenly align-items-center">
                        <div>Monthly earn:</div>
                        <?php
                        $month_earn = 0;
                        foreach ($dates as $date) {
                            $month_earn += $date['sale_earn'];
                        }
                        if ($month_earn != 0) {
                            ?>
                            <div style="color: #3e9c35; font-weight: 700"><?= currency_format($month_earn) ?></div>
                            <?php
                        } else {
                            ?>
                            <div style="color: red; font-weight: 700"> $0</div>
                            <?php
                        }
                        ?>
                    </div>
                    <div style="margin-left: 1rem">
                        <a href="compare.php" class="btn btn-success nice-box-shadow">Compare revenue</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include_once("../../connect/close.php");
        ?>
</body>
</html>


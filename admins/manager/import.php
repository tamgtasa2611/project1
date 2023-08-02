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

    <title> Import </title>
</head>
<body>
<?php
include_once("../../connect/open.php");
$producer_id = 0;

$producerSql = "SELECT * FROM producers";
$producers = mysqli_query($connect, $producerSql);

if (isset($_GET['producer-id']) and $_GET['producer-id'] != 0) {
    $producer_id = $_GET['producer-id'];
    $furnitureSql = "SELECT * FROM furnitures WHERE producer_id = '$producer_id'";
} else {
    $furnitureSql = "SELECT * FROM furnitures";
}
$furnitures = mysqli_query($connect, $furnitureSql);

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
            <?php
            if (!isset($_SESSION['import'])) {
                //0: loi; 1: ok; 2: ko co gi
                $_SESSION['import'] = 2;
            }
            if ($_SESSION['import'] == 1) {
                echo '<div id="close-target" class="alert alert-success position-absolute" role="alert"
                style="top: 8%; right: 5%; box-shadow: 1px 1px green; animation: fadeOut 5s;">
              Import furniture successfully!
              <i id="click-close" class="fa-solid fa-x" style="font-size: 12px; padding: 8px; cursor: pointer" onclick="closeMes()"></i>
              </div>';
                $_SESSION['import'] = 2;
            } else if ($_SESSION['import'] == 0) {
                echo '<div id="close-target" class="alert alert-danger position-absolute" role="alert"
                style="top: 8%; right: 5%; box-shadow: 1px 1px red; animation: fadeOut 5s;">
              Please choose a furniture!
              <i id="click-close" class="fa-solid fa-x" style="font-size: 12px; padding: 8px; cursor: pointer" onclick="closeMes()"></i>
              </div>';
                $_SESSION['import'] = 2;
            }
            ?>
            <h4 class="content-heading">Import furnitures</h4>
            <div class="d-flex w-100 justify-content-center align-items-center">
                <div class="dashboard-block w-75">
                    <div class="db-title">
                        Choose a producer and its products
                    </div>
                    <div class="dashboard-body overflow-hidden">
                        <form method="get" action="" style="height: 25%;">
                            <div class="d-flex justify-content-center align-items-center text-center h-100 w-100">
                                <div class="w-100 d-flex justify-content-between align-items-center">
                                    <div class="w-25">
                                        <h6>Select producer:</h6>
                                    </div>
                                    <div class="w-50">
                                        <select name="producer-id" id="producer-id" class="form-select w-100">
                                            <option value="0" selected>Choose a producer</option>
                                            <?php
                                            foreach ($producers as $producer) {
                                                ?>
                                                <option value="<?= $producer['id'] ?>"
                                                    <?php
                                                    if (isset($_GET['producer-id'])) {
                                                        if ($_GET['producer-id'] == $producer['id']) {
                                                            echo "selected";
                                                        }
                                                    }
                                                    ?>>
                                                    <?= $producer['name'] ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="w-25">
                                        <button class="btn btn-info">Sort</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form method="post" action="import_process.php" style="height: 100%">
                            <div class="text-center w-100 d-flex align-items-center" style="height: 25%;">
                                <div class="w-100 d-flex align-items-center justify-content-between">
                                    <div class="w-25">
                                        <h6>Select furniture:</h6>
                                    </div>
                                    <div class="w-50">
                                        <select name="furniture-id" id="furniture-id" class="form-select w-100">
                                            <option value="0" selected>Choose a furniture</option>
                                            <?php
                                            foreach ($furnitures as $furniture) {
                                                ?>
                                                <option value="<?= $furniture['id'] ?>">
                                                    <?= $furniture['name'] ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="w-25"></div>
                                </div>
                            </div>

                            <div class="text-center w-100 d-flex align-items-center" style="height: 25%;">
                                <div class="w-100 d-flex align-items-center justify-content-between">
                                    <div class="w-25">
                                        <h6>Enter quantity:</h6>
                                    </div>
                                    <div class="w-50">
                                        <input type="number" name="quantity" class="form-control w-100"
                                               style="border: 1px solid #ced4da; font-size: 16px" required min="1">
                                    </div>
                                    <div class="w-25"></div>
                                </div>
                            </div>

                            <div class="text-center w-100 d-flex align-items-center" style="height: 25%;">
                                <div class="w-100 d-flex align-items-center justify-content-center">
                                    <button type="submit" class="btn btn-success" style="width: 20%">Import</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--
                <div style="margin-top: 1rem" class="d-flex justify-content-between text-white">
                    <a href="index.php" class="btn btn-primary nice-box-shadow">Back</a>
                </div>
                -->
    </div>
</div>
<?php
include_once("../../connect/close.php");
?>

<script>
    let clickClose = document.getElementById('click-close');
    let closeTarget = document.getElementById('close-target')

    function closeMes() {
        closeTarget.classList.add("d-none");
    }
</script>
</body>
</html>
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
    <title>Customer manager</title>
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
$sqlCountRecord = "SELECT COUNT(*) as count_record FROM customers WHERE name LIKE '%$search%'";
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
$sql = "SELECT * FROM customers WHERE name LIKE '%$search%' ORDER BY id LIMIT $start, $recordOnePage";
$customers = mysqli_query($connect, $sql);
include_once('../../connect/close.php');

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
            <h4 class="content-heading">Customer list</h4>
            <table class="table table-striped table-hover table-borderless align-middle text-center nice-box-shadow">
                <thead class="text-white">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                </thead>
                <?php
                foreach ($customers as $customer) {
                    ?>
                    <tr>
                        <td><?= $customer['id'] ?></td>
                        <td> <?= $customer['name'] ?> </td>
                        <td> <?= $customer['email'] ?> </td>
                        <td> <?= $customer['phone'] ?> </td>
                        <td> <?php
                            if ($customer['gender'] == 1) {
                                echo 'Male';
                            } else {
                                echo 'Female';
                            }
                            ?> </td>
                        <td> <?= $customer['address'] ?> </td>
                        <td>
                            <button type="button" class="btn btn-primary">
                                <a href="edit.php?id=<?= $customer['id'] ?>" class="text-white"
                                   style="text-decoration: none">Edit</a>
                            </button>
                            <button type="button" class="btn bg-danger border-danger">
                                <a href="destroy.php?id=<?= $customer['id'] ?>" class="text-white"
                                   style="text-decoration: none">Delete</a>
                            </button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>


            <div style="display: flex; justify-content: space-between">
                <button type="button" class="btn btn-primary nice-box-shadow">
                    <a href="create.php" class="text-white" style="text-decoration: none">Add a customer</a>
                </button>
                <!-- for de hien thi so trang -->
                <div class="text-center" style="height: 38px">
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
                            Page <?= $page ?>/<?= ($i - 1) ?>
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
                </div>
                <form class="search-form" action="" method="get">
                    <input type="text" name="search" value="<?= $search; ?>" placeholder="Search here..."
                           class="form-outline">
                    <button type="submit" class="btn btn-primary nice-box-shadow">
                        <a href="" class="text-white" style="text-decoration: none">Search</a>
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
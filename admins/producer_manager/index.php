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

    <title>Producer manager</title>
</head>
<body>
<?php
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
include_once('../../connect/open.php');
//
$recordOnePage = 5;
$sqlCountRecord = "SELECT COUNT(*) as count_record FROM producers WHERE name LIKE '%$search%'";
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
//
$sql = "SELECT * FROM producers WHERE name LIKE '%$search%' ORDER BY id LIMIT $start, $recordOnePage  ";
$producers = mysqli_query($connect, $sql);
include_once('../../connect/close.php');

?>
<div id="content" class="">
    <div class="wrapper d-flex align-items-stretch">
        <?php
        include("../../layout/admin_menu.php");
        ?>
        <!--  content  -->
        <div class="content-container">
            <h4 class="content-heading">Producer list</h4>
            <table class="table table-striped table-hover table-borderless align-middle text-center nice-box-shadow">
                <thead class="text-white">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <?php
                foreach ($producers as $producer) {
                    ?>
                    <tr>
                        <td><?= $producer['id'] ?></td>
                        <td> <?= $producer['name'] ?> </td>
                        <td>
                            <button type="button" class="btn btn-primary">
                                <a href="edit.php?id=<?= $producer['id'] ?>" class="text-white"
                                   style="text-decoration: none">Edit</a>
                            </button>
                            <button type="button" class="btn bg-danger border-danger">
                                <a href="destroy.php?id=<?= $producer['id'] ?>" class="text-white"
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
                    <a href="create.php" class="text-white" style="text-decoration: none">Add a producer</a>
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
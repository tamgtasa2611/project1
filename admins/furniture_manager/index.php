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

    <title>Furniture manager</title>
</head>
<body>
<?php
include_once('../../connect/open.php');
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
//khai bao so ban ghi 1 trang
$recordOnePage = 5;
//sql de lay so ban ghi
$sqlCountRecord = "SELECT COUNT(*) as count_record FROM furnitures WHERE name LIKE '%$search%'";
//chay query lay so ban ghi
$countRecords = mysqli_query($connect, $sqlCountRecord);
//foreach de lay so ban ghi -> luu vao bien records
foreach ($countRecords as $countRecord) {
    $records = $countRecord['count_record'];
}
//tinh so trang
$countPage = ceil($records / $recordOnePage); //ceil(2.5) = 3
//Lấy trang hiện tại (nếu không tồn tại page hiện tại thì page hiện tại = 1)
$page = 1;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
//Tính bản ghi bắt đầu của trang
$start = ($page - 1) * $recordOnePage;

//main
$sql = "SELECT furnitures.*, categories.name as category_name, producers.name as producer_name
        FROM furnitures 
        INNER JOIN categories ON furnitures.category_id = categories.id
        INNER JOIN producers ON furnitures.producer_id = producers.id
        WHERE furnitures.name LIKE '%$search%'
        ORDER BY furnitures.id DESC
        LIMIT $start, $recordOnePage";
$furnitures = mysqli_query($connect, $sql);
include_once('../../connect/close.php');

//format USD $$$
if (!function_exists('currency_format')) {
    function currency_format($number, $suffix = '$')
    {
        if (!empty($number)) {
            return "{$suffix}" . number_format($number, 2, ".");
        }
    }
}
?>

<div id="content">
    <div class="wrapper d-flex align-items-stretch">
        <div style="width: 250px"></div>
        <div class="position-fixed" style="height: 100%">
            <?php
            include("../../layout/admin_menu.php");
            ?>
        </div>

        <!--  content  -->
        <div class="content-container">
            <h4 class="content-heading">Furniture list</h4>
            <table class="table table-striped table-hover table-borderless align-middle text-center nice-box-shadow">
                <thead class="text-white">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>In stock</th>
                    <th>Price</th>
                    <th>Material</th>
                    <th>Length (cm)</th>
                    <th>Width (cm)</th>
                    <th>Height (cm)</th>
                    <th>Room</th>
                    <th>Category</th>
                    <th>Producer</th>
                    <th>Action</th>
                </tr>
                </thead>
                <?php
                foreach ($furnitures as $furniture) {
                    ?>
                    <tr>
                        <td><?= $furniture['id'] ?></td>
                        <td> <?= $furniture['name'] ?> </td>
                        <td>
                            <img height="60px" src="../images/<?= $furniture['image'] ?>" alt="">
                        </td>
                        <td> <?= $furniture['quantity'] ?> </td>
                        <td> <?= currency_format($furniture['price']) ?> </td>
                        <td> <?= $furniture['material'] ?> </td>
                        <td> <?= $furniture['length'] ?> </td>
                        <td> <?= $furniture['width'] ?> </td>
                        <td> <?= $furniture['height'] ?> </td>
                        <td> <?= $furniture['room'] ?> </td>
                        <td> <?= $furniture['category_name'] ?> </td>
                        <td> <?= $furniture['producer_name'] ?> </td>
                        <td>
                            <button type="button" class="btn btn-primary mb-1">
                                <a href="edit.php?id=<?= $furniture['id'] ?>" class="text-white"
                                   style="text-decoration: none">Edit</a>
                            </button>
                            <button type="button" class="btn bg-danger border-danger">
                                <a href="destroy.php?id=<?= $furniture['id'] ?>" class="text-white"
                                   style="text-decoration: none">Delete</a>
                            </button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>

            <div style="display: flex; justify-content: space-between;">
                <button type="button" class="btn btn-primary nice-box-shadow">
                    <a href="create.php" class="text-white" style="text-decoration: none">Add a furniture</a>
                </button>
                <!-- for de hien thi so trang -->
                <div class="text-center">
                    <ul class="pagination pagination-sm justify-content-center"
                        style="width: 60%; margin: auto">
                        <?php
                        for ($i = 1; $i <= $countPage; $i++) {
                            ?>
                            <li class="page-item text-center">
                                <a class="page-link text-center" style="border-radius: 10px; width: 30px; height: 30px"
                                   href="?page=<?= $i ?> & search=<?= $search ?>">
                                    <?= $i; ?>
                                </a>
                            </li>
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
            <div style="height: 42px"></div>
        </div>
    </div>
</div>
</body>
</body>
</html>
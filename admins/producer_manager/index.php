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
            <!--            thong bao action -->
            <?php
            if (!isset($_SESSION['ad-destroy'])) {
                $_SESSION['ad-destroy'] = 0;
            }
            if (!isset($_SESSION['ad-create'])) {
                $_SESSION['ad-create'] = 0;
            }
            if (!isset($_SESSION['ad-edit'])) {
                $_SESSION['ad-edit'] = 0;
            }

            if ($_SESSION['ad-destroy'] === 1) {
                echo '<div id="close-target" class="alert alert-success position-absolute" role="alert"
                style="top: 11%; right: 10%; box-shadow: 1px 1px green; animation: fadeOut 5s;">
              Delete successfully!
              <i id="click-close" class="fa-solid fa-x" style="font-size: 12px; padding: 8px; cursor: pointer" onclick="closeMes()"></i>
              </div>';
                $_SESSION['ad-destroy'] = 0;
            }
            if ($_SESSION['ad-create'] === 1) {
                echo '<div id="close-target" class="alert alert-success position-absolute" role="alert"
                style="top: 11%; right: 10%; box-shadow: 1px 1px green; animation: fadeOut 5s;">
              Create successfully!
              <i id="click-close" class="fa-solid fa-x" style="font-size: 12px; padding: 8px; cursor: pointer" onclick="closeMes()"></i>
              </div>';
                $_SESSION['ad-create'] = 0;
            }
            if ($_SESSION['ad-edit'] === 1) {
                echo '<div id="close-target" class="alert alert-success position-absolute" role="alert"
                style="top: 11%; right: 10%; box-shadow: 1px 1px green; animation: fadeOut 5s;">
              Edit successfully!
              <i id="click-close" class="fa-solid fa-x" style="font-size: 12px; padding: 8px; cursor: pointer" onclick="closeMes()"></i>
              </div>';
                $_SESSION['ad-edit'] = 0;
            }
            ?>
            <h4 class="content-heading">Producer list</h4>
            <table class="table table-striped table-hover table-borderless align-middle text-center nice-box-shadow">
                <thead class="text-white">
                <tr>
                    <th>ID</th>
                    <th class="w-50">Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <?php
                foreach ($producers as $producer) {
                    ?>
                    <tr>
                        <td><?= $producer['id'] ?></td>
                        <td class="w-50"> <?= $producer['name'] ?> </td>
                        <td>
                            <button type="button" class="btn btn-primary">
                                <a href="edit.php?id=<?= $producer['id'] ?>" class="text-white"
                                   style="text-decoration: none">Edit</a>
                            </button>
                            <button type="button" class="btn bg-danger border-danger">
                                <a href="#delete-modal?pro=<?= $producer['id'] ?>" class="text-white"
                                   style="text-decoration: none">Delete</a>
                            </button>
                        </td>
                    </tr>
                    <!--          modal  delete        -->
                    <div id="delete-modal?pro=<?= $producer['id'] ?>" class="my-modal" style="z-index: 10">
                        <div class="modal__content">
                            <h2>Confirm delete</h2>

                            <p>
                                Do you really want to delete <span style="color: red"><?= $producer['name'] ?></span>?
                            </p>

                            <div class="modal__footer">
                                <div>
                                    <a href="destroy.php?id=<?= $producer['id'] ?>" class="btn btn-danger"
                                       style="font-size: 16px;">
                                        Delete</a>
                                </div>
                            </div>

                            <a href="#" class="modal__close">&times;</a>
                        </div>
                    </div>
                    <!--          end modal          -->
                    <?php
                }
                ?>
            </table>

            <div style="display: flex; justify-content: space-between">
                <button type="button" class="btn btn-primary nice-box-shadow">
                    <a href="create.php" class="text-white" style="text-decoration: none">Add a producer</a>
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
                            Page <?= $page ?> / <?= ($i - 1) ?>
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
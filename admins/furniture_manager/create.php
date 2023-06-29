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
    <title>Thêm sản phẩm</title>
</head>
<body>
<?php
include_once("../../connect/open.php");
$sql = "SELECT * FROM categories";
$categories = mysqli_query($connect, $sql);
$sql2 = "SELECT * FROM producers";
$producers = mysqli_query($connect, $sql2);
include_once("../../connect/close.php");
?>

<div id="content" class="">
    <div class="wrapper d-flex align-items-stretch">
        <?php
        include("../../layout/admin_menu.php");
        ?>

        <div class="content-container">
            <h4 class="content-heading">Thêm sản phẩm</h4>
            <form action="store.php" method="post" enctype="multipart/form-data">
                <table class="table table-striped table-hover table-borderless align-middle text-center nice-box-shadow">
                    <thead class="text-white">
                    <tr>
                        <th colspan="2">Vui lòng điền thông tin</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="form-outline mb-2">
                                <label>Tên</label>
                                <input name="name" type="text" class="form-control-sm" required/>
                            </div>
                        </td>
                        <td>
                            <div class="form-outline mb-2">
                                <label class="form-label align-left">Tồn kho</label>
                                <input name="quantity" type="number" class="form-control-sm" required/>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div class="form-outline mb-2">
                                <label class="form-label align-left">Giá</label>
                                <input name="price" type="number" class="form-control-sm" required/>
                            </div>
                        </td>
                        <td>
                            <div class="form-outline mb-2">
                                <label class="form-label align-left">Chất liệu</label>
                                <input name="material" type="text" class="form-control-sm"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-outline mb-2">
                                <label class="form-label align-left">Dài</label>
                                <input name="length" type="text" class="form-control-sm"/>
                            </div>
                        </td>
                        <td>
                            <div class="form-outline mb-2">
                                <label class="form-label align-left">Rộng</label>
                                <input name="width" type="text" class="form-control-sm"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-outline mb-2">
                                <label class="form-label align-left">Cao</label>
                                <input name="height" type="text" class="form-control-sm"/>
                            </div>
                        </td>
                        <td>
                            <div class="form-outline mb-2">
                                <label class="form-label align-left">Phòng</label>
                                <input name="room" type="text" class="form-control-sm"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-outline mb-2">
                                <label class="form-label align-left">Danh mục</label>
                                <select name="category_id" id="">
                                    <?php
                                    foreach ($categories as $producer) {
                                        ?>
                                        <option value="<?= $producer['id'] ?>">
                                            <?= $producer['name'] ?> </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-outline mb-2">
                                <label class="form-label align-left">Nhà sản xuất</label>
                                <select name="producer_id" id="">
                                    <?php
                                    foreach ($producers as $producer) {
                                        ?>
                                        <option value="<?= $producer['id'] ?>">
                                            <?= $producer['name'] ?> </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="form-outline mb-2">
                                <label class="form-label align-left">Ảnh</label>
                                <input name="image" type="file" class=""/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a class="btn btn-primary" href="index.php">Quay lại</a>
                            <button class="btn btn-primary" type="submit">Thêm</button>
                        </td>
                    </tr>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

</body>
</html>
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
    <title>Edit a furniture</title>
</head>
<body>
<?php
$id = $_GET['id'];
include_once("../../connect/open.php");
$sql = "SELECT * FROM furnitures WHERE id = '$id'";
$furnitures = mysqli_query($connect, $sql);
$sql2 = "SELECT * FROM categories";
$categories = mysqli_query($connect, $sql2);
$sql3 = "SELECT * FROM producers";
$producers = mysqli_query($connect, $sql3);
include_once("../../connect/close.php");
foreach ($furnitures as $furniture) {
    ?>

    <div id="content" class="">
        <div class="wrapper d-flex align-items-stretch">
            <?php
            include("../../layout/admin_menu.php");
            ?>

            <div class="content-container">
                <h4 class="content-heading">Edit</h4>
                <form action="update.php" method="post" enctype="multipart/form-data">
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
                                    <input name="name" type="text" class="form-control-sm"
                                           value="<?= $furniture['name'] ?>" required/>
                                </div>
                            </td>
                            <td>
                                <div class="form-outline mb-2">
                                    <label class="form-label align-left">Tồn kho</label>
                                    <input name="quantity" type="number" class="form-control-sm"
                                           value="<?= $furniture['quantity'] ?>" required/>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <div class="form-outline mb-2">
                                    <label class="form-label align-left">Giá</label>
                                    <input name="price" type="number" class="form-control-sm"
                                           value="<?= $furniture['price'] ?>" required/>
                                </div>
                            </td>
                            <td>
                                <div class="form-outline mb-2">
                                    <label class="form-label align-left">Chất liệu</label>
                                    <input name="material" type="text" class="form-control-sm"
                                           value="<?= $furniture['material'] ?>"/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-outline mb-2">
                                    <label class="form-label align-left">Dài (cm)</label>
                                    <input name="length" type="text" class="form-control-sm"
                                           value="<?= $furniture['length'] ?>"/>
                                </div>
                            </td>
                            <td>
                                <div class="form-outline mb-2">
                                    <label class="form-label align-left">Rộng (cm)</label>
                                    <input name="width" type="text" class="form-control-sm"
                                           value="<?= $furniture['width'] ?>"/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-outline mb-2">
                                    <label class="form-label align-left">Cao (cm)</label>
                                    <input name="height" type="text" class="form-control-sm"
                                           value="<?= $furniture['height'] ?>"/>
                                </div>
                            </td>
                            <td>
                                <div class="form-outline mb-2">
                                    <label class="form-label align-left">Phòng</label>
                                    <input name="room" type="text" class="form-control-sm"
                                           value="<?= $furniture['room'] ?>"/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-outline mb-2">
                                    <label class="form-label align-left">Danh mục</label>
                                    <select name="category_id" id="">
                                        <?php
                                        foreach ($categories as $category) {
                                            ?>
                                            <option value="<?= $category['id'] ?>"
                                                <?php
                                                if ($furniture['category_id'] == $category['id']) {
                                                    echo 'selected';
                                                }
                                                ?>
                                            >
                                                <?= $category['name'] ?> </option>
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
                                            <option value="<?= $producer['id'] ?>"
                                                <?php
                                                if ($furniture['producer_id'] == $producer['id']) {
                                                    echo 'selected';
                                                }
                                                ?>
                                            >
                                                <?= $producer['name'] ?> </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="0">
                                <div class="form-outline mb-2 d-none">
                                    <label>ID</label>
                                    <input readonly name="id" type="text" class="form-control-sm"
                                           value="<?= $furniture['id'] ?>"/>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="form-outline mb-2">
                                    <label class="form-label align-left">Image</label>
                                    <input name="image" type="file" value="<?= $furniture['image'] ?>"/>
                                    <img height="100px" src="../images/<?= $furniture['image'] ?>" alt="">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a class="btn btn-primary" href="index.php">Quay lại</a>
                                <button class="btn btn-primary" type="submit">Sửa</button>
                            </td>
                        </tr>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <?php
}
?>
</body>
</html>
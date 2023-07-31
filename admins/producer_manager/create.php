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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../main/css/bootstrap.css">
    <link rel="stylesheet" href="../../main/css/admin.css">
    <title>Add a producer</title>
</head>
<body>
<div id="content" class="">
    <div class="wrapper d-flex align-items-stretch">
        <?php
        include("../../layout/admin_menu.php");
        ?>

        <div class="content-container">
            <h4 class="content-heading">Thêm danh mục</h4>
            <table class="table table-striped table-hover table-borderless align-middle text-center nice-box-shadow">
                <thead class="text-white">
                <tr>
                    <th>Vui lòng điền thông tin</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <form action="store.php" method="post">
                            <div class="form-outline mb-3 ">
                                Tên <input name="name" type="text" class="form-control-sm" required/>
                            </div>
                            <a class="btn btn-primary" href="index.php">Quay lại</a>
                            <button class="btn btn-primary" type="submit">Thêm</button>
                        </form>
                    </td>
                </tr>
                </tbody>
        </div>
    </div>
</div>
</body>
</html>
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
    <title>Thêm đơn hàng</title>
</head>
<body>
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
            <h4 class="content-heading">Thêm đơn hàng</h4>
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
                <tr>
                    <td>
                        <div class="form-outline mb-2">
                            Tên người nhận <input name="name" type="text" class="form-control-sm" required/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a class="btn btn-primary" href="index.php">Quay lại</a>
                        <button class="btn btn-primary" type="submit">Thêm</button>
                    </td>
                </tr>
                </form>
                </td>
                </tr>
                </tbody>
        </div>
    </div>
</div>
</body>
</html>
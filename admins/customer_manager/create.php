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
    <title>Thêm khách hàng</title>
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
                                <label>Email</label>
                                <input name="email" type="email" class="form-control-sm" required/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-outline mb-2">
                                <label>SĐT</label>
                                <input name="phone" type="text" class="form-control-sm"/>
                            </div>
                        </td>
                        <td>
                            <div class="form-outline mb-2">
                                <label>Mật khẩu</label>
                                <input name="password" type="text" class="form-control-sm" required/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="form-outline mb-2">
                                <label>Địa chỉ</label>
                                <input name="address" type="text" class="form-control-sm" required/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="form-outline mb-2">
                                <label style="margin-right: 24px;">Giới tính</label>
                                <div style="display: inline-block">
                                    <input class="form-check-input" type="radio" name="gender" value="Male"
                                           id="flexRadioDefault1" checked>
                                    Nam
                                </div>

                                <div style="display: inline-block; margin-left: 24px">
                                    <input class="form-check-input" type="radio" name="gender" value="Female"
                                           id="flexRadioDefault2">
                                    Nữ
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <a class="btn btn-primary" href="index.php">Quay lại</a>
                            <button class="btn btn-primary" type="submit">Thêm</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>

</body>
</html>
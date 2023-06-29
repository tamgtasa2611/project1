<?php
session_start();
//Kiem tra xem user da login hay chua
if (isset($_SESSION['user-email'])) {
    header("Location: ../start/index.php");
}
//kiem tra dang ky
$success = 0;
$user = 0;
$invalid = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once("../../connect/open.php");
    $userName = $_POST['user-name'];
    $userEmail = $_POST['user-email'];
    $userPassword = $_POST['user-password'];
    $confirmPassword = $_POST['confirm-password'];
    $userPhone = $_POST['user-phone'];
    $userAddress = $_POST['user-address'];
    $userGender = $_POST['user-gender'];
    //query kiem tra email da dang ky hay chua
    $user_check_query = "SELECT * FROM customers WHERE email = '$userEmail' LIMIT 1";
    $results = mysqli_query($connect, $user_check_query);
    //
    if ($results) {
        $num = mysqli_num_rows($results);
        if ($num > 0) {
            $user = 1;
        } else {
            if ($userPassword === $confirmPassword) {
                $insert = "insert into customers (name, email, password, phone, gender, address)
                    values('$userName', '$userEmail', '$userPassword', '$userPhone', '$userGender', '$userAddress')";
                $results = mysqli_query($connect, $insert);
                if ($results) {
                    $success = 1;
                }
            } else {
                $invalid = 1;
            }
        }
    }
}
include_once("../../connect/close.php");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- bootstrap file link -->
    <link rel="stylesheet" href="../../main/css/bootstrap.css">
    <!-- header css file link -->
    <link rel="stylesheet" href="../../main/css/header_style.css">
    <!-- register   -->
    <link rel="stylesheet" href="../../main/css/register.css">
    <!--    main    -->
    <link rel="stylesheet" href="../../main/css/main_style.css">

    <title>Đăng ký</title>
</head>
<body>
<!-- Header -->
<?php
include("../../layout/header.php");
?>
<!-- Padding from header -->
<div id="about"></div>

<!-- main -->
<div id="outer-div" class="position-relative">
    <!-- Thong bao dang ky-->
    <?php
    if ($user) {
        echo '<div class="alert alert-danger position-absolute error-alert" role="alert">
              Email đã được sử dụng!
              </div>';
    }
    ?>

    <?php
    if ($success) {
        header("Location: thankyou.php");
    }
    ?>

    <?php
    if ($invalid) {
        echo '<div class="alert alert-danger position-absolute error-alert" role="alert">
              Mật khẩu không trùng khớp!
              </div>';
    }
    ?>
    <div class="res-page">
        <div class="form">
            <form class="register-form" method="post">
                <input type="text" name="user-name" placeholder="Tên" required/>
                <input type="text" name="user-email" placeholder="Địa chỉ email" required/>
                <input id="pwd1" type="password" name="user-password" placeholder="Mật khẩu" required/>
                <input id="pwd2" type="password" name="confirm-password" placeholder="Nhập lại mật khẩu" required/>
                <input type="text" name="user-phone" placeholder="Số điện thoại" required/>
                <input type="text" name="user-address" placeholder="Địa chỉ" required/>
                <div style="display: flex; justify-content: space-between;">
                    Giới tính
                    <div class="d-flex">
                        <div class="form-check">
                            <input type="radio" name="user-gender" value="1" checked style="width: auto"/> Nam
                        </div>

                        <div class="form-check">
                            <input type="radio" name="user-gender" value="0" style="width: auto"/> Nữ
                        </div>
                    </div>
                </div>
                <button type="submit">ĐĂNG KÝ</button>
                <p class="message">Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
            </form>

        </div>
    </div>
</div>
<!---->

<?php
include("../../layout/footer.php");
?>

</body>
</html>
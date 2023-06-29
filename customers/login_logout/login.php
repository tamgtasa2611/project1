<?php
session_start();
//Kiem tra xem user da login hay chua
if (isset($_SESSION['user-email'])) {
    header("Location: ../start/index.php");
}
/*
//kiem tra login
$login = 0;
$invalid = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once '../../connect/open.php';
    $userEmail = $_POST['user-email'];
    $userPassword = $_POST['user-password'];
//query tim account
    $sql = "SELECT *, COUNT(id) as count_account FROM customers 
                    WHERE email = '$userEmail' AND password = '$userPassword'";
    $results = mysqli_query($connect, $sql);

    foreach($results as $result) {
        $userId = $result['id'];
    }
//
    if ($results) {
        $num = mysqli_num_rows($results);
        if ($num > 0) {
            $login = 1;
        } else {
            $invalid = 1;
        }
    }
}
*/
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
    <!-- login   -->
    <link rel="stylesheet" href="../../main/css/login.css">
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
    <!-- Thong bao dang nhap-->
    <?php
    if (isset($_SESSION['error-msg'])) {
        echo '<div class="alert alert-danger position-absolute error-alert" role="alert">
              Email hoặc mật khẩu không tồn tại!
              </div>';
    }
    ?>

    <div class="login-page">
        <div class="form">
            <form class="register-form" method="post" action="loginProcess.php">
                <input type="text" name="user-email" placeholder="Địa chỉ email" required/>
                <input type="password" name="user-password" placeholder="Mật khẩu" required/>

                <button type="submit">ĐĂNG NHẬP</button>
                <p class="message">Chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
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
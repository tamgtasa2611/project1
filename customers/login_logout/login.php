<?php
session_start();
//Kiem tra xem user da login hay chua
if (isset($_SESSION['user-email'])) {
    header("Location: ../start/index.php");
}
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

    <title>Login - Beautiful House</title>
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
    if (!isset($_SESSION['error-msg'])) {
        $_SESSION['error-msg'] = 0;
    }
    if ($_SESSION['error-msg'] == 1) {
        echo '<div id="close-target" class="alert alert-danger position-absolute error-alert" role="alert">
              Wrong email or password!
              <i id="click-close" class="fa-solid fa-x" style="font-size: 12px; padding: 8px" onclick="closeMes()"></i>
              </div>';
        $_SESSION['error-msg'] = 0;
    }
    ?>

    <script>
        let clickClose = document.getElementById('click-close');
        let closeTarget = document.getElementById('close-target')

        function closeMes() {
            closeTarget.classList.add("d-none");
        }
    </script>

    <div class="login-page">
        <div class="form">
            <form class="register-form" method="post" action="loginProcess.php">
                <input type="text" name="user-email" placeholder="Email" required/>
                <input type="password" name="user-password" placeholder="Password" required/>

                <button type="submit">Login</button>
                <p class="message">New to Beautiful House? <a href="register.php">Register</a></p>
                <p class="message"><a href="forget_pwd.php" style="font-size: 14px">Forgot password</a></p>
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
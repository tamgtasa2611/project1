<?php
session_start();
if (isset($_SESSION['email'])) {
    header("Location: ../manager/index.php");
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
    <link rel="stylesheet" href="../../main/css/bootstrap.css">
    <link rel="stylesheet" href="../../main/css/admin.css">
    <link rel="stylesheet" href="../../main/css/admin_login.css">

    <title>Log in</title>
</head>
<body>
<!--            thong bao login -->
<?php
if (!isset($_SESSION['failed'])) {
    $_SESSION['failed'] = 0;
}
?>

<section class="vh-100" id="admin-login" class="position-relative">
    <?php
    if ($_SESSION['failed'] === 1) {
        echo '<div id="close-target" class="alert alert-danger position-absolute" role="alert"
                style="top: 5%; right: 2%; box-shadow: 1px 1px red; animation: fadeOut 5s;">
              Wrong email or password!
              <i id="click-close" class="fa-solid fa-x" style="font-size: 12px; padding: 8px; cursor: pointer" onclick="closeMes()"></i>
              </div>';
        $_SESSION['failed'] = 0;
    }
    ?>
    <div class="login-page">
        <div class="form">
            <div>
                <img src="../../main/media/images/logo.png" alt="" style="width: 100%; padding: 0px 20px 48px 20px">
            </div>
            <form class="register-form" method="post" action="loginProcess.php">
                <input type="text" name="email" placeholder="Email" required/>
                <input type="password" name="password" placeholder="Password" required/>

                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</section>
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
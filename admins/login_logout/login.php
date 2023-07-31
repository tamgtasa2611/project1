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
    <link rel="stylesheet" href="../../main/css/bootstrap.css">
    <link rel="stylesheet" href="../../main/css/admin.css">
    <link rel="stylesheet" href="../../main/css/admin_login.css">

    <title>Log in</title>
</head>
<body>
<section class="vh-100" id="admin-login">
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
</body>
</html>
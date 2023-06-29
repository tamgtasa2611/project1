<?php
//    chay session
session_start();
if (!isset($_SESSION['user-email'])) {
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
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- bootstrap file link -->
    <link rel="stylesheet" href="../../main/css/bootstrap.css">
    <!-- header css file link -->
    <link rel="stylesheet" href="../../main/css/header_style.css">
    <!--  main css file link  -->
    <link rel="stylesheet" href="../../main/css/main_style.css">

    <title>Tài khoản của tôi</title>
</head>
<body>
<!-- Header -->
<?php
include("../../layout/header.php");
?>
<!-- Padding from header -->
<div id="about"></div>
<!--Content -->
<div>
    <?php
    include_once("../../layout/customer_profile.php");
    ?>
    <div>
        a
    </div>
</div>

</body>
</html>

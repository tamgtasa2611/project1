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
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../main/css/bootstrap.css">
    <link rel="stylesheet" href="../../main/css/admin.css">

    <title>Order created successfully</title>
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
            <div class="d-flex align-items-center text-center flex-column"
                 style="background-color: white; width: 35%; height: 400px; margin: auto; border-radius: 12px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                <div style="background-color: yellowgreen; height: 50%; width: 100%; border-radius: 12px 12px 0px 0px"
                     class="d-flex flex-column justify-content-end">
            <span class="fa-regular fa-circle-check w-100"
                  style="color: #ffffff; height: 50%; font-size: 80px">
            </span>
                    <div style="width: 100%; height: 30%; font-size: 20px" class="text-white">
                        Success
                    </div>
                </div>
                <div style="height: 50%; width: 100%"
                     class="d-flex flex-column align-items-center justify-content-center">
                    <div style="height: 40%; font-size: 18px;color: black;">
                        A new order has been created!
                    </div>
                    <a href="index.php" class="btn btn-order-success">
                        Back</a>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>

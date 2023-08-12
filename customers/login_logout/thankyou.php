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
    <!--    main    -->
    <link rel="stylesheet" href="../../main/css/main_style.css">

    <title>Register successfully</title>
</head>

<body>
<!-- Header -->
<?php
include("../../layout/header.php");
?>
<!-- Padding from header -->
<div id="about"></div>

<!---->
<div class="w-100 d-flex" style=" height: 89.5vh">
    <div class="d-flex align-items-center text-center flex-column"
         style="background-color: white; width: 25%; height: 400px; margin: auto; border-radius: 12px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
        <div style="background-color: yellowgreen; height: 50%; width: 100%; border-radius: 12px 12px 0px 0px"
             class="d-flex flex-column justify-content-end">
            <span class="fa-regular fa-circle-check w-100"
                  style="color: #ffffff; height: 50%; font-size: 80px">
            </span>
            <div style="width: 100%; height: 30%; font-size: 20px" class="text-white">
                Registered successfully
            </div>
        </div>
        <div style="height: 50%; width: 100%" class="d-flex flex-column align-items-center justify-content-center">
            <div style="height: 40%">
                Thank you for register on our website! <br>
            </div>
            <a href="login.php" class="btn btn-order-success">
                Go to Login</a>
        </div>
    </div>
</div>
<!---->

<?php
include("../../layout/footer.php");
?>

</body>
</html>
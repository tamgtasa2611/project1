<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
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

    <title>Support - Beautiful House</title>
</head>
<body style="background-color: #FFFFFF">
<!-- Header -->
<?php
include("../../layout/header.php");
?>
<!-- Padding from header -->
<div id="about"></div>


<!--support letter-->
<div style="height: 80vh; width: 81%; margin: auto; border-radius: 12px; background-color: whitesmoke;
     box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px; overflow: hidden !important;"
     class="mt-5 d-flex">
    <form method="post" action="customer_support_email/send_email_to_admin.php" class="w-50 h-100 p-5">
        <div class="d-flex justify-content-between">
            <div style="width: 45%">
                <div>Name</div>
                <div class="mt-2">
                    <input type="text" name="name" class="w-100 form-control-lg" style="border: 1px solid #2d2d2d"
                           required>
                </div>
            </div>
            <div style="width: 45%">
                <div>Email</div>
                <div class="mt-2">
                    <input type="email" name="email" class="w-100 form-control-lg" style="border: 1px solid #2d2d2d"
                           required>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <div>Subject</div>
            <div class="mt-2">
                <input type="" name="subject" class="w-100 form-control-lg" style="border: 1px solid #2d2d2d" required>
            </div>
        </div>

        <div class="mt-4">
            <div>Message</div>
            <div class="mt-2">
                <textarea name="message" rows="10" class="w-100 form-control-lg"
                          style="border: 1px solid #2d2d2d; height: 264px" required>

                </textarea>
            </div>
        </div>
        <div class="mt-5">
            <button class="btn btn-dark" style="font-size: 16px">Send</button>
        </div>
    </form>
    <div class="w-50 h-100">
        <img src="../../main/media/images/support.jpg" class="w-100">
    </div>
</div>


<!-- Footer -->
<?php
include("../../layout/footer.php");
?>
</body>
</html>

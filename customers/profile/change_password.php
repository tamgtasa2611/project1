<?php
//    chay session
session_start();
if (!isset($_SESSION['user-id'])) {
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
    <!--    profile css file link   -->
    <link rel="stylesheet" href="../../main/css/profile.css">

    <title>Change password - Beautiful House</title>
</head>
<body>

<!-- Header -->
<?php
include("../../layout/header.php");
?>
<!-- Padding from header -->
<div id="about"></div>
<!--Content -->
<div id="main-container" class="mt-5">
    <div id="left-container">
        <?php
        include_once("../../layout/customer_profile.php");
        ?>

    </div>

    <div id="right-container">
        <form action="update_password.php" method="post">
            <div style="height: auto; margin: 40px">
                <div>
                    <h2>
                        Change password
                    </h2>
                    <h4 style="color: slategray; margin-bottom: 40px">
                        Change your password every 3 months for security...
                    </h4>
                    <hr>
                </div>

                <?php
                if (!isset($_SESSION['cpwd-error'])) {
                    $_SESSION['cpwd-error'] = 0;
                }
                if (!isset($_SESSION['npwd-error'])) {
                    $_SESSION['npwd-error'] = 0;
                }
                if (!isset($_SESSION['change-success'])) {
                    $_SESSION['change-success'] = 0;
                }

                $cpwdError = $_SESSION['cpwd-error'];
                $npwdError = $_SESSION['npwd-error'];
                $changeSuccess = $_SESSION['change-success'];

                if ($cpwdError === 1) {
                    ?>
                    <div class="alert-danger p-3">Current password does not match!</div>
                    <?php
                    $_SESSION['cpwd-error'] = 0;
                } else if ($npwdError === 1) {
                    ?>
                    <div class="alert-danger p-3">The new password is the same as the current password!</div>
                    <?php
                    $_SESSION['npwd-error'] = 0;
                } else if ($changeSuccess === 1) {
                    ?>
                    <div class="alert-success p-3">Change password successfully!</div>
                    <?php
                    $_SESSION['change-success'] = 0;
                }
                ?>

                <div class="d-flex justify-content-between" style="margin-top: 28px">
                    <div style="width: 43%;">
                        <div class="padding-nice d-flex justify-content-between align-items-center">
                            Current password: <input type="password" name="cpwd" required minlength="6" id="cpwd">
                            <i class="fa-solid fa-eye-slash" id="togglePassword"></i>
                        </div>

                    </div>

                    <div style="width: 40%">
                        <div class="padding-nice d-flex justify-content-between align-items-center">
                            New password: <input type="password" name="npwd" required minlength="6" id="npwd">
                            <i class="fa-solid fa-eye-slash" id="togglePassword2"></i>
                        </div>
                    </div>
                </div>

                <?php
                include_once("../../connect/close.php");
                ?>

                <div style="margin-top: 9.4%" class="d-flex justify-content-center">
                    <button id="save-btn">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!--footer-->
<?php
include_once("../../layout/footer.php");
?>

<!--hien thi mat khau-->
<script>
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#cpwd");

    togglePassword.addEventListener("click", function () {
        // toggle the type attribute
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);

        // toggle the icon
        this.classList.toggle("fa-eye");
    });

    const togglePassword2 = document.querySelector("#togglePassword2");
    const password2 = document.querySelector("#npwd");

    togglePassword2.addEventListener("click", function () {
        // toggle the type attribute
        const type = password2.getAttribute("type") === "password" ? "text" : "password";
        password2.setAttribute("type", type);

        // toggle the icon
        this.classList.toggle("fa-eye");
    });
</script>

</body>
</html>

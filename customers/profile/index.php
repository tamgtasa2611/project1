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

    <title>My account - Beautiful House</title>
</head>
<body>
<?php
$userId = $_SESSION['user-id'];
include_once("../../connect/open.php");
$sql = "SELECT * FROM customers WHERE id = '$userId'";
$customers = mysqli_query($connect, $sql);
?>

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
        <form action="update.php" method="post">
            <div style="height: auto; margin: 40px">
                <div>
                    <h2>
                        My profile
                    </h2>
                    <h4 style="color: slategray; margin-bottom: 40px">
                        Manage profile information for account security
                    </h4>
                    <hr>
                </div>

                <?php
                foreach ($customers as $customer) {
                    ?>
                    <div class="d-flex justify-content-between" style="margin-top: 28px">
                        <div style="width: 40%;">
                            <div class="padding-nice d-flex justify-content-between align-items-center">
                                Name: <input type="text" name="name" value="<?= $customer['name'] ?>">
                            </div>

                            <div class="padding-nice d-flex justify-content-between align-items-center">
                                Email: <input type="email" name="email" value="<?= $customer['email'] ?>">
                            </div>

                            <div class="padding-nice d-flex justify-content-between align-items-center">
                                Phone number: <input type="text" name="phone" value="<?= $customer['phone'] ?>">
                            </div>

                            <div class="padding-nice d-flex justify-content-between align-items-center">
                                Gender:
                                <div class="d-flex justify-content-evenly" style="width: 240px">
                                    <input type="radio" class="radio-input" name="gender" value="male"
                                        <?php
                                        if ($customer['gender'] == 1) {
                                            echo "checked";
                                        }
                                        ?>
                                    >Male

                                    <input type="radio" class="radio-input" name="gender" value="female"
                                        <?php
                                        if ($customer['gender'] == 0) {
                                            echo "checked";
                                        }
                                        ?>
                                    >Female
                                </div>
                            </div>

                            <div class="padding-nice d-flex justify-content-between align-items-center">
                                Address: <input type="text" name="address" value="<?= $customer['address'] ?>">
                            </div>

                        </div>
                        <div style="width: 30%">
                            <?php
                            if (!isset($_SESSION['update_profile'])) {
                                $_SESSION['update_profile'] = 0;
                            }
                            if ($_SESSION['update_profile'] === 1) {
                                echo '<div id="close-target" class="alert alert-success" role="alert">
                                Update profile successfully! 
                                <i id="click-close" class="fa-solid fa-x" style="font-size: 12px; padding: 8px; margin-left: 24px" 
                                onclick="closeMes()"></i>
                                </div>';
                                $_SESSION['update_profile'] = 0;
                            }
                            ?>
                        </div>
                    </div>

                    <?php
                }
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

<script>
    let clickClose = document.getElementById('click-close');
    let closeTarget = document.getElementById('close-target')

    function closeMes() {
        closeTarget.classList.add("d-none");
    }
</script>
</body>
</html>

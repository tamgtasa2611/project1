<div style="height: 100%; margin: 40px 20px;">
    <?php
    $userId = $_SESSION['user-id'];
    include_once("../../connect/open.php");
    $sql = "SELECT * FROM customers where id = '$userId'";
    $customers = mysqli_query($connect, $sql);
    foreach ($customers as $customer) {
        ?>

        <div class="text-center" style="margin-bottom: 40px">
            <h2>
                Welcome, <br>
                <?= $customer['name'] ?>
            </h2>
        </div>

        <?php
    }
    ?>

    <div>
        <ul class="list-unstyled">
            <hr>
            <li>
                <a href="../profile/index.php"><i class="fa-solid fa-gear me-3"></i>My account</a>
            </li>
            <hr>
            <li>
                <a href="../profile/order_history.php"><i class="fa-solid fa-file me-3"></i>My orders</a>
            </li>
            <hr>
            <li>
                <a href="../profile/change_password.php"><i class="fa-solid fa-key me-3"></i>Change password</a>
            </li>
            <hr>
            <li>
                <a href="../login_logout/logout.php" style="color: red">
                    <i class="fa-solid fa-arrow-right-from-bracket me-3"></i>Log out</a>
            </li>
            <hr>
        </ul>
    </div>
</div>
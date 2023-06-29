<header class="header p-2">
    <div class="container">
        <section class>
            <div class="row">
                <!--LOGO-->
                <a class="navbar-brand col-2 logo m-auto" href="../start/index.php">
                    <img
                            src="../../main/media/images/logo.png"
                            height="64"
                            alt="Logo"
                            loading="lazy"
                    />
                </a>

                <hr class="w-100 clearfix d-md-none">
                <!--MENU-->
                <nav class="navbar col-6 m-auto">
                    <a href="../category/index.php">Categories</a>
                    <a href="../furniture/index.php">Products</a>
                    <a href="../producer/index.php">Collection</a>
                    <a href="../inspiration/index.php">Inspiration</a>
                    <a href="../start/about.php">About us</a>
                </nav>

                <hr class="w-100 clearfix d-md-none">
                <!--CART & ACCOUNT-->
                <div class="icons col-2 m-auto">
                    <a href="../carts/index.php">
                        <div class="fas fa-shopping-cart" id="cart-btn"></div>
                    </a>
                    <!--                    kiem tra xem user da login hay chua-->
                    <?php
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    if (!isset($_SESSION['user-email'])) {
                        ?>
                        <a href="../login_logout/login.php">
                            <div class="fas fa-user" id="login-btn"></div>
                        </a>
                        <?php
                    } else {
                        ?>
                        <a href="../profile/index.php">
                            <div class="fas fa-user" id="login-btn"></div>
                        </a>
                        <a href="../login_logout/logout.php">
                            <div class="fas fa-sign-out" id="sign-out-btn"></div>
                        </a>
                        <?php
                    }
                    ?>

                </div>

            </div>
        </section>
    </div>
</header>

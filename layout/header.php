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

                <!--MENU-->
                <nav class="navbar col-5">
                    <a href="../category/index.php">Categories</a>
                    <a href="../furniture/index.php">Products</a>
                    <a href="../producer/index.php">Collection</a>
                    <a href="../inspiration/index.php">Inspiration</a>
                </nav>

                <!--CART & ACCOUNT-->
                <div class="icons col-1 m-auto d-flex justify-content-between">
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
                <!--  SEARCH BAR -->
                <?php
                //search form
                $search = "";
                if (isset($_GET['search'])) {
                    $search = $_GET['search'];
                }
                ?>
                <div class="col-2 m-auto wrap">
                    <form action="../furniture/search.php" method="get">
                        <div class="search">
                            <input type="text" class="searchTerm" name="search" placeholder="Search here..."
                                   value="<?= $search ?>">
                            <button type="submit" class="searchButton">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</header>

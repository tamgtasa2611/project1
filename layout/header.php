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
                    <div class="dropdown h-100">
                        <a href="../category/index.php" class="d-flex align-items-center h-100">Categories</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="../category/table.php">Table</a></li>
                            <li><a class="dropdown-item" href="../category/seating.php">Seating</a></li>
                            <li><a class="dropdown-item" href="../category/bed.php">Bed</a></li>
                            <li><a class="dropdown-item" href="../category/wardrobe.php">Wardrobe</a></li>
                            <li><a class="dropdown-item" href="../category/bookshelf.php">Bookshelf</a></li>
                            <li><a class="dropdown-item" href="../category/clock.php">Clock</a></li>
                        </ul>
                    </div>
                    <a href="../furniture/index.php">Products</a>
                    <div class="dropdown h-100">
                        <a href="../producer/index.php" class="h-100 d-flex align-items-center">Collection</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="../producer/one.php">IKEA</a></li>
                            <li><a class="dropdown-item" href="../producer/two.php">Herman Miller</a></li>
                            <li><a class="dropdown-item" href="../producer/three.php">Crate & Barrel</a></li>
                            <li><a class="dropdown-item" href="../producer/four.php">Steelcase</a></li>
                            <li><a class="dropdown-item" href="../producer/five.php">Restoration Hardware</a></li>
                            <li><a class="dropdown-item" href="../producer/six.php">Okamura</a></li>
                        </ul>
                    </div>
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
                        <div class="dropdown h-100">
                            <a href="../profile/index.php">
                                <div class="fas fa-user h-100 d-flex align-items-center justify-content-center"
                                     id="login-btn"></div>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                            style="width: 136px; padding-right: 0;">
                                <li><a class="dropdown-item orange-hover" href="../profile/index.php">My profile</a></li>
                                <li><a class="dropdown-item orange-hover" href="../profile/order_history.php">Order history</a></li>
                                <li><a class="dropdown-item orange-hover" href="../login_logout/logout.php">Log out</a></li>
                            </ul>
                        </div>

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

<body>
    <!-- Page Preloder -->
    <!--<div id="preloder">-->
    <!--    <div class="loader"></div>-->
    <!--</div>-->

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <?php
                                if (isset($_SESSION['admin'])) {
                                    $admin = $_SESSION['admin'];
                                    echo '<a href="index.php?page=panel"><i class="fa fa-user-circle" aria-hidden="true"></i>  ' . $admin->ime . '  ' . $admin->prezime . '</a><a href="models/logout.php">Log Out</a>';
                                } elseif (isset($_SESSION['user'])) {
                                    $user = $_SESSION['user'];
                                    echo '<a href="index.php?page=user"><i class="fa fa-user-circle" aria-hidden="true"></i>  ' . $user->ime . '  ' . $user->prezime . '</a><a href="models/logout.php">Log Out</a>';
                                } else {
                                    echo '<a href="index.php?page=login">Log in</a>
                            <a href="index.php?page=register">Sign Up</a>';
                                }
                                ?>
                                <a href="index.php?page=faq">FAQs</a>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="assets/img/icon/search.png" alt=""></a>
            <a href="index.php?page=wishlist"><img src="assets/img/icon/heart.png" alt=""></a>
            <a href="index.php?page=cart"><img src="assets/img/icon/cart.png" alt=""> <span>0</span></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Free shipping, 7-day return or refund guarantee.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                <?php
                                if (isset($_SESSION['admin'])) {
                                    $admin = $_SESSION['admin'];
                                    echo '<a href="index.php?page=panel"><i class="fa fa-user-circle" aria-hidden="true"></i>  ' . $admin->ime . '  ' . $admin->prezime . '</a><a href="models/logout.php">Log Out</a>';
                                } elseif (isset($_SESSION['user'])) {
                                    $user = $_SESSION['user'];
                                    echo '<a href="index.php?page=user"><i class="fa fa-user-circle" aria-hidden="true"></i>  ' . $user->ime . '  ' . $user->prezime . '</a><a href="models/logout.php">Log Out</a>';
                                } else {
                                    echo '<a href="index.php?page=login">Log in</a>
                            <a href="index.php?page=register">Sign Up</a>';
                                }
                                ?>
                                <a href="index.php?page=faq">FAQs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="index.php?page=home"><img src="assets/img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <?php
                            $navlinks = fetchAll('navlinks');
                            if (isset($_GET['page'])) {
                                $data = $_GET['page'];
                            } else {
                                $data = 'home';
                            }
                            echo '<div id="stranica" data-page="' . $data . '"></div>';
                            foreach ($navlinks as $link) :

                            ?>
                                <li class=""><a class="ses" data-curr="<?= $link->linktag ?>" href="<?= $link->link ?>"><?= $link->naziv ?></a></li>

                            <?php
                            endforeach;
                            ?>
                            <!--                            <li><a href="./index.php?page=shop">Shop</a></li>-->
                            <!--                            <li><a href="#">Pages</a>-->
                            <!--                                <ul class="dropdown">-->
                            <!--                                    <li><a href="./index.php?page=about">About Us</a></li>-->
                            <!--                                    <li><a href="./shop-details.html">Shop Details</a></li>-->
                            <!--                                    <li><a href="./shopping-cart.html">Shopping Cart</a></li>-->
                            <!--                                    <li><a href="./checkout.html">Check Out</a></li>-->
                            <!--                                    <li><a href="./blog-details.html">Blog Details</a></li>-->
                            <!--                                </ul>-->
                            <!--                            </li>-->
                            <!--                            <li><a href="./blog.html">Blog</a></li>-->
                            <!--                            <li><a href="./contact.html">Contacts</a></li>-->
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <?php
                        if(isset($_SESSION['user'])){
                           echo '<a href="index.php?page=wishlist"><img src="assets/img/icon/heart.png" alt=""></a>';
                        }
                        if (isset($_SESSION['sum']) && isset($_SESSION['info'])) {
                            echo '
<a href="index.php?page=cart"><img src="assets/img/icon/cart.png" alt=""> <span>' . $_SESSION['info']->quan . '</span></a>
<div class="price">' . $_SESSION['info']->sum . ' RSD</div>';
                        } else {
                            echo '
<a href="index.php?page=cart"><img src="assets/img/icon/cart.png" alt=""> <span>0</span></a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->
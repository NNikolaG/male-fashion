<?php
if (isset($_GET['page'])) {
    zabeleziPristupStranici($_GET['page']);
}
?>
<!-- Hero Section Begin -->
<section class="hero">
    <div class="hero__slider owl-carousel">
        <div class="hero__items set-bg" data-setbg="assets/img/hero/hero-1.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Fall Collection</h6>
                            <h2>Fall - Winter Collections 2022</h2>
                            <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                commitment to exceptional quality.</p>
                            <a href="index.php?page=shop" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>
                                <a href="https://www.pinterest.com/" target="_blank"><i class="fa fa-pinterest"></i></a>
                                <a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero__items set-bg" data-setbg="assets/img/hero/hero-2.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Summer Collection</h6>
                            <h2>Summer Collections 2022</h2>
                            <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                commitment to exceptional quality.</p>
                            <a href="index.php?page=shop" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>
                                <a href="https://www.pinterest.com/" target="_blank"><i class="fa fa-pinterest"></i></a>
                                <a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Banner Section Begin -->
<section class="banner spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-4">
                <div class="banner__item">
                    <div class="banner__item__pic">
                        <img src="assets/img/banner/banner-1.jpg" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Clothing Collections 2022</h2>
                        <a href="index.php?page=shop">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="banner__item banner__item--middle">
                    <div class="banner__item__pic">
                        <img src="assets/img/banner/banner-2.jpg" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Accessories</h2>
                        <a href="index.php?page=shop">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="banner__item banner__item--last">
                    <div class="banner__item__pic">
                        <img src="assets/img/banner/banner-3.jpg" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Shoes Spring 2022</h2>
                        <a href="index.php?page=shop">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter=".hot-sales">Best Reviews</li>
                    <li data-filter=".new-arrivals">New Arrivals</li>
                </ul>
            </div>
        </div>
        <div class="row product__filter">
            <?php
            $bestReviews = bestReviews();
            foreach ($bestReviews as $best) :
            ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="assets/img/product/<?= $best->nazivSlike ?>">
                            <ul class="product__hover">
                                <li>
                                    <a href="#"><img src="assets/img/icon/heart.png" alt=""><span>Wishlist</span></a>
                                </li>
                                <li>
                                    <a href="index.php?page=details&prod=<?= $best->idProdukt ?>"><img src="assets/img/icon/compare.png" alt=""> <span>Details</span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><?= $best->imeProdukta ?></h6>
                            <a href="#" class="add-cart">+ Add To Cart</a>
                            <?php
                            $result = getRating($best->idProdukt);
                            $average = getAverage($result);

                            echo '<div class="rating">';
                            for ($i = 0; $i < $average; $i++) {
                                echo '<i class="fa fa-star"></i>&nbsp';
                            }
                            for ($j = 0; $j < 5 - $average; $j++) {
                                echo '<i class="fa fa-star-o"></i>&nbsp';
                            }
                            echo '<span> - ' . count($result) . ' Reviews</span>';
                            ?>
                        </div>
                        <h5><?= $best->nova ?> RSD</h5>
                        <div class="product__color__select">
                            <?php
                            $colors = getColors($best->idProdukt);
                            foreach ($colors as $color) :
                            ?>
                                <label for="pc-4" style="background-color: <?= $color->rgb ?>">
                                    <input type="radio" id="pc-4" disabled>
                                </label>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
        </div>
    <?php
            endforeach;
    ?>
    <?php
    $newArrivals = newArrivals();
    $newArrivals = array_slice($newArrivals, 0, 4);
    foreach ($newArrivals as $new) :
    ?>
        <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals" style="display: none;">
            <div class="product__item">
                <div class="product__item__pic set-bg" data-setbg="assets/img/product/<?= $new->nazivSlike ?>">
                    <ul class="product__hover">
                        <li>
                            <a href="#"><img src="assets/img/icon/heart.png" alt=""><span>Wishlist</span></a>
                        </li>
                        <li>
                            <a href="index.php?page=details&prod=<?= $new->idProdukt ?>"><img src="assets/img/icon/compare.png" alt=""> <span>Details</span></a>
                        </li>
                    </ul>
                </div>
                <div class="product__item__text">
                    <h6><?= $new->imeProdukta ?></h6>
                    <a href="#" class="add-cart">+ Add To Cart</a>
                    <?php
                    $result = getRating($new->idProdukt);
                    $average = getAverage($result);

                    echo '<div class="rating">';
                    for ($i = 0; $i < $average; $i++) {
                        echo '<i class="fa fa-star"></i>&nbsp';
                    }
                    for ($j = 0; $j < 5 - $average; $j++) {
                        echo '<i class="fa fa-star-o"></i>&nbsp';
                    }
                    echo '<span> - ' . count($result) . ' Reviews</span>';
                    ?>
                </div>
                <h5><?= $new->nova ?> RSD</h5>
                <div class="product__color__select">
                    <?php
                    $colors = getColors($new->idProdukt);
                    foreach ($colors as $color) :
                    ?>
                        <label for="pc-4" style="background-color: <?= $color->rgb ?>">
                            <input type="radio" id="pc-4" disabled>
                        </label>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
    endforeach;
?>
</div>
</div>
</section>
<!-- Product Section End -->

<!-- Categories Section Begin -->
<section class="categories spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="categories__text">
                    <h2>Shoe Collection<br /> <span>Clothings Hot</span> <br /> Accessories</h2>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="categories__hot__deal">
                    <img src="assets/img/product-sale.png" alt="">
                    <div class="hot__deal__sticker">
                        <span>Sale Of</span>
                        <h5>599 RSD</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1">
                <div class="categories__deal__countdown">
                    <span>Deal Of The Week</span>
                    <h2>Multi-pocket Chest Bag Black</h2>
                    <div class="categories__deal__countdown__timer" id="countdown">
                        <div class="cd-item">
                            <span>3</span>
                            <p>Days</p>
                        </div>
                        <div class="cd-item">
                            <span>1</span>
                            <p>Hours</p>
                        </div>
                        <div class="cd-item">
                            <span>50</span>
                            <p>Minutes</p>
                        </div>
                        <div class="cd-item">
                            <span>18</span>
                            <p>Seconds</p>
                        </div>
                    </div>
                    <a href="index.php?page=shop" class="primary-btn">Shop now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Instagram Section Begin -->
<section class="instagram spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="instagram__pic">
                    <div class="instagram__pic__item set-bg" data-setbg="assets/img/instagram/instagram-1.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="assets/img/instagram/instagram-2.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="assets/img/instagram/instagram-3.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="assets/img/instagram/instagram-4.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="assets/img/instagram/instagram-5.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="assets/img/instagram/instagram-6.jpg"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="instagram__text">
                    <h2>Instagram</h2>
                    <p>Visit our instagram page where you can find various clothing combinations that include our products and models</p>
                    <h3>#Male_Fashion</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Instagram Section End -->

<!-- Latest Blog Section Begin -->
<section class="latest spad">
    <div class="container">
    </div>
</section>
<!-- Latest Blog Section End -->
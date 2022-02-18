<?php
if (isset($_GET['prod'])) :
    //    unset($_SESSION['cart']);
    $boje = fetchAllProducts('bo.idBoja', $_GET['prod']);
    $velicine = fetchAllProducts('v.idVelicina', $_GET['prod']);
    $slike = fetchAllProducts('s.idSlika', $_GET['prod']);
    $tagovi = fetchAllProducts('t.idTag', $_GET['prod']);

    zabeleziPristupStranici($_GET['page']);

?>
    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="index.php?page=home">Home</a>
                            <a href="index.php?page=shop">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <?php
                            $rb = 0;
                            foreach ($slike as $slika) {
                                if (isset($_GET['color'])) {
                                    if ($_GET['color'] == $slika->bojaX) {
                                        $rb++;
                                        if ($rb == 1) {
                                            echo '<li class="nav-item active">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-' . $rb . '" role="tab">
                                        <div class="product__thumb__pic set-bg"
                                             data-setbg="assets/img/product/' . $slika->nazivSlike . '">
                                        </div>
                                    </a>
                                </li>';
                                        } else {
                                            echo '<li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-' . $rb . '" role="tab">
                                        <div class="product__thumb__pic set-bg"
                                             data-setbg="assets/img/product/' . $slika->nazivSlike . '">
                                        </div>
                                    </a>
                                </li>';
                                        }
                                    }
                                } else {
                                    if ($boje[0]->idBoja == $slika->bojaX) {
                                        $rb++;
                                        if ($rb == 1) {
                                            echo '<li class="nav-item active">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-' . $rb . '" role="tab">
                                        <div class="product__thumb__pic set-bg"
                                             data-setbg="assets/img/product/' . $slika->nazivSlike . '">
                                        </div>
                                    </a>
                                </li>';
                                        } else {
                                            echo '<li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-' . $rb . '" role="tab">
                                        <div class="product__thumb__pic set-bg"
                                             data-setbg="assets/img/product/' . $slika->nazivSlike . '">
                                        </div>
                                    </a>
                                </li>';
                                        }
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">

                            <?php
                            $rb = 0;
                            foreach ($slike as $slika) {
                                if (isset($_GET['color'])) {
                                    if ($_GET['color'] == $slika->bojaX) {
                                        $rb++;
                                        if ($rb == 1) {
                                            echo '<div class="tab-pane active" id="tabs-' . $rb . '" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="assets/img/product/' . $slika->nazivSlike . '" alt="' . $slika->altTag . '">
                                </div>
                            </div>';
                                        } else {
                                            echo '<div class="tab-pane" id="tabs-' . $rb . '" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="assets/img/product/' . $slika->nazivSlike . '" alt="' . $slika->altTag . '">
                                </div>
                            </div>';
                                        }
                                    }
                                } else {

                                    if ($boje[0]->idBoja == $slika->bojaX) {
                                        $rb++;
                                        if ($rb == 1) {
                                            echo '<div class="tab-pane active" id="tabs-' . $rb . '" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="assets/img/product/' . $slika->nazivSlike . '" alt="' . $slika->altTag . '">
                                </div>
                            </div>';
                                        } else {
                                            echo '<div class="tab-pane" id="tabs-' . $rb . '" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="assets/img/product/' . $slika->nazivSlike . '" alt="' . $slika->altTag . '">
                                </div>
                            </div>';
                                        }
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <?php
                            echo '<h4>' . $boje[0]->imeProdukta . '</h4>';

                            $result = getRating($_GET['prod']);
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
                        <?php
                        $stara = '';
                        if ($boje[0]->stara != NULL) {
                            $stara = $boje[0]->stara;
                        }
                        echo '<h3>' . $boje[0]->nova . 'din <span>' . $stara . '</span></h3>';
                        echo '<p>' . $boje[0]->opis . '</p>';
                        ?>

                        <div class="product__details__option">
                            <div class="product__details__option__size">
                                <span>Size:</span>
                                <?php
                                foreach ($velicine as $velicina) :
                                ?>
                                    <label for="<?= $velicina->velicina ?>"><?= $velicina->velicina ?>
                                        <input type="radio" id="<?= $velicina->velicina ?>" name="velicine" value="<?= $velicina->velicina ?>">
                                    </label>
                                <?php
                                endforeach;
                                ?>
                                <span class="help" id="sizeHelp"></span>
                            </div>
                            <div class="product__details__option__color">
                                <span>Color:</span>
                                <?php
                                foreach ($boje as $boja) :
                                ?>
                                    <a class='round' href="index.php?page=details&prod=<?= $_GET['prod'] ?>&color=<?= $boja->idBoja ?>" style="background-color: <?= $boja->rgb ?>">
                                    </a>
                                <?php
                                endforeach;
                                ?>
                                <span class="help" id="boja"></span>
                                <?php
                                if (isset($_GET['color'])) {
                                    echo ' <form>
                                        <input type="hidden" value="' . $_GET['color'] . '" id="colorSelected">
                                    </form>';
                                } else {
                                    echo ' <form>
                                        <input type="hidden" value="" id="colorSelected">
                                    </form>';
                                }
                                ?>
                            </div>
                            <i class="fas fa-question-circle ml-5" title="First select color, when page reloads select size and quantity then ADD TO CART"></i>
                        </div>
                        <div class="product__details__cart__option">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1" id="quan">
                                </div>
                            </div>
                            <?php
                            if (isset($_SESSION['user']) || isset($_SESSION['blogger'])) :
                            ?>
                                <a id="add" class="primary-btn" style="color:beige">add to cart</a>
                                <span class="help" id="added"></span>

                            <?php
                            else :
                            ?>
                                <a id="edit" class="primary-btn" href="index.php?page=panel&edit=<?= $_GET['prod'] ?>" style="color:beige">Edit Product</a>
                            <?php
                            endif;
                            ?>

                        </div>

                        <div class="product__details__last__option">
                            <h5><span>Guaranteed Safe Checkout</span></h5>
                            <img src="assets/img/shop-details/details-payment.png" alt="">
                            <ul>
                                <?php
                                $string = '';
                                for ($i = 0; $i < count($tagovi); $i++) {
                                    if ($i < count($tagovi) - 1) {
                                        $string = $string . $tagovi[$i]->tag . ', ';
                                    } else {
                                        $string = $string . $tagovi[$i]->tag;
                                    }
                                }
                                echo '<li><span>Brand: </span>' . $boje[0]->brend . ' </li>
                                    <li><span>Categories: </span> ' . $boje[0]->kategorija . '</li>
                                    <li><span>Tag:  </span>' . $string . '</li>';
                                ?>

                            </ul>
                        </div>
                        <?php

                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <?php
                                $reviews = getReviews($_GET['prod']);
                                $reviewsNum = count($reviews);
                                echo '<a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Customer
                                        Previews(' . $reviewsNum . ')</a>';
                                ?>
                            </li>
                            <?php
                            if (isset($_SESSION['admin']) || isset($_SESSION['user']) || isset($_SESSION['blogger'])) :
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Write Review</a>
                                </li>
                            <?php
                            endif;
                            ?>
                        </ul>
                        <?php
                        if (isset($_SESSION['admin']) || isset($_SESSION['user']) || isset($_SESSION['blogger'])) :
                        ?>
                            <div class="tab-content">
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                            <div class="col-lg-12">
                                                <div class="contact__form">
                                                    <select id="ocena" class="custom-select d-block w-100">
                                                        <?php
                                                        $ocene = fetchAll('ocene');
                                                        echo '<option value="0">Select Grade</option>';
                                                        foreach ($ocene as $ocena) :
                                                        ?>
                                                            <option value="<?= $ocena->ocena ?>"><?= $ocena->ocena ?></option>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                    <form id="reviewForm">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <textarea placeholder="Message" id="msg"></textarea>
                                                                <input type="hidden" id="produkt" value="<?php echo $_GET['prod'] ?>">
                                                                <?php
                                                                if (isset($_SESSION['admin'])) {
                                                                    echo '<input type="hidden" id="korisnik" value="' . $_SESSION["admin"]->idKorisnik . '">';
                                                                } elseif (isset($_SESSION['user'])) {
                                                                    echo '<input type="hidden" id="korisnik" value="' . $_SESSION["user"]->idKorisnik . '">';
                                                                } elseif (isset($_SESSION['blogger'])) {
                                                                    echo '<input type="hidden" id="korisnik" value="' . $_SESSION["blogger"]->idKorisnik . '">';
                                                                }
                                                                ?>
                                                                <button type="button" id="review" class="site-btn">Send
                                                                    Review
                                                                </button>
                                                                </br>
                                                                <span class="help" id="selectHelp"></span>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        endif;
                            ?>
                            <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <div class="product__details__tab__content__item">
                                        <?php
                                        foreach ($reviews as $review) :
                                        ?>
                                            <div class="col-md-8">
                                                <div class="media g-mb-30 media-comment">
                                                    <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Image Description">
                                                    <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                                                        <div class="g-mb-15">
                                                            <h5 class="h5 g-color-gray-dark-v1 mb-0"><?= $review->ime ?> <?= $review->prezime ?></h5>
                                                            <span class="g-color-gray-dark-v4 g-font-size-12"><?= $review->date ?></span>
                                                        </div>

                                                        <p><?= $review->reviewSadrzaj ?></p>

                                                        <ul class="list-inline d-sm-flex my-0">
                                                            <div class="rating">
                                                                <?php
                                                                $rating = $review->ocena;
                                                                for ($i = 0; $i < $rating; $i++) {
                                                                    echo '<i class="fa fa-star"></i>';
                                                                }
                                                                for ($j = 0; $j < 5 - $rating; $j++) {
                                                                    echo '<i class="fa fa-star-o"></i>';
                                                                }
                                                                ?>
                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        endforeach;
                                        ?>
                                    </div>
                                </div>
                            </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Related Product</h3>
                </div>
            </div>
            <div class="row">
                <?php
                $produktiIstihTagova = fetchSameProductTags($_GET['prod']);
                if (count($produktiIstihTagova) != 0) :
                    foreach ($produktiIstihTagova as $product) :
                ?>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="assets/img/product/<?= $product->nazivSlike ?>">
                                    <?php
                                    if ($product->novo == 1) {
                                        echo '<span class="label">New</span>';
                                    }
                                    ?>
                                    <ul class="product__hover">
                                        <li>
                                            <a href="index.php?page=details&prod=<?= $product->idProdukt ?>"><img src="assets/img/icon/compare.png" alt=""> <span>Details</span></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><?= $product->imeProdukta ?></h6>
                                    <a href="#" class="add-cart">+ Add To Cart</a>
                                    <?php
                                    $result = getRating($product->idProdukt);
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
                                <h5><?= $product->nova ?>din</h5>
                                <div class="product__color__select">
                                    <?php
                                    $colors = getColors($product->idProdukt);
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
                endif;
    ?>
        </div>
    </section>
    <!-- Related Section End -->
<?php
endif;
if (!isset($_GET['prod'])) {
    echo '
    <section class="shop-details">
        <div class="product__details__pic">
            <h1>Please Select Product</h1>
        </div>
    </section>
';
}
?>
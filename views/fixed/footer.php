<!-- Footer Section Begin -->

<footer class="footer">

    <div class="container">

        <div class="row">

            <div class="col-lg-5 col-md-6 col-sm-6">

                <div class="footer__about">

                    <div class="footer__logo">

                        <a href="#"><img src="assets/img/footer-logo.png" alt=""></a>

                    </div>

                    <p>The customer is at the heart of our unique business model, which includes design.</p>

                    <a><img src="assets/img/payment.png" alt=""></a>

                </div>

            </div>

            <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">

                <div class="footer__widget">

                    <h6>Navigation</h6>

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
                         <li class=""><a class="ses" data-curr="author" href="index.php?page=author">Author</a></li>
                    </ul>

                </div>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-6">

                <div class="footer__widget">

                    <h6>Shopping</h6>

                    <ul>

                        <li><a href="index.php?page=shop">Go Shopping</a></li>

                        <li><a href="index.php?page=cart">Shopping Cart</a></li>

                        <li><a href="index.php?page=wishlist">Wishlist</a></li>

                        <li><a href="index.php?page=faq">Frequently Asked Questions</a></li>

                    </ul>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-lg-12 text-center">

                <div class="footer__copyright__text">

                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

                    <p>Copyright ©

                        <script>

                            document.write(new Date().getFullYear());

                        </script>

                        All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>

                    </p>

                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

                </div>

            </div>

        </div>

    </div>

</footer>

<!-- Footer Section End -->
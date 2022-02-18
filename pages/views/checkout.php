<?php
zabeleziPristupStranici($_GET['page']);

?>
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Check Out</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php?page=home">Home</a>
                        <a href="index.php?page=cart">Cart</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 order-md-2">
            <div class="checkout__order">
                <ul class="checkout__total__all">
                    <?php
                    if (isset($_SESSION['cart'])) {
                        echo '<ul>
                        <li>Total <span>' . $_SESSION['info']->sum . ' RSD</span></li>
                    </ul>';
                    } else {
                        echo '<ul>
                        <li>Total <span>0 RSD</span></li>
                    </ul>';
                    }
                    ?>
                </ul>
                <button class="primary-btn" type="button" id='checkout'>Checkout</button>
            </div>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <form class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" id="firstName" placeholder="" value="<?= $_SESSION['user']->ime ?>" disabled>
                        <span class="help" id="firstNameHelp"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="" value="<?= $_SESSION['user']->prezime ?>" disabled>
                        <span class="help" id="lastNameHelp"></span>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email <span class="text-muted">(Optional)</span></label>
                    <input type="email" class="form-control" id="email" placeholder="you@example.com" value="<?= $_SESSION['user']->email ?>" disabled>
                    <span class="help" id="emailHelp"></span>
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
                    <span class="help" id="addressHelp"></span>
                </div>

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">Country</label>
                        <select class="custom-select d-block w-100" id="country" required>
                            <option value="choose">Choose...</option>
                            <option value="srb">Serbia</option>
                            <option value="mkd">Macedonia</option>
                            <option value="bih">Bosnia and Herzegovina</option>
                            <option value="mne">Montenegro</option>
                        </select>
                        <span class="help" id="countryHelp"></span>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" placeholder="" required>
                        <span class="help" id="zipHelp"></span>
                    </div>
                </div>
                <hr class="mb-4">
                <h4 class="mb-3">Payment</h4>

                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                        <label class="custom-control-label" for="credit">Credit card</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                        <label class="custom-control-label" for="debit">Debit card</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                        <label class="custom-control-label" for="paypal">Paypal</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cc-name">Name on card</label>
                        <input type="text" class="form-control" id="cc-name" placeholder="" required>
                        <span class="help" id="cc-nameHelp"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cc-number">Credit card number</label>
                        <input type="text" class="form-control" id="cc-number" placeholder="" required>
                        <span class="help" id="cc-numberHelp"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="cc-expiration">CVV</label>
                        <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                        <span class="help" id="cc-cvvHelp"></span>
                    </div>
                </div>
                <hr class="mb-4">

            </form>
        </div>
    </div>
</div>
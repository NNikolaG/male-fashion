<?php
zabeleziPristupStranici($_GET['page']);

?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shopping Cart</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <div class="shopping__cart__table">

                    <?php
                    if (isset($_SESSION['cart'])) {
                        echo '<table>
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Total</th>

                        </tr>
                        </thead>
                        <tbody>';
                        cartInfo();
                    } else {
                        echo '<h1>CART IS EMPTY</h1>';
                    }
                    ?>

                    </tbody>
                    </table>
                </div>
                <!--                <td class="quantity__item">-->
                <!--                    <div class="quantity">-->
                <!--                        <div class="pro-qty-2">-->
                <!--                            <input type="text" value="1">-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </td>-->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="index.php?page=shop">Continue Shopping</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn update__btn">
                            <a href="models/emptycart.php"><i class="fa fa-trash" aria-hidden="true"></i> Empty cart</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart__total">
                    <h6>Cart total</h6>
                    <?php
                    if(isset($_SESSION['cart'])){
                        echo '<ul>
                        <li>Total <span>' . $_SESSION['info']->sum . ' RSD</span></li>
                    </ul>';
                    }
                    else{
                        echo '<ul>
                        <li>Total <span>0 RSD</span></li>
                    </ul>';
                    }
                    ?>
                    <a href="index.php?page=checkout" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->

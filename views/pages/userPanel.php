<?php

zabeleziPristupStranici($_GET['page']);
if (isset($_SESSION['user'])) :
    $userOrders = getOrders($_SESSION['user']->email);
?>
    <section class="breadcrumb-option">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <div class="breadcrumb__text">

                        <h4>Your Orders</h4>

                        <div class="breadcrumb__links">

                            <a href="index.php">Home</a>

                            <span>Orders</span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <div class="table-responsive">

        <?php
        if (empty($userOrders)) :
        ?>
            <div class="res-text" style="height: 25vh">
                <h2 style="padding: 50px">You haven't ordered anything yet</h2>

            </div>
        <?php
        else :
        ?>
            <table class="table table-striped">
                <caption>Orders</caption>
                <thead>
                    <tr>
                        <th>Payment Method</th>
                        <th>Country</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Delivered</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($userOrders

                        as $order) :
                    ?>
                        <tr style="background-color: #222222; color: white">
                            <td><?= $order->nacinPlacanja ?></td>
                            <td><?= $order->zemlja ?></td>
                            <td><?= $order->cost ?></td>
                            <td><?= $order->datum ?></td>
                            <td><?= $order->isporuceno == 1 ? 'yes' : 'no' ?></td>
                        </tr>
                        <tr>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <?php
                            $orderProducts = orderProducts($order->porudzbine_id);
                            foreach ($orderProducts

                                as $orP) :
                            ?>

                <tbody>
                    <tr>
                        <td></td>
                        <td><?= $orP->imeProdukta ?></td>
                        <td><?= $orP->opis ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            <?php
                            endforeach;
            ?>
            </tr>
        <?php
                    endforeach;
        ?>
        </tbody>
            </table>
    </div>
<?php
        endif;
?>
<?php
else :
?>
    <div class="res-text" style="height: 20vh">
        <h1 style="padding: 50px"> You are not logged in</h1>

    </div>
<?php
endif;
?>
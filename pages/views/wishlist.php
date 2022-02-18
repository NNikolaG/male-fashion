<?php
zabeleziPristupStranici($_GET['page']);

?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Wishlist</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <span>Wishlist</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<div class="content">
    <div class="container">
        <div class="table-responsive">
            <?php
            if (isset($_SESSION['user'])) :
                $currentWishlist = fetchWishlistProducts($_SESSION['user']->idWishlist);
                if (empty($currentWishlist)) {
                    echo '<h2>Wishlist is Empty</h2>';
                } else {
                    echo '<table class="table table-striped custom-table">
                    <thead>
                        <tr>
                            <th scope="col">num.</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>';
                }
            ?>
                <tbody>
                    <?php
                    $products = fetchAllProducts('p.idProdukt', false);
                    $rb = 0;
                    foreach ($currentWishlist as $element) :
                        foreach ($products as $product) :
                            if ($element->idProdukt == $product->idProdukt) :
                                $rb++;
                    ?>
                                <tr scope="row">
                                    <td class='align-middle'>
                                        <?= $rb ?>
                                    </td>
                                    <td><img style='width:100px;' src="assets/img/product/<?= $product->nazivSlike ?>"></td>
                                    <td class='align-middle'><?= $product->imeProdukta ?></td>
                                    <td class='align-middle'>
                                        <a href="index.php?page=details&prod=<?= $product->idProdukt ?>">Details</a>
                                    </td>
                                    <td class='align-middle'><i style='cursor:pointer;' class="fas fa-trash-alt remove" data-id='<?= $product->idProdukt ?>'></i></td>

                                </tr>
                <?php
                            endif;
                        endforeach;
                    endforeach;
                else :
                    echo '<h2>Not Logged in</h2>';

                endif;
                ?>
                </tbody>
                </table>
        </div>
    </div>
</div>
<?php
zabeleziPristupStranici($_GET['page']);
?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shop</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form action="#">
                            <input type="text" placeholder="Search..." id='search'>
                            <button type="button"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__brand">
                                            <ul>
                                                <?php
                                                $kategorije = fetchAll('kategorije');
                                                foreach ($kategorije as $kategorija) :
                                                ?>
                                                    <li><input type='checkbox' class='category' value='<?= $kategorija->kategorija ?>'>&nbsp;&nbsp;&nbsp;&nbsp;<?= $kategorija->kategorija ?></li>
                                                <?php
                                                endforeach;
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                                </div>
                                <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__brand">
                                            <ul>
                                                <?php
                                                $brendovi = fetchAll('brendovi');
                                                foreach ($brendovi as $brend) :
                                                ?>
                                                    <li><input type='checkbox' class='brand' value='<?= $brend->brend ?>'>&nbsp;&nbsp;&nbsp;&nbsp;<?= $brend->brend ?></li>
                                                <?php
                                                endforeach;
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                </div>
                                <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__price">
                                            <ul>
                                                <li><input type='radio' class='price' name='p' value='all'>&nbsp;&nbsp;&nbsp;&nbsp;All Products</li>
                                                <li><input type='radio' class='price' name='p' value='500-2500'>&nbsp;&nbsp;&nbsp;&nbsp;500 RSD - 2.500 RSD</li>
                                                <li><input type='radio' class='price' name='p' value='2500-5000'>&nbsp;&nbsp;&nbsp;&nbsp;2.500 RSD - 5.000 RSD</li>
                                                <li><input type='radio' class='price' name='p' value='5000-100000'>&nbsp;&nbsp;&nbsp;&nbsp;5.000 RSD +</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                                </div>
                                <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__size">
                                            <?php
                                            $velicine = fetchAll('velicine');
                                            foreach ($velicine as $velicina) :
                                            ?>
                                                <input type='checkbox' value='<?= $velicina->velicina ?>' class="size round">
                                                <label for="<?= $velicina->velicina ?>"><?= $velicina->velicina ?>
                                                </label>
                                                </br>
                                            <?php
                                            endforeach;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseFive">Colors</a>
                                </div>
                                <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__color">
                                            <?php
                                            $boje = fetchAll('boje');
                                            foreach ($boje as $boja) :
                                            ?>
                                                <input type='checkbox' value='<?= $boja->boja ?>' class="round color">
                                                <a class='round' style="background-color: <?= $boja->rgb ?>">
                                                </a>
                                                <span><?= $boja->boja ?></span>
                                                </br>
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
            <div class="col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Sort by :</p>
                                <select id='ddlSortOrder'>
                                    <option value="1">A-Z Name</option>
                                    <option value="2">Z-A Name</option>
                                    <option value="3">Price Asc</option>
                                    <option value="4">Price Desc</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id='produkti'>

                    <?php
                    $products = fetchAllProducts('p.idProdukt', false);
                    if (isset($_SESSION['user'])) {
                        $id = $_SESSION['user']->idWishlist;
                    } else {
                        $id = 0;
                    }
                    echo "<div class='d-none' id='idValue' data-id='" . $id . "'></div>";

                    ?>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__pagination" id='pagination'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
?>
<!-- Shop Section End -->
<?php
$colors = fetchAll('boje');
$brands = fetchAll('brendovi');
$sizes = fetchAll('velicine');
$tags = fetchAll('tagovi');
$categories = fetchAll('kategorije');
$collections = fetchAll('kolekcijaslika');
$messages = fetchAll('messages');
$productOrder = productOrderFetch();

// Taking only base Collection
$collectionsBase = [];  
for ($i = 0; $i < count($collections); $i++) {
    array_push($collectionsBase, $collections[$i]->nazivKolekcije);
}
$collectionsBase = array_unique($collectionsBase);

zabeleziPristupStranici($_GET['page']);


//Login fajl
$logins = explode("\n", file_get_contents('assets/data/login_log.txt'));
$createErrors = explode("\n", file_get_contents('assets/data/error_log.txt'));
$visitors = explode("\n", file_get_contents('assets/data/log.txt'));


//Get Product data
if (isset($_GET['edit'])) {

    $boje = fetchAllProducts('bo.idBoja', $_GET['edit']);
    $velicine = fetchAllProducts('v.idVelicina', $_GET['edit']);
    $slike = fetchAllProducts('s.idSlika', $_GET['edit']);
    $tagovi = fetchAllProducts('t.idTag', $_GET['edit']);

    $prod = fetchAllProducts('p.idProdukt', $_GET['edit']);
    $prod = $prod[0];
}
?>
<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter=".log-stats">Logs</li>
                    <li data-filter=".orders">Orders</li>
                    <li data-filter=".add-product">Add Product</li>
                    <li id='editTab' data-filter=".edit-product">Edit Product</li>
                    <li data-filter=".messages">Messages</li>
                </ul>
            </div>
        </div>
        <div class="row product__filter">
            <div class="col-lg-12 mix log-stats">
                <div class="product__item">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <caption>Page traffic</caption>
                            <thead>
                                <tr>
                                    <th>Page</th>
                                    <th>Page traffic in %</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $pages = [];
                                $traffic = count($visitors);
                                foreach ($visitors as $e) {
                                    if (!empty($e)) {
                                        $value = explode(SEPARATOR, $e);
                                        $visitor = explode('=', $value[0]);
                                        if ($visitor != '') {
                                            if (array_key_exists($visitor[1], $pages)) {
                                                $pages[$visitor[1]]++;
                                            } else {
                                                $pages[$visitor[1]] = 1;
                                            }
                                        }
                                    }
                                }
                                foreach ($pages as $key => $val) {

                                    $percent = round($val / $traffic * 100);

                                    echo '<tr>
                                    <td>' . $key . '</td>
                                    <td>' . $percent . '%</td>
                                    <td>' . $val . '</td>
                                    </tr>';
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm caption-top">
                            <caption>List of users who logged in or tried to</caption>
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>IP Address</th>
                                    <th>Date and Time</th>
                                    <th>Result Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($logins as $log) {
                                    if (!empty($log)) {
                                        $logArr = explode(SEPARATOR, $log);

                                        if ($logArr[3] == 'Successful Logging') {
                                            echo '<tr class="table-success">';
                                        } elseif ($logArr[3] == 'Wrong password') {
                                            echo '<tr class="table-warning">';
                                        } else {
                                            echo '<tr class="table-danger">';
                                        }
                                        foreach ($logArr as $e) {
                                            echo '<td>' . $e . '</td>';
                                        }
                                        echo '</tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm caption-top">
                        <caption>List of Status Messages and Errors</caption>
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>IP Address</th>
                                <th>Date and Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($createErrors as $log) {
                                if (!empty($log)) {
                                    $logArr = explode(SEPARATOR, $log);
                                    $value = '';
                                    if (in_array('Files are uploaded successfuly.', $logArr)) {
                                        echo '<tr class="table-success">';
                                    } else {
                                        echo '<tr class="table-danger">';
                                    }
                                    for ($i = 0; $i < count($logArr) - 3; $i++) {
                                        if ($logArr[$i] != '') {
                                            if ($i < count($logArr) - 4) {
                                                $value .= $logArr[$i] . " ---- ";
                                            } else {
                                                $value .= $logArr[$i];
                                            }
                                        }
                                    }
                                    echo '<td>' . $value . '</td>';
                                    echo '<td>' . $logArr[4] . '</td>';
                                    echo '<td>' . $logArr[5] . '</td>';
                                    echo '</tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-12 col-md-6 col-sm-6 col-md-6 col-sm-6 mix add-product" style="display: none;">
                <div class="product__item">
                    <form action="models/addProduct.php" method="post" enctype="multipart/form-data">
                        <h4 class="mb-3">Info</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control" name="prodName" placeholder="" value="" required>
                            </div>
                            <div class="col-lg-6 mt-3">
                                <textarea placeholder="Description" name='desc' style="width: 85%;"></textarea>
                                <span class="text-muted">(Optional)</span>
                            </div>
                            <div class="col-4">
                                <label for="Price">Price </label>
                                <input type="number" class="form-control" name="Price" min="500">
                                <span class="help" id="priceHelp"></span>
                            </div>
                            <div class="col-4 mb-3">
                                <label for="Category">Category</label>
                                <select class="custom-select d-block w-100" name="Category" required>
                                    <option value="choose">Choose...</option>
                                    <?php
                                    foreach ($categories as $cat) :
                                    ?>
                                        <option value="<?= $cat->idKategorija ?>"><?= $cat->kategorija ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                                <span class="help" id="catHelp"></span>
                            </div>
                            <div class="col-4 mb-3">
                                <label for="Brand">Brand</label>
                                <select class="custom-select d-block w-100" name="Brand" required>
                                    <option value="choose">Choose...</option>
                                    <?php
                                    foreach ($brands as $bra) :
                                    ?>
                                        <option value="<?= $bra->idBrend ?>"><?= $bra->brend ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                                <span class="help" id="brandHelp"></span>
                            </div>
                        </div>
                        <hr class="mb-4">
                        <h4 class="mb-3">Color - Sizing</h4>
                        <div class="row">
                            <div class="col-4 mb-3">
                                <label for="Tag">Tag</label>
                                <select class="custom-select d-block w-100" name="Tag" required>
                                    <option value="choose">Choose...</option>
                                    <?php
                                    foreach ($tags as $tag) :
                                    ?>
                                        <option value="<?= $tag->idTag ?>"><?= $tag->tag ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                                <span class="help" id="tagHelp"></span>
                            </div>
                            <div class="col-4 mb-3">
                                <label for="Size">Size</label>
                                <select class="custom-select d-block w-100" name="Size" required>
                                    <option value="choose">Choose...</option>
                                    <?php
                                    foreach ($sizes as $size) :
                                    ?>
                                        <option value="<?= $size->idVelicina ?>"><?= $size->velicina ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                                <span class="help" id="sizeHelp"></span>
                            </div>
                            <div class="col-4 mb-3">
                                <label for="Color">Color</label>
                                <select class="custom-select d-block w-100" name="Color" required>
                                    <option value="choose">Choose...</option>
                                    <?php
                                    foreach ($colors as $col) :
                                    ?>
                                        <option value="<?= $col->idBoja ?>"><?= $col->boja ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                                <span class="help" id="colorHelp"></span>
                            </div>
                        </div>
                        <hr class="mb-4">
                        <h4 class="mb-3">Image Collection</h4>
                        <div class="row">
                            <div class="col-6 mb-3">
                                Select Image Files to Upload : <span class="text-muted">(Min : 1, Max : 4)</span>
                                <input type="file" id='files' name="files[]" multiple>
                            </div>
                        </div>
                        <input type="submit" name="submit" value="UPLOAD" class='primary-btn mt-4 uploadBtn'>
                    </form>
                    <span class="help" id="msg"></span>
                </div>
            </div>

            <div class="col-lg-12 col-md-6 col-sm-6 col-md-6 col-sm-6 mix edit-product" style="display: none;">
                <div class="product__item">
                    <?php
                    if (isset($_GET['edit'])) :
                    ?>
                        <form action="" method="POST">
                            <h4 class="mb-3">Info</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="name">Product Name</label>
                                    <input type="text" class="form-control" id='editName' name="editName" placeholder="" value="<?= $prod->imeProdukta ?>" required>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <textarea placeholder="Description" name='desc' style="width: 85%;"><?= $prod->opis ?></textarea>
                                    <span class="text-muted">(Optional)</span>
                                </div>
                                <div class="col-4">
                                    <label for="Price">Price </label>
                                    <input type="number" class="form-control" id='newPrice' name="Price" value='<?= $prod->nova ?>' min="500">
                                    <input type="number" name="oldPrice" id='oldPrice' value='<?= $prod->nova ?>' hidden>
                                    <span class="help" id="priceHelp"></span>
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="Brand">Brand</label>
                                    <?php
                                    foreach ($brands as $brand) {
                                        if ($prod->idBrend == $brand->idBrend) {
                                            echo "<li><input type='radio' class='brand' name='radioBrend' value='" . $brand->brend . "' checked >&nbsp;&nbsp;&nbsp;&nbsp;" . $brand->brend . "</li>";
                                        } else {
                                            echo "<li><input type='radio' class='brand' name='radioBrend' value='" . $brand->brend . "'>&nbsp;&nbsp;&nbsp;&nbsp;" . $brand->brend . "</li>";
                                        }
                                    }
                                    ?>
                                    <span class="help" id="catHelp"></span>
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="Category">Categories</label>
                                    <?php
                                    foreach ($categories as $category) {
                                        if ($prod->idKategorija == $category->idKategorija) {
                                            echo "<li><input type='radio' class='category' name='cat' value='" . $category->kategorija . "' checked>&nbsp;&nbsp;&nbsp;&nbsp;" . $category->kategorija . "</li>";
                                        } else {
                                            echo "<li><input type='radio' class='category' name='cat' value='" . $category->kategorija . "'>&nbsp;&nbsp;&nbsp;&nbsp;" . $category->kategorija . "</li>";
                                        }
                                    }
                                    ?>
                                    <span class="help" id="brandHelp"></span>
                                </div>
                            </div>
                            <hr class="mb-4">
                            <h4 class="mb-3">Color - Sizing</h4>
                            <div class="row">
                                <div class="col-4 mb-3">
                                    <label for="Tag">Tag</label>
                                    </br>
                                    <?php
                                    foreach ($tags as $tag) {
                                        if ($prod->idTag == $tag->idTag) {
                                            echo '<input type="checkbox" value="' . $tag->tag . '" class="size round" checked>
                                            <label for="' . $tag->tag . '">' . $tag->tag . '
                                            </label>
                                            </br>';
                                        } else {
                                            echo '<input type="checkbox" value="' . $tag->tag . '" class="size round">
                                            <label for="' . $tag->tag . '">' . $tag->tag . '
                                            </label>
                                            </br>';
                                        }
                                    }
                                    ?>
                                    <span class="help" id="tagHelp"></span>
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="Size">Size</label>
                                    </br>
                                    <?php
                                    foreach ($sizes as $size) {
                                        if ($prod->idVelicina == $size->idVelicina) {
                                            echo '<input type="checkbox" value="' . $size->velicina . '" class="size round" checked>
                                            <label for="' . $size->velicina . '">' . $size->velicina . '
                                            </label>
                                            </br>';
                                        } else {
                                            echo '<input type="checkbox" value="' . $size->velicina . '" class="size round">
                                            <label for="' . $size->velicina . '">' . $size->velicina . '
                                            </label>
                                            </br>';
                                        }
                                    }
                                    ?>
                                    <span class="help" id="sizeHelp"></span>
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="Color">Color</label>
                                    </br>
                                    <?php
                                    foreach ($colors as $color) {
                                        if ($prod->idBoja == $color->idBoja) {
                                            echo '<input type="checkbox" value="' . $color->boja . '" class="size round" checked>
                                            <label for="' . $color->boja . '">' . $color->boja . '
                                            </label>
                                            </br>';
                                        } else {
                                            echo '<input type="checkbox" value="' . $color->boja . '" class="size round">
                                            <label for="' . $color->boja . '">' . $color->boja . '
                                            </label>
                                            </br>';
                                        }
                                    }
                                    ?>
                                    <span class="help" id="colorHelp"></span>
                                </div>
                            </div>
                            <input type="button" name="submit" value="Edit" class='primary-btn mt-4 uploadBtn'>
                        </form>
                    <?php
                    else :
                    ?>
                        <h2>Product not selected</h2>
                    <?php
                    endif;
                    ?>
                </div>
            </div>


            <div class="col-lg-12 col-md-6 col-sm-6 col-md-6 col-sm-6 mix messages" style="display: none;">
                <div class="product__item">
                    <?php
                    if (count($messages) != 0) :
                    ?>
                        <table class="table table-striped">
                            <caption>Message Box</caption>
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Respond</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($messages as $msg) {
                                    echo '<tr>
                                <td class="align-middle">' . $msg->fullName . '</td>
                                <td class="align-middle">' . $msg->email . '</td>
                                <td class="align-middle">' . $msg->message . '</td>
                                <td class="align-middle"><form action="mailto:' . $msg->email . '" method="post" enctype="text/plain"><input type="submit" class="btn" value="Respond"></form></td>
                                <td class="align-middle"><i style="cursor:pointer;" class="fas fa-trash-alt deleteMsg" data-id="' . $msg->idMessages . '" aria-hidden="true"></i></td>
                                </tr>';
                                }
                                ?>

                            </tbody>
                        </table>
                    <?php
                    else :
                    ?>
                        <h2>Message Box is Empty</h2>
                    <?php
                    endif;
                    ?>
                </div>
            </div>


            <div class="col-lg-12 col-md-6 col-sm-6 col-md-6 col-sm-6 mix orders" style="display: none;">
                <div class="product__item">
                    <?php
                    if (count($messages) != 0) :
                    ?>
                        <table class="table table-striped">
                            <caption>Order Box</caption>
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Products Ordered</th>
                                    <th>Delivered</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $uniqueOrders = [];
                                $tmp = [];
                                foreach ($productOrder as $p) {
                                    if (!in_array($p->idPorudzbina, $tmp)) {
                                        array_push($tmp, $p->idPorudzbina);
                                        array_push($uniqueOrders, $p);
                                    }
                                }
                                foreach ($uniqueOrders as $ord) {
                                    echo '<tr>
                                <td class="align-middle">' . $ord->imePrezime . '</td>
                                <td class="align-middle">' . $ord->email . '</td>
                                <td class="align-middle">' . $ord->adresa . '</td>
                                <td class="align-middle">' . returnProductsforOrder($ord->porudzbine_id, $productOrder) . '</td>
                                <td class="align-middle">' . delivered($ord) . '</td>
                                ';
                                }
                                ?>

                            </tbody>
                        </table>
                    <?php
                    else :
                    ?>
                        <h2>Order Box is Empty</h2>
                    <?php
                    endif;
                    ?>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
</section>
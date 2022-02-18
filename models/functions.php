<?php
function getDateAndTime()
{
    return date("d-m-Y H:i:s");
}


function getTime($fullDate)
{
    $dateAndTime = explode(" ", $fullDate);
    $date = explode("-", $dateAndTime[0]);
    $time = explode(":", $dateAndTime[1]);
    $hour = intval($time[0]);
    $minute = intval($time[1]);
    $second = intval($time[2]);
    $day = intval($date[0]);
    $month = intval($date[1]);
    $year = intval($date[2]);
    return mktime($hour, $minute, $second, $month, $day, $year);
}

function fetchAll($table)
{
    global $conn;

    $upit = "SELECT * FROM $table";

    $result = $conn->query($upit)->fetchall();
    return $result;
}

function fetchWhere($table, $param, $operator, $value)
{
    global $conn;

    $upit = "SELECT * FROM $table WHERE " . $param . $operator . "'$value'";
    $result = $conn->query($upit)->fetch();
    return $result;
}

function fetchAllWhere($table, $param, $operator, $value)
{
    global $conn;

    $upit = "SELECT * FROM $table WHERE " . $param . $operator . "'$value'";
    $result = $conn->query($upit)->fetchAll();
    return $result;
}

function updateErrorLog($message)
{
    if (!empty($message)) {
        $file = fopen(ERROR_LOG, 'a');
        if ($file) {
            $ipAddress = $_SERVER['REMOTE_ADDR'];
            $text = $message . SEPARATOR . $ipAddress . SEPARATOR . getDateAndTime() . SEPARATOR . "\n";
            fwrite($file, $text);
            fclose($file);
        }
    }
}


function fetchAllProducts($group, $id)
{
    global $conn;

    if ($id == false) {
        $upit = "SELECT * FROM produkti AS p INNER JOIN kategorije AS k ON p.kategorija = k.idKategorija INNER JOIN brendovi AS b ON p.brend = b.idBrend INNER JOIN cena c ON p.cena = c.idCena INNER JOIN kolekcijaslika ks ON p.idProdukt = ks.idProdukt INNER JOIN slika s ON ks.idKolekcijaSlika = s.idKolekcijaSlika INNER JOIN produkttag pt ON p.idProdukt = pt.idProdukt INNER JOIN tagovi t ON t.idTag = pt.idTag INNER JOIN produktboja pb ON p.idProdukt = pb.idProdukt INNER JOIN boje bo ON bo.idBoja = pb.idBoja INNER JOIN produktivelicine pv ON p.idProdukt = pv.idProdukt INNER JOIN velicine v ON pv.idVelicina = v.idVelicina GROUP BY $group";

        $prepare = $conn->prepare($upit);
        $prepare->bindParam(':group', $group);
        $prepare->execute();

        $result = $prepare->fetchAll();
        return $result;
    } else {
        $upit = "SELECT *, ks.idBoja AS bojaX FROM produkti AS p INNER JOIN kategorije AS k ON p.kategorija = k.idKategorija INNER JOIN brendovi AS b ON p.brend = b.idBrend INNER JOIN cena c ON p.cena = c.idCena INNER JOIN kolekcijaslika ks ON p.idProdukt = ks.idProdukt INNER JOIN slika s ON ks.idKolekcijaSlika = s.idKolekcijaSlika INNER JOIN produkttag pt ON p.idProdukt = pt.idProdukt INNER JOIN tagovi t ON t.idTag = pt.idTag INNER JOIN produktboja pb ON p.idProdukt = pb.idProdukt INNER JOIN boje bo ON bo.idBoja = pb.idBoja INNER JOIN produktivelicine pv ON p.idProdukt = pv.idProdukt INNER JOIN velicine v ON pv.idVelicina = v.idVelicina WHERE p.idProdukt = :id GROUP BY $group";

        $prepare = $conn->prepare($upit);
        $prepare->bindParam(':id', $id);
        $prepare->execute();

        $result = $prepare->fetchAll();
        return $result;
    }
}

function getColors($id)
{
    global $conn;

    $upit = "SELECT * FROM produkti AS p INNER JOIN produktboja pb ON p.idProdukt = pb.idProdukt INNER JOIN boje bo ON bo.idBoja = pb.idBoja WHERE p.idProdukt = :id";

    $prepare = $conn->prepare($upit);
    $prepare->bindParam(':id', $id);
    $prepare->execute();

    $result = $prepare->fetchAll();
    return $result;
}

function fetchSameProductTags($id)
{
    global $conn;

    $upit1 = 'SELECT * FROM produkti as p INNER JOIN produkttag AS pt ON p.idProdukt = pt.idProdukt INNER JOIN tagovi AS t ON pt.idTag = t.idTag WHERE p.idProdukt = :id';

    $prepare = $conn->prepare($upit1);
    $prepare->bindParam(':id', $id);
    $prepare->execute();

    $result = $prepare->fetchAll();
    $brTagova = count($result);
    if ($brTagova == 1) {

        $tag = $result[0]->idTag;

        $upit4 = 'SELECT * FROM produkti as p INNER JOIN produkttag AS pt ON p.idProdukt = pt.idProdukt INNER JOIN tagovi AS t ON pt.idTag = t.idTag INNER JOIN cena AS c ON p.cena = c.idCena INNER JOIN kolekcijaslika ks ON p.idProdukt = ks.idProdukt INNER JOIN slika s ON ks.idKolekcijaSlika = s.idKolekcijaSlika WHERE t.idTag = :id LIMIT 4';

        $prepare = $conn->prepare($upit4);
        $prepare->bindParam(':id', $tag);
        $prepare->execute();

        $result = $prepare->fetchAll();
        return $result;
    } else {
        $tag1 = $result[0]->idTag;
        $tag2 = $result[1]->idTag;

        $upit2 = 'SELECT * FROM produkti as p INNER JOIN produkttag AS pt ON p.idProdukt = pt.idProdukt INNER JOIN tagovi AS t ON pt.idTag = t.idTag INNER JOIN cena AS c ON p.cena = c.idCena INNER JOIN kolekcijaslika ks ON p.idProdukt = ks.idProdukt INNER JOIN slika s ON ks.idKolekcijaSlika = s.idKolekcijaSlika WHERE t.idTag = :id GROUP BY p.idProdukt ORDER BY p.idProdukt ASC LIMIT 2';
        $upit3 = 'SELECT * FROM produkti as p INNER JOIN produkttag AS pt ON p.idProdukt = pt.idProdukt INNER JOIN tagovi AS t ON pt.idTag = t.idTag INNER JOIN cena AS c ON p.cena = c.idCena INNER JOIN kolekcijaslika ks ON p.idProdukt = ks.idProdukt INNER JOIN slika s ON ks.idKolekcijaSlika = s.idKolekcijaSlika WHERE t.idTag = :id GROUP BY p.idProdukt ORDER BY p.idProdukt DESC LIMIT 2';

        $prepare = $conn->prepare($upit2);
        $prepare1 = $conn->prepare($upit3);
        $prepare->bindParam(':id', $tag1);
        $prepare1->bindParam(':id', $tag2);
        $prepare->execute();
        $prepare1->execute();

        $result1 = $prepare->fetchAll();
        $result2 = $prepare1->fetchAll();
        $newResult = array_merge($result1, $result2);
        return $newResult;
    }
}

// function loging($email, $password)
// {
//     global $conn;

//     $upit = "SELECT * FROM korisnici WHERE email = :email AND password= :password";

//     $prepare = $conn->prepare($upit);
//     $prepare->bindParam(':email', $email);
//     $prepare->bindParam(':password', $password);
//     $prepare->execute();

//     $result = $prepare->fetch();
//     return $result;
// }

function getUser($column, $value)
{
    global $conn;
    $exec = $conn->prepare("SELECT * FROM korisnici k INNER JOIN uloga u ON k.idUloga = u.idUloga WHERE $column = ?");
    $exec->execute([$value]);
    $result = $exec->fetch();
    return $result;
}

function updateLoginLog($email, $result)
{
    $file = fopen(LOGIN_LOG, 'a');
    if ($file) {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $text = $email . SEPARATOR . $ipAddress . SEPARATOR . getDateAndTime() . SEPARATOR . $result . "\n";
        fwrite($file, $text);
        fclose($file);
    }
}

function getFailedAttempts($email, $minutes)
{
    $attempts = 0;
    $currentTime = time();
    $file = file(LOGIN_LOG);
    foreach ($file as $row) {
        $row = trim($row);
        $values = explode(SEPARATOR, $row);
        if ($values[0] == $email) {
            $loginTime = getTime($values[2]);
            if ($currentTime - $loginTime <= 60 * $minutes && $values[3] == 'Wrong password') {
                $attempts++;
            }
        }
    }
    return $attempts;
}

function lockAccount($id)
{
    try {
        global $conn;
        $exec = $conn->prepare("UPDATE korisnici AS k SET k.disabled = 1 WHERE idKorisnik = ?");
        $result = $exec->execute([$id]);
        return $result;
    } catch (PDOException $ex) {
        updateErrorLog($ex->getMessage());
        return false;
    }
}


function sendEmail($user)
{
    $to = $user->email;
    $subject = 'Your account has been locked';
    $message = "Your account <b>$user->username</b> has been locked due to suspicious activity. To unlock your account contact the website administrator.";
    $headers = "From: malefashion@noreply.com" . "\r\n" . "ContentType: text/html; charset=ISO-8859-1\r\n";
    return mail($to, $subject, $message, $headers);
}

function getReviews($id)
{
    global $conn;

    $upit = 'SELECT * FROM produkti AS p INNER JOIN review AS r ON p.idProdukt = r.idProdukt INNER JOIN korisnici AS k ON k.idKorisnik = r.idKorisnik WHERE p.idProdukt = :id';

    $prepare = $conn->prepare($upit);
    $prepare->bindParam(':id', $id);
    $prepare->execute();

    $result = $prepare->fetchAll();
    return $result;
}

function sendReview($ocena, $komentar, $korisnikId, $produktId)
{
    global $conn;

    $upit = "INSERT INTO `review` (`idReview`, `ocena`, `reviewSadrzaj`, `date`, `idProdukt`, `idKorisnik`) VALUES (NULL, :ocena, :sadrzaj, current_timestamp(), :idP, :idK)";

    $prepare = $conn->prepare($upit);

    $prepare->bindParam(':ocena', $ocena);
    $prepare->bindParam(':sadrzaj', $komentar);
    $prepare->bindParam(':idK', $korisnikId);
    $prepare->bindParam(':idP', $produktId);

    $result = $prepare->execute();

    return $result;
}

function ordering($name, $email, $address, $zip, $ccv, $cardOwner, $cardNum, $country, $payment)
{

    global $conn;

    $upit = "INSERT INTO `porudzbine` (`porudzbine_id`, `imePrezime`, `email`, `adresa`, `zip`, `ccv`, `vlasnikKartice`, `brojKartice`, `zemlja`, `nacinPlacanja`, `datum`) VALUES (NULL, :ime, :email, :adresa, :zip, :ccv, :vlasnik, :broj, :drzava, :placanje, current_timestamp())";

    $prepare = $conn->prepare($upit);

    $prepare->bindParam(':ime', $name);
    $prepare->bindParam(':email', $email);
    $prepare->bindParam(':adresa', $address);
    $prepare->bindParam(':zip', $zip);
    $prepare->bindParam(':ccv', $ccv);
    $prepare->bindParam(':vlasnik', $cardOwner);
    $prepare->bindParam(':broj', $cardNum);
    $prepare->bindParam(':drzava', $country);
    $prepare->bindParam(':placanje', $payment);

    $prepare->execute();
    $lastId = $conn->lastInsertId();
    return $lastId;
}

function productOrder($order, $products)
{
    global $conn;

    $query = "INSERT INTO `porudzbinaprodukt` (`idPorudzbinaProdukt`, `idProdukt`, `idPorudzbina`) VALUES ";
    foreach ($products as $p) {
        if (end($products) == $p) {
            $query .= "(NULL, " . $p . ", " . $order . ") ";
        } else {
            $query .= "(NULL, " . $p . ", " . $order . "), ";
        }
    }
    $result = $conn->prepare($query)->execute();
    return $result;
}

function productOrderFetch()
{
    global $conn;

    $query = "SELECT * FROM `produkti` as p INNER JOIN `porudzbinaprodukt` as pp ON pp.idProdukt = p.idProdukt INNER JOIN `porudzbine` AS pr ON pr.porudzbine_id = pp.idPorudzbina";

    $result = $conn->query($query)->fetchall();
    return $result;
}

function returnProductsforOrder($id, $data)
{
    $string = '';
    foreach ($data as $e) {
        if ($e->idPorudzbina == $id) {
            $string .= '<p>' . $e->imeProdukta . '</p></br>';
        }
    }
    return $string;
}

function delivered($obj)
{
    if ($obj->isporuceno == 0) {
        return '<form action="models/delivered.php" method="POST">
        <input type="checkbox" class="size round " value="' . $obj->porudzbine_id . '" name="chBox" onChange="submit()">
        </form>';
    }
    return '<input type="checkbox" class="size round " name="' . $obj->porudzbine_id . '" checked disabled>';
}

function changeDelivered($id)
{
    global $conn;

    $query = "UPDATE `porudzbine` SET `isporuceno` = '1' WHERE `porudzbine`.`porudzbine_id` = $id";

    $result = $conn->prepare($query)->execute();
    return $result;
}

function getRating($id)
{
    global $conn;

    $upit = 'SELECT * FROM produkti AS p INNER JOIN review AS r ON p.idProdukt = r.idProdukt WHERE p.idProdukt = :id';

    $prepare = $conn->prepare($upit);
    $prepare->bindParam(':id', $id);
    $prepare->execute();

    $result = $prepare->fetchAll();


    return $result;
}
function getAverage($result)
{
    $sum = 0;
    $average = 0;

    foreach ($result as $item) {
        $sum = $item->ocena + $sum;
        $average = $sum / count($result);
    }
    return round($average);
}
function getSameProduct($id, $color, $size)
{
    global  $conn;

    $upit = 'SELECT * FROM produkti AS p INNER JOIN cena c ON p.cena = c.idCena INNER JOIN kolekcijaslika ks ON p.idProdukt = ks.idProdukt INNER JOIN slika s ON ks.idKolekcijaSlika = s.idKolekcijaSlika INNER JOIN produktboja pb ON p.idProdukt = pb.idProdukt INNER JOIN boje bo ON bo.idBoja = pb.idBoja INNER JOIN produktivelicine pv ON p.idProdukt = pv.idProdukt INNER JOIN velicine v ON pv.idVelicina = v.idVelicina WHERE p.idProdukt = :id AND bo.idBoja = :color AND v.velicina = :size GROUP  BY p.idProdukt';

    $prepare = $conn->prepare($upit);
    $prepare->bindParam(':id', $id);
    $prepare->bindParam(':color', $color);
    $prepare->bindParam(':size', $size);
    $prepare->execute();

    $result = $prepare->fetch();
    return $result;
}

function bestReviews()
{
    global $conn;

    $upit = "SELECT * FROM produkti AS p INNER JOIN kategorije AS k ON p.kategorija = k.idKategorija INNER JOIN brendovi AS b ON p.brend = b.idBrend INNER JOIN cena c ON p.cena = c.idCena INNER JOIN kolekcijaslika ks ON p.idProdukt = ks.idProdukt INNER JOIN slika s ON ks.idKolekcijaSlika = s.idKolekcijaSlika INNER JOIN produkttag pt ON p.idProdukt = pt.idProdukt INNER JOIN tagovi t ON t.idTag = pt.idTag INNER JOIN produktboja pb ON p.idProdukt = pb.idProdukt INNER JOIN boje bo ON bo.idBoja = pb.idBoja INNER JOIN produktivelicine pv ON p.idProdukt = pv.idProdukt INNER JOIN velicine v ON pv.idVelicina = v.idVelicina inner join review as r on r.idProdukt = p.idProdukt GROUP BY r.idReview";

    $prepare = $conn->prepare($upit);
    $prepare->bindParam(':group', $group);
    $prepare->execute();

    $produkti = $prepare->fetchAll();

    $niz = [];

    foreach ($produkti as $produkt) {
        $rating = getRating($produkt->idProdukt);
        $average = getAverage($rating);

        if ($average > 4.5) {
            array_push($niz, $produkt);
        }
    }
    return $niz;
}

function newArrivals()
{
    global $conn;


    $upit = "SELECT * FROM produkti AS p INNER JOIN kategorije AS k ON p.kategorija = k.idKategorija INNER JOIN brendovi AS b ON p.brend = b.idBrend INNER JOIN cena c ON p.cena = c.idCena INNER JOIN kolekcijaslika ks ON p.idProdukt = ks.idProdukt INNER JOIN slika s ON ks.idKolekcijaSlika = s.idKolekcijaSlika INNER JOIN produkttag pt ON p.idProdukt = pt.idProdukt INNER JOIN tagovi t ON t.idTag = pt.idTag INNER JOIN produktboja pb ON p.idProdukt = pb.idProdukt INNER JOIN boje bo ON bo.idBoja = pb.idBoja INNER JOIN produktivelicine pv ON p.idProdukt = pv.idProdukt INNER JOIN velicine v ON pv.idVelicina = v.idVelicina WHERE p.novo = 1 GROUP BY p.idProdukt";

    $result = $conn->query($upit)->fetchall();

    return $result;
}
function cartInfo()
{
    $sessionObj = $_SESSION['cart'];
    $sum = 0;
    $sumProd = 0;
    foreach ($sessionObj as $obj) {
        $ID = $obj->productID;
        $color = $obj->color;
        $size = $obj->size;

        $product = getSameProduct($ID, $color, $size);

        $sum += $product->nova * $obj->quan;
        $sumProd += $obj->quan;
        $_SESSION['info'] = (object)array('sum' => $sum, 'quan' => $sumProd);
        echo '<tr>
                            <td class="product__cart__item">
                                <div class="product__cart__item__pic">
                                    <img src="assets/img/product/' . $product->nazivSlike . '" alt="' . $product->altTag . '" style="width: 120px">
                                </div>
                                <div class="product__cart__item__text">
                                    <h6>' . $product->imeProdukta . '</h6>
                                    <h5>' . $product->nova . ' RSD</h5>
          </div>
        </td>
            <td class="cart__price">' . $obj->quan . '</td>
            <td class="cart__price">' . $product->nazivKolekcije . '</td>
            <td class="cart__price">' . $product->velicina . '</td>
            <td class="cart__price">' . $product->nova * $obj->quan . ' RSD</td>
        </tr>';
    }
}

function addToWishlist($prod, $wish)
{
    global $conn;

    $upit = 'INSERT INTO `wishlistprodukt` (`idWishlistProdukt`, `idProdukt`, `idWishlist`) VALUES (NULL, ?, ?)';

    $prepare = $conn->prepare($upit);

    $prepare->bindParam(1, $prod);
    $prepare->bindParam(2, $wish);

    $result = $prepare->execute();

    return $result;
}

function fetchWishlistProducts($wishlistId)
{
    global $conn;

    $upit = "SELECT * FROM wishlistprodukt WHERE idWishlist = $wishlistId";

    $result = $conn->query($upit)->fetchAll();

    return $result;
}
function remove($table, $column, $id)
{
    global $conn;

    $upit = "DELETE FROM $table WHERE $column = ?";

    $prepare = $conn->prepare($upit);

    $prepare->bindParam(1, $id);

    $result = $prepare->execute();
    return $result;
}
function createWishlist()
{
    global $conn;
    $upit = 'INSERT INTO `wishlist` (`idWishlist`) VALUES (NULL)';
    $prepare = $conn->prepare($upit);
    $result = $prepare->execute();
    if ($result) {
        $id = $conn->lastInsertId();
        return $id;
    } else {
        return 0;
    }
}
function registration($fname, $lname, $email, $enc, $lastID)
{

    global $conn;
    $upit2 = 'INSERT INTO `korisnici` (`idKorisnik`, `ime`, `prezime`, `email`, `date_created`, `disabled`, `password`, `idUloga`, `idWishlist`) VALUES (NULL, ?, ?, ?, current_timestamp(), 0, ?, 2, ?)';

    $prepare2 = $conn->prepare($upit2);

    $prepare2->bindParam(1, $fname);
    $prepare2->bindParam(2, $lname);
    $prepare2->bindParam(3, $email);
    $prepare2->bindParam(4, $enc);
    $prepare2->bindParam(5, $lastID);

    $result = $prepare2->execute();
    return $result;
}

function addProduct($imeProdukta, $opis, $cena, $kategorija, $brend, $velicina, $boja, $tag)
{
    global $conn;

    $nazivBoje = fetchWhere('`boje`', 'idBoja', '=', $boja);
    $bojaKolekcija = $nazivBoje->boja;

    insertIntoTableBind('`cena`', '(`idCena`, `nova`, `stara`)', [$cena, NULL]);
    $cenaId = $conn->lastInsertId();

    $upit = "INSERT INTO `produkti` (`idProdukt`, `imeProdukta`, `opis`, `novo`, `cena`, `kategorija`, `brend`) VALUES (NULL, ?, ?, '1', $cenaId, ?, ?)";

    $prepare = $conn->prepare($upit);

    $prepare->bindParam(1, $imeProdukta);
    $prepare->bindParam(2, $opis);
    $prepare->bindParam(3, $kategorija);
    $prepare->bindParam(4, $brend);

    $result = $prepare->execute();

    if ($result) {
        $id = $conn->lastInsertId();

        insertIntoTableBind('`produktivelicine`', '(`idProduktVelicina`, `idProdukt`, `idVelicina`)', [$id, $velicina]);
        insertIntoTableBind('`produktboja`', '(`idProduktBoja`, `idProdukt`, `idBoja`)', [$id, $boja]);
        insertIntoTableBind('`produkttag`', '(`idProduktTag`, `idProdukt`, `idTag`)', [$id, $tag]);

        insertIntoTableBind('`kolekcijaslika`', '(`idKolekcijaSlika`, `nazivKolekcije`, `idProdukt`, `idBoja`)', [$bojaKolekcija, $id, $boja]);
        $kolekcijaID = $conn->lastInsertId();
        return $kolekcijaID;
    } else {
        return 'Failed to add product';
    }
}
function insertIntoTableBind($table, $columns, $data)
{
    // [NULL, $bojaKolekcija, $id, $boja]
    global $conn;
    $values = "(NULL ";

    for ($i = 0; $i < count($data); $i++) {
        $values .= ", ?";
    }
    $values .= ")";

    $upit = "INSERT INTO $table $columns VALUES $values";

    $prepare = $conn->prepare($upit);

    foreach ($data as $key => &$val) {

        $bind = $key + 1;
        $prepare->bindParam($bind, $val);
    }
    $result = $prepare->execute();
    return $result;
}

function messageSent($fullName, $email, $msg)
{
    global $conn;


    $upit = 'INSERT INTO `messages` (`idMessages`, `fullName`, `email`, `message`) VALUES (NULL, ?, ?, ?)';

    $prepare = $conn->prepare($upit);
    $prepare->bindParam(1, $fullName);
    $prepare->bindParam(2, $email);
    $prepare->bindParam(3, $msg);

    $result = $prepare->execute();
    return $result;
}

<?php
header("Content-type: application/json");

include '../config/connection.php';
// creating the query

$query = "SELECT * FROM produkti AS p INNER JOIN kategorije AS k ON p.kategorija = k.idKategorija INNER JOIN brendovi AS b ON p.brend = b.idBrend INNER JOIN cena c ON p.cena = c.idCena INNER JOIN kolekcijaslika ks ON p.idProdukt = ks.idProdukt INNER JOIN slika s ON ks.idKolekcijaSlika = s.idKolekcijaSlika INNER JOIN produkttag pt ON p.idProdukt = pt.idProdukt INNER JOIN tagovi t ON t.idTag = pt.idTag INNER JOIN produktboja pb ON p.idProdukt = pb.idProdukt INNER JOIN boje bo ON bo.idBoja = pb.idBoja INNER JOIN produktivelicine pv ON p.idProdukt = pv.idProdukt INNER JOIN velicine v ON pv.idVelicina = v.idVelicina WHERE novo IN (0,1)";

$params = [];
if (isset($_GET['search'])) {
    $query .= " AND imeProdukta LIKE ?";
    $search = "%" . $_GET['search'] . "%";
    array_push($params, $search);
}
if (isset($_GET['categories'])) {
    $placeholders = implode(',', array_fill(0, count($_GET['categories']), '?'));
    $query .= " AND k.kategorija IN ($placeholders)";
    foreach ($_GET['categories'] as $cat) {
        array_push($params, $cat);
    }
}
if (isset($_GET['brands'])) {
    $placeholders = implode(',', array_fill(0, count($_GET['brands']), '?'));
    $query .= " AND b.brend IN ($placeholders)";
    foreach ($_GET['brands'] as $brand) {
        array_push($params, $brand);
    }
}
if (isset($_GET['colors'])) {
    $placeholders = implode(',', array_fill(0, count($_GET['colors']), '?'));
    $query .= " AND bo.boja IN ($placeholders)";
    foreach ($_GET['colors'] as $color) {
        array_push($params, $color);
    }
}
if (isset($_GET['size'])) {
    $placeholders = implode(',', array_fill(0, count($_GET['size']), '?'));
    $query .= " AND v.velicina IN ($placeholders)";
    foreach ($_GET['size'] as $color) {
        array_push($params, $color);
    }
}
if (isset($_GET['prices'])) {
    if($_GET['prices'] == 'all'){
        // $query .= " AND c.nova BETWEEN $val1 AND $val2";
    }
    else{
        $values = [];
        $values = explode('-', $_GET['prices']);
        $val1 = $values[0];
        $val2 = $values[1];
        $query .= " AND c.nova BETWEEN $val1 AND $val2";
    }
}
// if (isset($_GET['maxPrice'])) {
//     if (preg_match("/^[0-9]+(\.[0-9]*)?$/", $_GET['maxPrice'])) {
//         $query .= " AND price <= ?";
//         $maxPrice = floatval($_GET['maxPrice']);
//         array_push($params, $maxPrice);
//     }
// }
$query .= " GROUP BY p.idProdukt";

$orderValues = ['1', '2', '3', '4'];
if (isset($_GET['sortOrder'])) {
    $order = $_GET['sortOrder'];
    if (in_array($order, $orderValues)) {
        $text = '';
        switch ($order) {
            case '1':
                $text = "p.imeProdukta";
                break;
            case '2':
                $text = "p.imeProdukta DESC";
                break;
            case '3':
                $text = "c.nova";
                break;
            case '4':
                $text = "c.nova DESC";
                break;
        }
        $query .= " ORDER BY $text";
    }
}
// executing the query
global $conn;
$exec = $conn->prepare($query);
$exec->execute($params);
$result = $exec->fetchAll();
$numOfProducts = count($result);
// getting only 6 phones
$productPerPage = $_GET['productsPerPage'];
$page = ($_GET['page'] - 1) * $productPerPage;
$products = [];
for ($i = $page; $i < $productPerPage + $page; $i++) {
    if ($i >= count($result)) break;
    array_push($products, $result[$i]);
}
// response
$response = ['products' => $products, 'num' => $numOfProducts];
echo json_encode($response);
http_response_code(200);

<?php
session_start();
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $user = $_POST['user'];
        $product = $_POST['product'];
        $color = $_POST['color'];
        $size = $_POST['size'];
        $quantity = (int)$_POST['quantity'];

        $newObject = (object) array('userID' => $user, 'productID' => $product, 'color' => $color, 'size' => $size, 'quan' => $quantity);

        $test = 0;
        if (isset($_SESSION['cart'])) {
            $sessionObject = $_SESSION['cart'];
            foreach ($sessionObject as $object) {
                if ($object->productID == $newObject->productID && $object->color == $newObject->color && $object->size == $newObject->size) {
                    $object->quan += $newObject->quan;
                    $test = 1;
                    break;
                }
            }
            if ($test == 0) {
                array_push($_SESSION['cart'], $newObject);
            }
        } else {
            $_SESSION['cart'] = array($newObject);
        }

        if (isset($_SESSION['cart'])) {
            $response = ["msg" => "Added"];
            echo json_encode($response);
            http_response_code(200);
            header("Refresh:0");
        } else {
            $response = ["msg" => "Error"];
            echo json_encode($response);
            http_response_code(500);
        }
    } catch (PDOException $ex) {
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
?>
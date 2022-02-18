<?php
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'functions.php';
    include '../config/connection.php';
    try {
        $prodId = $_POST['prod'];
        $userId = $_POST['user'];
        if ($prodId && $userId != 0) {

            $wishlist = fetchWishlistProducts($userId);

            if (!empty($wishlist)) {

                foreach ($wishlist as $element) {
                    if ($element->idProdukt == $prodId) {
                        $response = ['msg' => 'Product Already added to wishlist'];
                        echo json_encode($response);
                        http_response_code(201);
                        exit;
                    }
                }
                $added = addToWishlist($prodId, $userId);

                if ($added) {
                    $response = ['msg' => 'Successfuly Added to wishlist'];
                    echo json_encode($response);
                    http_response_code(200);
                } else {
                    $response = ['msg' => 'Error'];
                    echo json_encode($response);
                }
            } else {
                $added = addToWishlist($prodId, $userId);

                if ($added) {
                    $response = ['msg' => 'Successfuly Added to wishlist'];
                    echo json_encode($response);
                    http_response_code(200);
                } else {
                    $response = ['msg' => 'Error'];
                    echo json_encode($response);
                }
            }
        }
    } catch (PDOException $exception) {
        http_response_code(500);
    }
} else {
    http_response_code(404);
}

<?php
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'functions.php';
    include '../config/connection.php';
    try {
        $prodId = $_POST['id'];

        if ($prodId != 0) {

            $removed = remove('wishlistprodukt', 'idProdukt', $prodId);

                if ($removed) {
                    $response = ['msg' => 'Successfuly removed from wishlist'];
                    echo json_encode($response);
                    http_response_code(200);
                } else {
                    $response = ['msg' => 'Error'];
                    echo json_encode($response);
                }
        }
    } catch (PDOException $exception) {
        http_response_code(500);
    }
} else {
    http_response_code(404);
}

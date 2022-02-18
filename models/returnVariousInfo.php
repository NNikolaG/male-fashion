<?php
session_start();
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'functions.php';
    include '../config/connection.php';
    try {
        if (isset($_POST['idProduktR'])) {
            $id = $_POST['idProduktR'];
            $result = getRating($id);
            $average = getAverage($result);

            $response = ['result' => $result, 'avg' => $average];
            http_response_code(201);
            echo json_encode($response);
        }
        if (isset($_POST['idProduktB'])) {
            $id = $_POST['idProduktB'];
            $colors = getColors($id);

            $response = ['colors' => $colors];
            http_response_code(201);
            echo json_encode($response);
        }
        if (isset($_POST['idProduktW'])) {
            if (isset($_SESSION['user'])) {
                $id = $_SESSION['user']->idKorisnik;

                $wishlit = fetchAllWhere('`wishlistprodukt` AS w INNER JOIN `korisnici` as k ON w.idWishlist = k.idWishlist', 'idKorisnik', ' = ',  $id);

                $response = ['wishlist' => $wishlit];
                http_response_code(201);
                echo json_encode($response);
            } else {
                $response = ['wishlist' => "empty"];
                http_response_code(201);
                echo json_encode($response);
            }
        }
    } catch (PDOException $exception) {
        http_response_code(500);
    }
} else {
    http_response_code(404);
}

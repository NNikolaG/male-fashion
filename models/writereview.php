<?php
session_start();
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../config/connection.php';
    include 'functions.php';
    try {
        $ocena = $_POST["ocenaX"];
        $komentar = $_POST['komentarX'];
        $korisnik = $_POST['userX'];
        $produkt = $_POST['produktX'];

        if ($ocena == 0 || strlen($komentar) == 0) {
            $response = ["msg" => "Invalid input"];
            http_response_code(201);
            echo json_encode($response);
        } else {
            $upis = sendReview($ocena, $komentar, $korisnik, $produkt);
            if ($upis) {
                $response = ['msg' => 'Review Sent'];
                http_response_code(201);
                echo json_encode($response);
            }
            else{
                $response = ['msg' => 'Error'];
                echo json_encode($response);
            }
        }
    } catch (PDOException $ex) {
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
?>
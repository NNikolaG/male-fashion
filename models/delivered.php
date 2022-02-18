<?php
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'functions.php';
    include '../config/connection.php';
    try {
        $orderID = $_POST['chBox'];
        if ($orderID) {

            $changed = changeDelivered($orderID);

            if ($changed) {
                header('Location: ../index.php?page=panel');
            }
        }
    } catch (PDOException $exception) {
        http_response_code(500);
    }
} else {
    http_response_code(404);
}

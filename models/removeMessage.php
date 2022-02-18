<?php
header('Content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'functions.php';
    include '../config/connection.php';
    try {
        $msgId = $_POST['id'];

        if ($msgId != 0) {

            $removed = remove('messages', 'idMessages', $msgId);

            if ($removed) {
                $response = ['msg' => 'Message Deleted'];
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

<?php
session_start();
header("Content: application/json");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../config/connection.php';
    include 'functions.php';
    try {
        $fullName = $_POST['fullName'];
        $email = $_POST['email'];
        $msg = $_POST['msg'];

        $errors = 0;

        //RegEx
        $emailRegEx = "/^([a-z0-9_ .-]+)@([\d a-z.-]+).([a-z.]{2,6})$/";
        $nameRegEx = "/^([A-ZŠĐČĆŽ][a-zšđčćž]{2,14}\s?)+$/";

        $niz = [
            preg_match($emailRegEx, $email),
            preg_match($nameRegEx, $fullName),
        ];

        foreach($niz as $element){
            if($element == 0){
                $errors++;
            }
        }
        if(strlen($msg) == 0){
            $errors++;
        }

        if ($errors == 0) {
            $msg = messageSent($fullName, $email, $msg);
            if ($msg) {
                $response = ["msg" => "Message Sent"];
                echo json_encode($response);
                http_response_code(201);
            }
            else{
                $response = ['msg'=> "Error Occured"];
                echo json_encode($response);
            }
        }
    } catch (PDOException $exception) {
        http_response_code(500);
    }
} else {
    http_response_code(404);
}

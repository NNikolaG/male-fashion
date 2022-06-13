<?php

header("Content: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include '../config/connection.php';

    include 'functions.php';

    try {

        $fname = $_POST['fname'];

        $lname = $_POST['lname'];

        $email = $_POST['emailRegX'];

        $password = $_POST['passwordX'];

        $passwordComf = $_POST['passwordComfX'];

        $encrypted = md5($password);



        $errors = 0;



        //RegEx

        $emailRegEx = "/^([a-z0-9_ .-]+)@([\d a-z.-]+).([a-z.]{2,6})$/";

        $nameRegEx = "/^([A-ZŠĐČĆŽ][a-zšđčćž]{2,14}\s?)+$/";



        $niz = [

            preg_match($emailRegEx, $email),

            preg_match($nameRegEx, $fname),

            preg_match($nameRegEx, $lname),

        ];



        foreach ($niz as $element) {

            if ($element == 0) {

                $errors++;

            }

        }

        if ($password != $passwordComf) {

            $errors++;

        }



        if ($errors == 0) {

            $createWishList = createWishlist();

            if ($createWishList != 0) {

                $registration = registration($fname, $lname, $email, $encrypted, $createWishList);

                if ($registration) {

                    $response = ["msg" => "Successful Registration"];

                    echo json_encode($response);

                    http_response_code(201);

                    

                } else {

                    $response = ["msg" => "Registration Failed"];

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


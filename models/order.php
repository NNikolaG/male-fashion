<?php

session_start();

header("Content: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include '../config/connection.php';

    include 'functions.php';

    try {

        if (isset($_SESSION['cart'])) {

            $products = [];

            foreach ($_SESSION['cart'] as $prod) {

                array_push($products, $prod->productID);

            }

            $firstName = $_POST['firstName'];

            $lastName = $_POST['lastName'];

            $email = $_POST['email'];

            $address = $_POST['address'];

            $zip = $_POST['zip'];

            $ccv = $_POST['ccv'];

            $cardOwner = $_POST['cardOwner'];

            $cardNum = $_POST['cardNum'];

            $country = $_POST['country'];

            $payment = $_POST['payment'];

            $cost = $_POST['cost'];

            $name = $firstName . ' ' . $lastName;

            $ccvEnc = md5($ccv);

            $cardNumEnc = md5($cardNum);


            $errors = 0;


            //RegEx

            $emailRegEx = "/^([a-z0-9_ .-]+)@([\d a-z.-]+).([a-z.]{2,6})$/";

            $nameRegEx = "/^([A-ZŠĐČĆŽ][a-zšđčćž]{2,14}\s?)+$/";

            $addressRegEx = "/^([A-Z]|[1-9]{1,4})[A-z\.\-\d\s]+$/";

            $zipRegEx = "/^[1-9]\d{4}$/";

            $ccvRegEx = "/^[0-9]{3,4}$/";

            $cardOwnerRegEx = "/^[A-ZČĆŽŠĐ]{3,14}\s[A-ZČĆŽŠĐ]{3,14}$/";

            $cardNumRegEx = "/^[1-9][0-9]{3}\-[1-9][0-9]{3}\-[1-9][0-9]{3}\-[1-9][0-9]{3}$/";


            $niz = [

                preg_match($emailRegEx, $email),

                preg_match($nameRegEx, $firstName),

                preg_match($nameRegEx, $lastName),

                preg_match($addressRegEx, $address),

                preg_match($zipRegEx, $zip),

                preg_match($ccvRegEx, $ccv),

                preg_match($cardOwnerRegEx, $cardOwner),

                preg_match($cardNumRegEx, $cardNum)

            ];


            foreach ($niz as $element) {

                if ($element == 0) {

                    $errors++;

                }

            }


            if ($errors == 0) {
                $order = ordering($name, $email, $address, $cost, $zip, $ccvEnc, $cardOwner, $cardNumEnc, $country, $payment);

                if ($order) {


                    $result = productOrder($order, $products);

                    if ($result) {

                        $response = ["msg" => "Successful Ordering"];

                        echo json_encode($response);

                        http_response_code(201);

                    } else {

                        $response = ['msg' => "Order Denied"];

                        echo json_encode($response);

                    }

                } else {

                    $response = ['msg' => "Order Denied"];

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


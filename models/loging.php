<?php

session_start();

header("Content: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include '../config/connection.php';

    include 'functions.php';

    try {

        $email = $_POST['emailLoginX'];

        $password = $_POST['passwordX'];

        $encrypted = md5($password);

        $errors = 0;

        //RegEx

        $emailRegEx = "/^([a-z0-9_ .-]+)@([\d a-z.-]+).([a-z.]{2,6})$/";

        if (preg_match($emailRegEx, $email) == 0) {

            $errors++;
        }

        $passwordRegEx = "/^(?=.*[\d])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*])[\w!@#$%^&*]{8,}$/";

        if (preg_match($passwordRegEx, $password) == 0) {

            $errors++;
        }


        if ($errors == 0) {

            $user = getUser('email', $email);

            if (!$user) { // checks if user exists

                $response = ["msg" => "Invalid credentials."];

                echo json_encode($response);

                http_response_code(200);
                
            } else {

                if ($user->password != $encrypted) { // checks if password is correct

                    updateLoginLog($user->email, 'Wrong password');

                    if (getFailedAttempts($user->email, 5) > 5) {

                        if (lockAccount($user->idKorisnik)) {

                            // sendEmail($user->idKorisnik);

                        };
                    }

                    $response = ["msg" => "Invalid credentials."];

                    echo json_encode($response);

                    http_response_code(200);
                } else {

                    if ($user->disabled == 0) {

                        if ($user->idUloga == 1) {

                            $_SESSION['admin'] = $user;
                        } else {

                            $_SESSION['user'] = $user;
                        }

                        $response = ["msg" => "Successful Logging"];

                        updateLoginLog($user->email, 'Successful Logging');

                        echo json_encode($response);

                        http_response_code(201);
                    } else {

                        updateLoginLog($user->email, 'Locked Account');

                        $response = ["msg" => "Your account is currently locked. Contact website

   administrator for more info."];

                        echo json_encode($response);

                        http_response_code(200);
                    }
                }
            }
        }
    } catch (PDOException $exception) {

        http_response_code(500);
    }
} else {

    http_response_code(404);
}

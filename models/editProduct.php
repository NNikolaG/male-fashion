<?php

session_start();

header("Content-type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include 'functions.php';

    include '../config/connection.php';

    try {

        global $conn;

        //Info
        $productId = $_POST['id'];

        $productName = $_POST['editName'];

        $desc = $_POST['desc'];

        $price = $_POST['Price'];

        $category = filter_input(INPUT_POST, 'cat', FILTER_SANITIZE_STRING);

        $brand = filter_input(INPUT_POST, 'radioBrend', FILTER_SANITIZE_STRING);

        //Color - Sizing

        $tag = $_POST['Tag'];

        $color = $_POST['Color'];

        $size = $_POST['Size'];

        $errorMsg = $errorColor = $errorName = $errorPrice = $errorTags = $errorSize = '';

        if (empty($productName)) {
            $errorName .= "Product name can't be empty | ";
        }
        if ($price < 500) {
            $errorPrice .= "Product price can't be less that 500 | ";
        }
        if (empty($tag)) {
            $errorTags .= "You must select at least one Tag ";
        }
        if (empty($size)) {
            $errorSize .= "You must select at least one Size | ";
        }
        if (empty($color)) {
            $errorColor .= "You must select at least one Color | ";
        }

        $errorMsg = $errorName . SEPARATOR . $errorColor . SEPARATOR . $errorSize . SEPARATOR . $errorTags;
        if (empty($errorMsg)) {
            updateErrorLog($errorMsg);
            header('Location: ../index.php?page=panel&edit=' . $productId);
        }
        //PRODUCT UPDATE

        $result = updateProduct($productId, $productName, $desc, $price, $brand, $category, $tag, $size, $color);
        $errorMsg = 'Product successfully updated' . SEPARATOR . SEPARATOR . SEPARATOR;
        updateErrorLog($errorMsg);
        header('Location: ../index.php?page=panel&edit=' . $productId);

    } catch (PDOException $exception) {

        header('Location: ../index.php?page=panel');

        http_response_code(500);

    }

} else {

    http_response_code(404);

}


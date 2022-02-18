<?php
session_start();
header("Content-type: application/json");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'functions.php';
    include '../config/connection.php';
    try {
        global $conn;

        //Info
        $productName = $_POST['prodName'];
        $desc = $_POST['desc'];
        $price = $_POST['Price'];
        $category = filter_input(INPUT_POST, 'Category', FILTER_SANITIZE_STRING);
        $brand = filter_input(INPUT_POST, 'Brand', FILTER_SANITIZE_STRING);

        //Color - Sizing
        $tag = filter_input(INPUT_POST, 'Tag', FILTER_SANITIZE_STRING);
        $color = filter_input(INPUT_POST, 'Color', FILTER_SANITIZE_STRING);
        $size = filter_input(INPUT_POST, 'Size', FILTER_SANITIZE_STRING);

        //Image Collection
        $colletion = filter_input(INPUT_POST, 'Collection', FILTER_SANITIZE_STRING);

        $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = $errorChoose = '';

        //PRODUCT DB INSERT
        $niz = ['Category' => $category, 'Brand' => $brand, 'Tag' => $tag, 'Color' => $color, 'Size' => $size];

        if (!in_array('choose', $niz) && $price >= 0) {

            $colletionId = addProduct($productName, $desc, $price, $category, $brand, $size, $color, $tag, $colletion);
        } else {
            foreach ($niz as $key => $val) {
                if ($val == 'choose') {
                    $errorChoose .= $key . ' | ';
                }
            }
        }
        $errorChoose = !empty($errorChoose) ? 'Choose Error at ' . $errorChoose : '';
        // IMAGE COLLECTION DB INSERT

        // File upload configuration 
        $targetDir = "../assets/img/product/";

        $allowTypes = array('jpg', 'png', 'jpeg');

        $fileNames = array_filter($_FILES['files']['name']);

        if (!empty($fileNames)) {
            foreach ($_FILES['files']['name'] as $key => $val) {
                // File upload path 
                $fileName = basename($_FILES['files']['name'][$key]);
                $targetFilePath = $targetDir . $fileName;
                // $targetFilePath2 = $targetDir2 . $fileName;

                $altTag = explode('.', $fileName)[0];

                // Check whether file type is valid 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                if (in_array($fileType, $allowTypes)) {
                    // Upload file to server 
                    if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                        // Image db insert sql

                        if (end($_FILES['files']['name']) == $val) {
                            $insertValuesSQL .= "(NULL, '" . $fileName . "', '" . $altTag . "', '" . $colletionId . "')";
                        } else {
                            $insertValuesSQL .= "(NULL, '" . $fileName . "', '" . $altTag . "', '" . $colletionId . "'), ";
                        }
                    } else {
                        $errorUpload .= $_FILES['files']['name'][$key] . ' | ';
                    }
                } else {
                    $errorUploadType .= $_FILES['files']['name'][$key] . ' | ';
                }
            }

            // Error message 
            $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
            $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';

            if (!empty($insertValuesSQL) && $colletion != 'choose') {
                $insertValuesSQL = trim($insertValuesSQL, ',');
                // Insert image file name into database

                $query = "INSERT INTO `slika` (`idSlika`, `nazivSlike`, `altTag`, `idKolekcijaSlika`) VALUES " . $insertValuesSQL;

                $insert = $conn->prepare($query)->execute();

                if ($insert) {
                    $statusMsg = "Files are uploaded Successfuly." . $errorMsg;
                    header('Location: ../index.php?page=shop');
                } else {
                    $statusMsg = "Sorry, there was an error uploading your file.";
                }
            } else {
                $statusMsg = "Upload failed! " . $errorMsg;
                header('Location: ../index.php?page=panel');
            }
        } else {
            $statusMsg = 'Please select a file to upload.';
            header('Location: ../index.php?page=panel');
        }
        $errorMsg = $errorChoose . SEPARATOR . $errorUpload . SEPARATOR . $errorUploadType . SEPARATOR . $statusMsg;
        updateErrorLog($errorMsg);
    } catch (PDOException $exception) {
        header('Location: ../index.php?page=panel');
        http_response_code(500);
    }
} else {
    http_response_code(404);
}

<?php

require_once "config.php";

try {
    $conn = new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE . ";charset=utf8", USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo $ex->getMessage();
}

function executeQuery($query)
{
    global $conn;
    return $conn->query($query)->fetchAll();
}

function zabeleziPristupStranici($page)
{
    $open = fopen(LOG_FAJL, "a");
    if ($open) {
        $date = date('d-m-Y H:i:s');    
        $text = $_SERVER['PHP_SELF']."?page=".$page.SEPARATOR.$date.SEPARATOR.$_SERVER['REMOTE_ADDR']."\n";
        fwrite($open, $text);
        fclose($open);
    }
}

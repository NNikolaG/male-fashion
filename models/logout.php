<?php
session_start();
if(isset($_SESSION['admin'])){
    unset($_SESSION['admin']);
    if(isset($_SESSION['cart'])){
        unset($_SESSION['cart']);
    }
}elseif(isset($_SESSION['user'])){
    unset($_SESSION['user']);
    if(isset($_SESSION['cart'])){
        unset($_SESSION['cart']);
    }
}elseif(isset($_SESSION['blogger'])){
    unset($_SESSION['blogger']);
    if(isset($_SESSION['cart'])){
        unset($_SESSION['cart']);
    }
}
header('Location: ../index.php?page=home');
?>
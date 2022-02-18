<?php
session_start();
if(isset($_SESSION['cart'])){
    unset($_SESSION['cart']);
    unset($_SESSION['info']);
}
header('Location: ../index.php?page=cart');
?>
<?php
session_start();
include 'config/connection.php';
include 'models/functions.php';

include 'pages/fixed/head.php';
include 'pages/fixed/header.php';

if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'home':
            include 'pages/views/index_content.php';
            break;
        case 'about':
            include 'pages/views/about.php';
            break;
        case 'shop':
            include 'pages/views/shop.php';
            break;
        case 'cart':
            include 'pages/views/cart.php';
            break;
        case 'contact':
            include 'pages/views/contact.php';
            break;
        case 'blog':
            include 'pages/views/blog.php';
            break;
        case 'login':
            include 'pages/views/login.php';
            break;
        case 'register':
            include 'pages/views/register.php';
            break;
        case 'faq':
            include 'pages/views/FAQ.php';
            break;
        case 'wishlist':
            include 'pages/views/wishlist.php';
            break;
        case 'details':
            include 'pages/views/details.php';
            break;
        case 'checkout':
            include 'pages/views/checkout.php';
            break;
        case 'panel':
            include 'pages/views/adminPanel.php';
            break;
        case 'response':
            include 'pages/views/response.php';
            break;
        case 'user':
            include 'pages/views/userPanel.php';
            break;
    }
} else {
    include 'pages/views/index_content.php';
}

include 'pages/fixed/footer.php';
include 'pages/fixed/scripts.php';
?>

</body>

</html>
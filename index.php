<?php
session_start();
include 'config/connection.php';
include 'models/functions.php';

include 'views/fixed/head.php';
include 'views/fixed/header.php';

if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'home':
            include 'views/pages/index_content.php';
            break;
        case 'about':
            include 'views/pages/about.php';
            break;
        case 'shop':
            include 'views/pages/shop.php';
            break;
        case 'cart':
            include 'views/pages/cart.php';
            break;
        case 'contact':
            include 'views/pages/contact.php';
            break;
        case 'login':
            include 'views/pages/login.php';
            break;
        case 'register':
            include 'views/pages/register.php';
            break;
        case 'faq':
            include 'views/pages/FAQ.php';
            break;
        case 'wishlist':
            include 'views/pages/wishlist.php';
            break;
        case 'details':
            include 'views/pages/details.php';
            break;
        case 'checkout':
            include 'views/pages/checkout.php';
            break;
        case 'panel':
            include 'views/pages/adminPanel.php';
            break;
        case 'response':
            include 'views/pages/response.php';
            break;
        case 'user':
            include 'views/pages/userPanel.php';
            break;
        case 'author':
            include 'views/pages/author.php';
            break;
    }
} else {
    include 'views/pages/index_content.php';
}

include 'views/fixed/footer.php';
include 'views/fixed/scripts.php';
?>

</body>

</html>
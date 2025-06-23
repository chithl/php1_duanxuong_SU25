<?php
session_start();


$page   = isset($_GET['page']) ? $_GET['page'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Hiển thị danh sách danh mục: ?page=category&action=index
// Thực hiện xoá danh mục: ?page=category&action=delete

// index: hiển thị danh sách records
// create: hiển thị giao diện thêm (form)
// store: thực hiện lưu trữ (thêm)
// edit: hiển thị giao diện sửa/ chi tiết (form)
// update: thực hiện lưu trữ (cập nhật)
// delete: thực hiện xoá
// show: hiển thị chi tiết (tuỳ chọn)

require_once 'config.php';
require_once 'Views/Client/Layouts/header.php';


require_once 'Controllers/Client/HomeController.php';

$home = new HomeController();


switch ($page){
    case 'product-list':
        require_once 'Controllers/Client/ProductController.php';
        $product = new ProductController();
        $product->productList();
        break;

    case 'product-detail':
        require_once 'Controllers/Client/ProductController.php';
        $product = new ProductController();
        $product->productDetail();
        break;

    case 'cart':
        require_once 'Controllers/Client/CartController.php';
        $cart = new CartController();
        $cart->cart();
        break;
    case 'checkout':
        require_once 'Controllers/Client/CartController.php';
        $cart = new CartController();
        $cart->checkout();
        break;
    case 'contact':
        $home->contact();
        break;
    case 'about':
        $home->about();
        break;
    case 'blog-list':
        require_once 'Controllers/Client/BlogController.php';
        $blog = new BlogController();
        $blog->blogList();
        break;
    case 'blog-detail':
        require_once 'Controllers/Client/BlogController.php';
        $blog = new BlogController();
        $blog->blogDetail();
        break;

    case 'login':
        require_once 'Controllers/Client/AuthController.php';
        $auth = new AuthController();
        $auth->login();
        break;
    case 'register':
        require_once 'Controllers/Client/AuthController.php';
        $auth = new AuthController();
        $auth->register();
        break;
    case 'profile':
        require_once 'Controllers/Client/AuthController.php';
        $auth = new AuthController();
        $auth->profile();
        break;
    case 'forgot-password':
        require_once 'Controllers/Client/AuthController.php';
        $auth = new AuthController();
        $auth->forgotPassword();
        break;
    case 'change-password':
        require_once 'Controllers/Client/AuthController.php';
        $auth = new AuthController();
        $auth->changePassword();
        break;
    case 'reset-password':
        require_once 'Controllers/Client/AuthController.php';
        $auth = new AuthController();
        $auth->resetPassword();
        break;
    case 'logout':
        require_once 'Controllers/Client/AuthController.php';
        $auth = new AuthController();
        $auth->logout();
        break;

    default:
        $home->index();
}

require_once 'Views/Client/Layouts/footer.php';

<?php
session_start();

// if (!isset($_SESSION['admin_username'])) {
//     header('location: dashboard.php');
//     exit;
// }
//if (!isset($_SESSION['admin']) && empty($_SESSION['admin'])) {
//    header('Location: admin.php?page=auth&action=login');
//    exit();
//}

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
require_once 'Views/Admin/Layouts/header.php';

switch ($page){
    case 'blog-category':
        require_once 'Controllers/Admin/BlogCategoryController.php';
        $blogCategoryControl = new BlogCategoryController();

        switch ($action){
            case 'index':
                // thực hiện gọi controller tương ứng
                $blogCategoryControl->index();

                break;

            case 'create':
                $blogCategoryControl->create();

                break;

            case 'store':
                $blogCategoryControl->store();
                break;

            case 'edit':
                $blogCategoryControl->edit();
                break;

            case 'update':
                $blogCategoryControl->update();
                break;

            case 'delete':
                $blogCategoryControl->delete();
                break;

            default:
                // hiển thị index (danh sách)
                // echo 'Danh sach';
                $blogCategoryControl->index();
                break;
        }
        break;
    case'auth':
        require_once 'Controllers/Admin/AuthController.php';
        $authControl = new AuthController();
        switch ($action){
            case 'login':
                // thực hiện gọi controller tương ứng
                $authControl->login();
                break;
            case 'logout':
                $authControl->logout();
                break;
            case 'forgotPassword':
                $authControl->forgotPassword();
                break;
            case 'storeForgotPassword':
                $authControl->storeForgotPassword();
                break;
            case 'resetPassword':
                $authControl->resetPassword();
                break;
            case 'storeResetPassword':
                $authControl->storeResetPassword();
                break;

        }
        break;
    case 'product-category':
        require_once 'Controllers/Admin/ProductCategoryController.php';
        $productCategoryControl = new ProductCategoryController();

        switch ($action){
            case 'index':
                // thực hiện gọi controller tương ứng
                $productCategoryControl->index();

                break;

            case 'create':
                $productCategoryControl->create();

                break;

            case 'store':
                $productCategoryControl->store();
                break;

            case 'edit':
                $productCategoryControl->edit();
                break;

            case 'update':
                $productCategoryControl->update();
                break;

            case 'delete':
                $productCategoryControl->delete();
                break;

            default:
                // hiển thị index (danh sách)
                // echo 'Danh sach';
                $productCategoryControl->index();
                break;
        }
        break;

    case 'product':
        require_once 'Controllers/Admin/ProductController.php';
        $productControl = new ProductController();
        switch ($action){

            case 'index':
                // thực hiện gọi controller tương ứng
                $productControl->index();
                break;

            case 'create':

                $productControl->create();
                break;

            case 'store':
                $productControl->store();
                break;

            case 'edit':
                $productControl->edit();
                break;

            case 'update':
                $productControl->update();
                break;
            case 'delete':
                $productControl->delete();
                break;

            default:
                // hiển thị index (danh sách)
                $productControl->index();
                break;
        }

        break;

    case 'blog':
        require_once 'Controllers/Admin/BlogController.php';
        $blogControl = new BlogController();
        switch ($action){

            case 'index':
                // thực hiện gọi controller tương ứng
                $blogControl->index();
                break;

            case 'create':

                $blogControl->create();
                break;

            case 'store':
                $blogControl->store();
                break;

            case 'edit':
                $blogControl->edit();
                break;

            case 'update':
                $blogControl->update();
                break;
            case 'delete':
                $blogControl->delete();
                break;

            default:
                // hiển thị index (danh sách)
                $blogControl->index();
                break;
        }

        break;

    case 'user':
        require_once 'Controllers/Admin/UserController.php';
        $userControl = new UserController();
        switch ($action){
            case 'index':
                // thực hiện gọi controller tương ứng
                $userControl->index();
                break;
            case 'create':
                $userControl->create();
                break;
            case 'store':
                $userControl->store();
                break;
            case 'edit':
                $userControl->edit();
                break;
            case 'update':
                $userControl->update();
                break;
            case 'delete':
                $userControl->delete();
                break;

            default:
                // hiển thị index (danh sách)
                $userControl->index();
                break;
        }
        break;
    case 'order':
        require_once 'Controllers/Admin/OrderController.php';
        $orderControl = new OrderController();
        switch ($action){
            case 'index':
                // thực hiện gọi controller tương ứng
                $orderControl->index();
                break;
            case 'create':
                $orderControl->create();
                break;
            case 'store':
                $orderControl->store();
                break;
            case 'edit':
                $orderControl->edit();
                break;
            case 'update':
                $orderControl->update();
                break;
            case 'delete':
                $orderControl->delete();
                break;

            default:
                // hiển thị index (danh sách)
                $orderControl->index();
                break;
        }
        break;
    default:
        include 'Views/Admin/Layouts/dashboard.php';
}

require_once 'Views/Admin/Layouts/footer.php';

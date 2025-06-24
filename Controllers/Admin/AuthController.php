<?php

require_once 'Models/User.php';

/**
 * Class AuthController
 *
 * Lớp AuthController quản lý các chức năng xác thực cho phần quản trị.
 */
class AuthController{

    /**
     * @var User $_userModel Đối tượng model User để thao tác với dữ liệu người dùng
     */
    private $_userModel;

    /**
     * AuthController constructor.
     * Khởi tạo đối tượng User model.
     */
    public function __construct(){
        $this->_userModel = new User();
    }

    /**
     * Hiển thị giao diện đăng nhập.
     *
     * Phương thức này sẽ nạp file giao diện đăng nhập cho admin.
     */
    public function login(){
        if (isset($_POST['login'])) {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');
            if (empty($username)) {
                $username_error = "Tên đăng nhập không được để trống";
                $error['username_error'] = $username_error;
            }
            if (empty($password)) {
                $username_error = "Mật khẩu không được để trống";
                $error['password_error'] = $username_error;
                echo 'Mật khẩu không được để trống';
            }
            if (!empty($error)) {
                $error['username_old'] = $username;
                $error['password_old'] = $password;
                $error['message'] = "Đăng nhập không thành công. Vui lòng kiểm tra lại thông tin đăng nhập.";
                $_SESSION['error'] = $error;
                header("Location: admin.php?page=auth&action=login");
                exit;
            }
            $user = $this->_userModel->Login($username, $password);
            if ($user) {
                if ($user['role'] != 'admin') {
                    $error['username_old'] = $username;
                    $error['password_old'] = $password;
                    $error['message'] = "Bạn không có quyền truy cập vào trang quản trị.";
                    $_SESSION['error'] = $error;
                    header("Location: admin.php?page=auth&action=login");
                    exit;
                }
                if ($user['status'] == 0) {
                    $error['username_old'] = $username;
                    $error['password_old'] = $password;
                    echo 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên để biết thêm chi tiết.';
                    $_SESSION['error'] = $error;
                    header("Location: admin.php?page=auth&action=login");
                    exit;
                } else {
                    // Đăng nhập thành công
                    $_SESSION['admin'] = $user;
                    header("Location: admin.php");
                    exit;
                }
            } else {
                $error['username_old'] = $username;
                $error['password_old'] = $password;
                $error['message'] = "Tên đăng nhập hoặc mật khẩu không đúng";
                $_SESSION['error'] = $error;
                header("Location: admin.php?page=auth&action=login");
                exit;
            }
        }
        include 'Views/Admin/Auth/login.php';
        unset($_SESSION['error']);
    }

    public function logout(){
        // Xoá session đăng nhập
        session_start();
        unset($_SESSION['admin']);

        // Chuyển hướng về trang đăng nhập
        header('Location: ?page=auth&action=login');
    }
}
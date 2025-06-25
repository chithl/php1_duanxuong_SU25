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
        if (isset($_POST['login'])){
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');
            if (empty($username)){
                $username_error = "Tên đăng nhập không được để trống";
                $error['username_error'] = $username_error;
            }
            if (empty($password)){
                $username_error = "Mật khẩu không được để trống";
                $error['password_error'] = $username_error;
                echo 'Mật khẩu không được để trống';
            }
            if (!empty($error)){
                $error['username_old'] = $username;
                $error['password_old'] = $password;
                $error['message'] = "Đăng nhập không thành công. Vui lòng kiểm tra lại thông tin đăng nhập.";
                $_SESSION['error'] = $error;
                header("Location: admin.php?page=auth&action=login");
                exit;
            }
            $user = $this->_userModel->Login($username, $password);
            if ($user){
                if ($user['role'] != 'admin'){
                    $error['username_old'] = $username;
                    $error['password_old'] = $password;
                    $error['message'] = "Bạn không có quyền truy cập vào trang quản trị.";
                    $_SESSION['error'] = $error;
                    header("Location: admin.php?page=auth&action=login");
                    exit;
                }
                if ($user['status'] == 0){
                    $error['username_old'] = $username;
                    $error['password_old'] = $password;
                    echo 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên để biết thêm chi tiết.';
                    $_SESSION['error'] = $error;
                    header("Location: admin.php?page=auth&action=login");
                    exit;
                }else{
                    // Đăng nhập thành công
                    $_SESSION['admin'] = $user;
                    header("Location: admin.php");
                    exit;
                }
            }else{
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

    public function forgotPassword(){
        include 'Views/Admin/Auth/fogorPassword.php';

    }

    public function storeForgotPassword(){
        session_start();
        $this->_userModel = new User();
        if (!isset($_POST['reset'])){
            header('location: ?page=auth&action=login');
            exit;
        }

        $username = $_POST['username'] ?? '';
        $email    = $_POST['email'] ?? '';
        $errors   = [];

        // Kiểm tra username
        if ($username === ''){
            $errors['username'] = 'Tên tài khoản không được để trống.';
        }elseif (strlen($username) < 6 || strlen($username) > 12){
            $errors['username'] = 'Tên tài khoản phải từ 6 đến 12 ký tự.';
        }elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)){
            $errors['username'] = 'Tên tài khoản chỉ được chứa chữ cái, số, dấu gạch dưới và không được chứa khoảng trắng.';
        }elseif (ctype_digit($username)){
            $errors['username'] = 'Tên tài khoản không được chỉ gồm số.';
        }

        // Kiểm tra email
        if ($email === ''){
            $errors['email'] = 'Địa chỉ email không được để trống hoặc chứa khoảng trắng.';
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Địa chỉ email không đúng định dạng.';
        }

        //        Kiểm tra thông tin tài khoản
        if (empty($errors)){
            $user = $this->_userModel->getInfoExact($username);

            if (!$user){
                $errors['username'] = 'Tên tài khoản không tồn tại.';
            }elseif ($user['email'] !== $email){
                $errors['email'] = 'Địa chỉ email không đúng.';
            }
        }

        if (!empty($errors)){
            $_SESSION['errors']   = $errors;
            $_SESSION["old_data"] = $_POST;
            header('location: ?page=auth&action=forgotPassword');
            exit;
        }

        $result = $this->_userModel->resetToken($username, $email);

        if ($result){
            echo 'Gửi mã thành công.';
            header('location: admin.php?page=auth&action=resetPassword');
            exit;
        }
        header('location: ?page=auth&action=login');
        exit;
    }

    public function storeResetPassword(){
        session_start();
        $this->_userModel = new User();
        if (!isset($_POST['resset_password'])){
            header('location: ?page=auth&action=login');
            exit;
        }

        $username        = $_POST['username'] ?? '';
        $token           = $_POST['reset_token'] ?? '';
        $newPassword     = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        $tokenInfo       = $this->_userModel->getTokenInfo($username, $token);
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        // Kiểm tra username
        if ($username === ''){
            $errors['username'] = 'Tên tài khoản không được để trống.';
        }elseif (strlen($username) < 6 || strlen($username) > 12){
            $errors['username'] = 'Tên tài khoản phải từ 6 đến 12 ký tự.';
        }elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)){
            $errors['username'] = 'Tên tài khoản chỉ được chứa chữ cái, số, dấu gạch dưới và không được chứa khoảng trắng.';
        }elseif (ctype_digit($username)){
            $errors['username'] = 'Tên tài khoản không được chỉ gồm số.';
        }

        // Kiểm tra reset token
        if ($token === ''){
            $errors['reset_token'] = 'Mã xác nhận không được để trống.';
        }elseif (preg_match('/\s/', $token)){
            $errors['reset_token'] = 'Mã xác nhận không được chứa khoảng trắng.';
        }elseif (!$tokenInfo){
            $errors['reset_token'] = 'Mã xác nhận không tồn tại.';
        }elseif (strtotime($tokenInfo['reset_token_expiry']) < time()){
            $errors['reset_token'] = 'Mã xác nhận đã hết hạn.';
        }
        var_dump($tokenInfo);

        // Kiểm tra new password
        if ($newPassword === ''){
            $errors['new_password'] = 'Mật khẩu không được để trống.';
        }elseif (strlen($newPassword) < 8 || strlen($newPassword) > 16){
            $errors['new_password'] = 'Mật khẩu phải từ 8 đến 16 ký tự.';
        }elseif (
            !preg_match('/[A-Z]/', $newPassword) ||
            !preg_match('/[a-z]/', $newPassword) ||
            !preg_match('/[0-9]/', $newPassword) ||
            !preg_match('/[\W_]/', $newPassword)
        ){
            $errors['new_password'] = 'Mật khẩu phải chứa ít nhất 1 chữ hoa, 1 chữ thường, 1 số và 1 ký tự đặc biệt.';
        }elseif (preg_match('/\s/', $newPassword)){
            $errors['new_password'] = 'Mật khẩu không được chứa khoảng trắng.';
        }elseif ($newPassword !== $confirmPassword){
            $errors['confirm_password'] = 'Mật khẩu xác nhận không khớp với mật khẩu mới.';
        }

        // Kiểm tra confirm password
        if ($confirmPassword === ''){
            $errors['confirm_password'] = 'Mật khẩu không được để trống.';
        }elseif (strlen($confirmPassword) < 8 || strlen($confirmPassword) > 16){
            $errors['confirm_password'] = 'Mật khẩu phải từ 8 đến 16 ký tự.';
        }elseif (
            !preg_match('/[A-Z]/', $confirmPassword) ||
            !preg_match('/[a-z]/', $confirmPassword) ||
            !preg_match('/[0-9]/', $confirmPassword) ||
            !preg_match('/[\W_]/', $confirmPassword)
        ){
            $errors['confirm_password'] = 'Mật khẩu phải chứa ít nhất 1 chữ hoa, 1 chữ thường, 1 số và 1 ký tự đặc biệt.';
        }elseif (preg_match('/\s/', $confirmPassword)){
            $errors['confirm_password'] = 'Mật khẩu không được chứa khoảng trắng.';
        }

        if (!empty($errors)){
            $_SESSION['errors']   = $errors;
            $_SESSION["old_data"] = $_POST;
            header('location: ?page=auth&action=resetPassword');
            exit;
        }

        $result = $this->_userModel->resetPassword($username, $token, $newPassword);

        if ($result){
            header('location: admin.php?page=auth&action=login');
            exit;
        }
    }

    public function resetPassword(){
        include 'Views/Admin/Auth/resetpassword.php';
        unset($_SESSION['errors']);

    }

    public function logout(){
        unset($_SESSION['admin']);
        header('location: admin.php?page=auth&action=login');
        exit;
    }
}
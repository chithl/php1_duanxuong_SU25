<?php

require_once 'Models/User.php';

/**
 * Class AuthController
 *
 * Lớp AuthController quản lý các chức năng xác thực người dùng phía client như đăng nhập, đăng ký,
 * quên mật khẩu, đổi mật khẩu, v.v.
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
     * Hiển thị trang đăng nhập.
     *
     * Nạp giao diện đăng nhập cho người dùng.
     */
    public function login(){
        include 'Views/Client/Auth/login.php';
    }

    public function handleLogin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->_userModel = new User();
        if (!isset($_POST['login'])) {
            header('location: ?page=login&action=index');
            exit;
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $errors = [];

// Kiểm tra username
        if ($username === '') {
            $errors['username'] = 'Tên tài khoản không được để trống.';
        } elseif (strlen($username) < 6 || strlen($username) > 12) {
            $errors['username'] = 'Tên tài khoản phải từ 6 đến 12 ký tự.';
        } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
            $errors['username'] = 'Tên tài khoản chỉ được chứa chữ cái, số, dấu gạch dưới và không được chứa khoảng trắng.';
        } elseif (ctype_digit($username)) {
            $errors['username'] = 'Tên tài khoản không được chỉ gồm số.';
        }

// Kiểm tra password
        if ($password === '') {
            $errors['password'] = 'Mật khẩu không được để trống.';
        } elseif (strlen($password) < 8 || strlen($password) > 16) {
            $errors['password'] = 'Mật khẩu phải từ 8 đến 16 ký tự.';
        } elseif (
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[a-z]/', $password) ||
            !preg_match('/[0-9]/', $password) ||
            !preg_match('/[\W_]/', $password)
        ) {
            $errors['password'] = 'Mật khẩu phải chứa ít nhất 1 chữ hoa, 1 chữ thường, 1 số và 1 ký tự đặc biệt.';
        } elseif (preg_match('/\s/', $password)) {
            $errors['password'] = 'Mật khẩu không được chứa khoảng trắng.';
        }

// Kiểm tra thông tin tài khoản
        if (empty($errors)) {
            $userId = $this->_userModel->getIdByUsername($username);
            $user = $this->_userModel->getInfoExact($username);

            if (!$user) {
                $errors['username'] = 'Tên tài khoản không tồn tại.';
            } elseif (!password_verify($password, $user['password'])) {
                $errors['password'] = 'Mật khẩu không đúng.';
            }
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION["old_data"] = $_POST;
            header('location: ?page=login&action=index');
            exit;
        }

        if ($user) {
            $_SESSION['login'] = $user;
            $_SESSION['userId'] = $userId;
            header('location: index.php');
            exit;
        }

        header('location: ?page=login&action=index');
        exit;
    }

    /**
     * Hiển thị trang đăng ký.
     *
     * Nạp giao diện đăng ký cho người dùng.
     */
    public function register(){
        include 'Views/Client/Auth/register.php';
    }

    public function handleRegister()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->_userModel = new User();
        if (!isset($_POST['register'])) {
            header('location: ?page=register&action=index');
            exit;
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $birth = $_POST['birth'] ?? '';
        $avatar = $_FILES['avatar'] ?? null;
        $errors = [];

        $userUsername = $this->_userModel->getInfoExact($username);
        $userEmail = $this->_userModel->getInfoByEmail($email);

// Kiểm tra username
        if ($username === '') {
            $errors['username'] = 'Tên tài khoản không được để trống.';
        } elseif (strlen($username) < 6 || strlen($username) > 12) {
            $errors['username'] = 'Tên tài khoản phải từ 6 đến 12 ký tự.';
        } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
            $errors['username'] = 'Tên tài khoản chỉ được chứa chữ cái, số, dấu gạch dưới và không được chứa khoảng trắng.';
        } elseif (ctype_digit($username)) {
            $errors['username'] = 'Tên tài khoản không được chỉ gồm số.';
        } elseif ($userUsername) {
            $errors['username'] = 'Tên tài khoản đã tồn tại.';
        }

// Kiểm tra password
        if ($password === '') {
            $errors['password'] = 'Mật khẩu không được để trống.';
        } elseif (strlen($password) < 8 || strlen($password) > 16) {
            $errors['password'] = 'Mật khẩu phải từ 8 đến 16 ký tự.';
        } elseif (
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[a-z]/', $password) ||
            !preg_match('/[0-9]/', $password) ||
            !preg_match('/[\W_]/', $password)
        ) {
            $errors['password'] = 'Mật khẩu phải chứa ít nhất 1 chữ hoa, 1 chữ thường, 1 số và 1 ký tự đặc biệt.';
        } elseif (preg_match('/\s/', $password)) {
            $errors['password'] = 'Mật khẩu không được chứa khoảng trắng.';
        }

// Kiểm tra email
        if ($email === '') {
            $errors['email'] = 'Địa chỉ email không được để trống hoặc chứa khoảng trắng.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Địa chỉ email không đúng định dạng.';
        } elseif ($userEmail) {
            $errors['email'] = 'Địa chỉ email đã tồn tại.';
        }

// Kiểm tra số điện thoại
        if ($phone === '') {
            $errors['phone'] = 'Số điện thoại không được để trống hoặc chứa khoảng trắng.';
        } elseif (!preg_match('/^0\d{9}$/', $phone)) {
            $errors['phone'] = 'Số điện thoại không hợp lệ, phải bắt đầu bằng số 0 và có 10 chữ số.';
        }

// Kiểm tra avatar
        if (!$avatar || empty($avatar['name'])) {
            $errors['avatar'] = 'Ảnh đại diện không được để trống.';
        } else {
            $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];
            $file_ext = strtolower(pathinfo($avatar['name'], PATHINFO_EXTENSION));
            if (!in_array($file_ext, $allowed_exts)) {
                $errors['avatar'] = 'Ảnh đại diện chỉ cho phép định dạng JPG, JPEG, PNG, GIF.';
            } elseif ($avatar['size'] > 2 * 1024 * 1024) {
                $errors['avatar'] = 'Ảnh đại diện không được vượt quá 2MB.';
            }
        }

// Kiểm tra ngày sinh
        if ($birth === '') {
            $errors['birth'] = 'Ngày sinh không được để trống.';
        } else {
            $birthDate = new DateTime($birth);
            $today = new DateTime();
            $age = $today->diff($birthDate)->y;

            if ($birthDate > $today) {
                $errors['birth'] = 'Ngày sinh không thể ở tương lai.';
            } elseif ($age < 16) {
                $errors['birth'] = 'Bạn phải từ 16 tuổi trở lên để đăng ký.';
            }
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_data'] = $_POST;
            header('location: ?page=register&action=index');
            exit;
        }

// Upload avatar
        $avatar_name = null;

        if ($avatar && $avatar['error'] == 0) {
            $target_dir = 'Assets/Client/Images/';
            $avatar_name = time() . '_' . basename($avatar['name']);
            move_uploaded_file($avatar['tmp_name'], $target_dir . $avatar_name);
        }

        $result = $this->_userModel->insert($username, $password, $email, $phone, $birth, $avatar_name);

        if ($result) {
            header('location: ?page=login&action=index');
            exit;
        }

        header('location: ?page=register&action=index');
        exit;
    }

    /**
     * Hiển thị trang thông tin cá nhân.
     *
     * Nạp giao diện thông tin cá nhân cho người dùng.
     */
    public function profile(){
        $this->_userModel = new User();
        $id = $_GET["id"] ?? "";
        if ($id == "") {
            header("Location: index.php");
            exit;
        }
        $user = $this->_userModel->getUserById($id);
        include 'Views/Client/Auth/profile.php';
    }

    /**
     * Hiển thị trang quên mật khẩu.
     *
     * Nạp giao diện quên mật khẩu cho người dùng.
     */
    public function forgotPassword(){
        include 'Views/Client/Auth/forgot-password.php';
    }

    public function handleForgotPassword()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->_userModel = new User();
        if (!isset($_POST['forgot-password'])) {
            header('location: ?page=forgot-password&action=index');
            exit;
        }

        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $errors = [];

// Kiểm tra username
        if ($username === '') {
            $errors['username'] = 'Tên tài khoản không được để trống.';
        } elseif (strlen($username) < 6 || strlen($username) > 12) {
            $errors['username'] = 'Tên tài khoản phải từ 6 đến 12 ký tự.';
        } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
            $errors['username'] = 'Tên tài khoản chỉ được chứa chữ cái, số, dấu gạch dưới và không được chứa khoảng trắng.';
        } elseif (ctype_digit($username)) {
            $errors['username'] = 'Tên tài khoản không được chỉ gồm số.';
        }

// Kiểm tra email
        if ($email === '') {
            $errors['email'] = 'Địa chỉ email không được để trống hoặc chứa khoảng trắng.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Địa chỉ email không đúng định dạng.';
        }

//        Kiểm tra thông tin tài khoản
        if (empty($errors)) {
            $user = $this->_userModel->getInfoExact($username);

            if (!$user) {
                $errors['username'] = 'Tên tài khoản không tồn tại.';
            } elseif ($user['email'] !== $email) {
                $errors['email'] = 'Địa chỉ email không đúng.';
            }
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_data'] = $_POST;
            header('location: ?page=forgot-password&action=index');
            exit;
        }

        $result = $this->_userModel->resetToken($username, $email);

        if ($result) {
            $_SESSION['success'] = 'Gửi mã thành thành công.';
            header('location: ?page=reset-password&action=index');
            exit;
        }

        header('location: ?page=forgot-password&action=index');
        exit;
    }

    /**
     * Hiển thị trang đổi mật khẩu.
     *
     * Nạp giao diện đổi mật khẩu cho người dùng.
     */
    public function changePassword(){
        include 'Views/Client/Auth/change-password.php';
    }

    /**
     * Hiển thị trang đặt lại mật khẩu.
     *
     * Nạp giao diện đặt lại mật khẩu cho người dùng.
     */
    public function resetPassword(){
        include 'Views/Client/Auth/reset-password.php';
    }

    public function handleResetPassword()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->_userModel = new User();
        if (!isset($_POST['reset-password'])) {
            header('location: ?page=reset-password&action=index');
            exit;
        }

        $username = $_POST['username'] ?? '';
        $token = $_POST['reset_token'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        $tokenInfo = $this->_userModel->getTokenInfo($username, $token);
        date_default_timezone_set('Asia/Ho_Chi_Minh');

// Kiểm tra username
        if ($username === '') {
            $errors['username'] = 'Tên tài khoản không được để trống.';
        } elseif (strlen($username) < 6 || strlen($username) > 12) {
            $errors['username'] = 'Tên tài khoản phải từ 6 đến 12 ký tự.';
        } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
            $errors['username'] = 'Tên tài khoản chỉ được chứa chữ cái, số, dấu gạch dưới và không được chứa khoảng trắng.';
        } elseif (ctype_digit($username)) {
            $errors['username'] = 'Tên tài khoản không được chỉ gồm số.';
        }

// Kiểm tra reset token
        if ($token === '') {
            $errors['reset_token'] = 'Mã xác nhận không được để trống.';
        } elseif (preg_match('/\s/', $token)) {
            $errors['reset_token'] = 'Mã xác nhận không được chứa khoảng trắng.';
        } elseif (!$tokenInfo) {
            $errors['reset_token'] = 'Mã xác nhận không tồn tại.';
        } elseif (strtotime($tokenInfo['reset_token_expiry']) < time()) {
            $errors['reset_token'] = 'Mã xác nhận đã hết hạn.';
        }

// Kiểm tra new password
        if ($newPassword === '') {
            $errors['password'] = 'Mật khẩu không được để trống.';
        } elseif (strlen($newPassword) < 8 || strlen($newPassword) > 16) {
            $errors['password'] = 'Mật khẩu phải từ 8 đến 16 ký tự.';
        } elseif (
            !preg_match('/[A-Z]/', $newPassword) ||
            !preg_match('/[a-z]/', $newPassword) ||
            !preg_match('/[0-9]/', $newPassword) ||
            !preg_match('/[\W_]/', $newPassword)
        ) {
            $errors['password'] = 'Mật khẩu phải chứa ít nhất 1 chữ hoa, 1 chữ thường, 1 số và 1 ký tự đặc biệt.';
        } elseif (preg_match('/\s/', $newPassword)) {
            $errors['password'] = 'Mật khẩu không được chứa khoảng trắng.';
        }

// Kiểm tra confirm password
        if ($confirmPassword === '') {
            $errors['password'] = 'Mật khẩu không được để trống.';
        } elseif (strlen($confirmPassword) < 8 || strlen($confirmPassword) > 16) {
            $errors['password'] = 'Mật khẩu phải từ 8 đến 16 ký tự.';
        } elseif (
            !preg_match('/[A-Z]/', $confirmPassword) ||
            !preg_match('/[a-z]/', $confirmPassword) ||
            !preg_match('/[0-9]/', $confirmPassword) ||
            !preg_match('/[\W_]/', $confirmPassword)
        ) {
            $errors['password'] = 'Mật khẩu phải chứa ít nhất 1 chữ hoa, 1 chữ thường, 1 số và 1 ký tự đặc biệt.';
        } elseif (preg_match('/\s/', $confirmPassword)) {
            $errors['password'] = 'Mật khẩu không được chứa khoảng trắng.';
        }

//        Kiểm tra password
        if ($newPassword !== $confirmPassword) {
            $errors['password'] = 'Mật khẩu không giống nhau.';
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_data'] = $_POST;
            header('location: ?page=reset-password&action=index');
            exit;
        }

        $result = $this->_userModel->resetPassword($username, $token, $newPassword);

        if ($result) {
            header('location: ?page=login&action=index');
            exit;
        }

        header('location: ?page=reset-password&action=index');
        exit;
    }
    /**
     * Xử lý đăng xuất người dùng.
     *
     * Thực hiện các thao tác đăng xuất như xoá session, cookie, v.v.
     */
    public function logout(){
        session_start();
        unset($_SESSION['login']);
        unset($_SESSION['userId']);
        header('location: index.php');
        exit;
    }

}
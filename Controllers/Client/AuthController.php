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

    /**
     * Hiển thị trang đăng ký.
     *
     * Nạp giao diện đăng ký cho người dùng.
     */
    public function register(){
        include 'Views/Client/Auth/register.php';
    }

    /**
     * Hiển thị trang thông tin cá nhân.
     *
     * Nạp giao diện thông tin cá nhân cho người dùng.
     */
    public function profile(){
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

    /**
     * Xử lý đăng xuất người dùng.
     *
     * Thực hiện các thao tác đăng xuất như xoá session, cookie, v.v.
     */
    public function logout(){
        // Xử lý đăng xuất ở đây
        // Ví dụ: xoá session, cookie, v.v.
    }

}
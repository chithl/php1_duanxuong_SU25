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
        include 'Views/Admin/Auth/login.php';
    }
}
<?php
// Đây là controller xử lý ở phía client

/**
 * Class HomeController
 *
 * Lớp HomeController quản lý các chức năng hiển thị trang chủ, giới thiệu và liên hệ phía client.
 */
class HomeController{

    /**
     * Hiển thị trang chủ.
     *
     * Nạp giao diện trang chủ cho người dùng.
     */
    public function index(){
        include 'Views/Client/index.php';
    }

    /**
     * Hiển thị trang giới thiệu.
     *
     * Nạp giao diện trang giới thiệu cho người dùng.
     */
    public function about(){
        include 'Views/Client/about.php';
    }

    /**
     * Hiển thị trang liên hệ.
     *
     * Nạp giao diện trang liên hệ cho người dùng.
     */
    public function contact(){
        include 'Views/Client/contact.php';
    }

}
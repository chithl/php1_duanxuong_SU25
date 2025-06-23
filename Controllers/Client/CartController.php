<?php

/**
 * Class CartController
 *
 * Lớp CartController quản lý các chức năng hiển thị giỏ hàng và thanh toán phía client.
 */
class CartController{

    /**
     * CartController constructor.
     * Khởi tạo đối tượng CartController.
     */
    public function __construct(){
    }

    /**
     * Hiển thị trang giỏ hàng.
     *
     * Nạp giao diện giỏ hàng cho người dùng.
     */
    public function cart(){
        include 'Views/Client/Cart/index.php';
    }

    /**
     * Hiển thị trang thanh toán.
     *
     * Nạp giao diện thanh toán cho người dùng.
     */
    public function checkout(){
        include 'Views/Client/Cart/checkout.php';
    }
}
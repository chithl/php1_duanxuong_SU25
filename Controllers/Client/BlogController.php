<?php

require_once 'Models/Blog.php';

/**
 * Class BlogController
 *
 * Lớp BlogController quản lý các chức năng hiển thị bài viết phía client.
 */
class BlogController{

    /**
     * @var Blog $_blogModel Đối tượng model Blog để thao tác với dữ liệu bài viết
     */
    private $_blogModel;

    /**
     * BlogController constructor.
     * Khởi tạo đối tượng Blog model.
     */
    public function __construct(){
        $this->_blogModel = new Blog();
    }

    /**
     * Hiển thị trang danh sách bài viết.
     *
     * Nạp giao diện danh sách bài viết cho người dùng.
     */
    public function blogList(){
        include 'Views/Client/Blog/index.php';
    }

    /**
     * Hiển thị trang chi tiết bài viết.
     *
     * Nạp giao diện chi tiết bài viết cho người dùng.
     */
    public function blogDetail(){
        include 'Views/Client/Blog/detail.php';
    }

}
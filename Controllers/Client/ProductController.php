<?php

require_once 'Models/Product.php';

/**
 * Class ProductController
 *
 * Lớp ProductController quản lý các chức năng hiển thị sản phẩm phía client.
 */
class ProductController{

    /**
     * @var Product $_productModel Đối tượng model Product để thao tác với dữ liệu sản phẩm
     */
    private $_productModel;

    /**
     * ProductController constructor.
     * Khởi tạo đối tượng Product model.
     */
    public function __construct(){
        $this->_productModel = new Product();
    }

    /**
     * Hiển thị danh sách tất cả sản phẩm.
     *
     * Nạp giao diện danh sách sản phẩm cho người dùng.
     */
    public function productList(){
        $name = trim($_GET['name'] ?? '');
        if ($name !== ''){
            $products = $this->_productModel->getAllByName($name);
        }else{
            $products = $this->_productModel->getAll();
        }
        include 'Views/Client/Product/index.php';
    }

    /**
     * Hiển thị chi tiết sản phẩm.
     *
     * Nạp giao diện chi tiết sản phẩm cho người dùng.
     */
    public function productDetail(){
        $id       = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $product  = $this->_productModel->getOne($id);
        $products = $this->_productModel->getAll();

        include 'Views/Client/Product/detail.php';
    }

}
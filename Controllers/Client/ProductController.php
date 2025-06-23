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
        $products = [
            [
                'id'          => 1,
                'name'        => 'San pham 1',
                'price'       => 1000000,
                'description' => 'Mo ta san phan',
                'image'       => 'product1.jpg',
                'status'      => 1,
                'is_feature'  => 1
            ],
            [
                'id'          => 2,
                'name'        => 'San pham 2',
                'price'       => 1000000,
                'description' => 'Mo ta san phan',
                'image'       => 'product2.jpg',
                'status'      => 1,
                'is_feature'  => 1
            ],
            [
                'id'          => 3,
                'name'        => 'San pham 3',
                'price'       => 1000000,
                'description' => 'Mo ta san phan',
                'image'       => 'product3.jpg',
                'status'      => 1,
                'is_feature'  => 1
            ],
        ];

        include 'Views/Client/Product/index.php';
    }

    /**
     * Hiển thị chi tiết sản phẩm.
     *
     * Nạp giao diện chi tiết sản phẩm cho người dùng.
     */
    public function productDetail(){
        $product = [
            'id'          => 1,
            'name'        => 'San pham 1',
            'price'       => 1000000,
            'description' => 'Mo ta san phan',
            'image'       => 'product1.jpg',
            'status'      => 1,
            'is_feature'  => 1
        ];

        include 'Views/Client/Product/detail.php';
    }

}
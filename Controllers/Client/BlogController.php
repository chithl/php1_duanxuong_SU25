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
        $keyword        = trim($_GET['keyword'] ?? '');
        $blogCategoryId = $_GET['category'] ?? '';

        // ✅ Nếu người dùng gõ "tất cả" (bất kể viết hoa hay không)
        if (mb_strtolower($keyword, 'UTF-8') === 'tất cả'){
            $keyword = '';  // reset keyword về rỗng để load tất cả
        }

        if ($blogCategoryId !== '' && $keyword !== ''){
            $blogs = $this->_blogModel->searchByCategory($keyword, $blogCategoryId);
        }elseif ($blogCategoryId !== ''){
            $blogs = $this->_blogModel->getAllByCategory($blogCategoryId);
        }elseif ($keyword !== ''){
            $blogs = $this->_blogModel->search($keyword);
        }else{
            $blogs = $this->_blogModel->getAll();
        }

        $blogs_categories = $this->_blogModel->getCategoriesWithCount();
        include 'Views/Client/Blog/index.php';
    }


    /**
     * Hiển thị trang chi tiết bài viết.
     *
     * Nạp giao diện chi tiết bài viết cho người dùng.
     */
    public function blogDetail(){
        $id = $_GET['id'] ?? NULL;
        if (!$id || !is_numeric($id)){
            die('Invalid blog ID');
        }
        $blog             = $this->_blogModel->getOne($id);
        $blogs            = $this->_blogModel->getAll();
        $blogs            = array_filter($blogs, function ($item) use ($id){
            return $item['id'] != $id;
        });
        $blogs_categories = $this->_blogModel->getCategoriesWithCount();
        include 'Views/Client/Blog/detail.php';
    }
}
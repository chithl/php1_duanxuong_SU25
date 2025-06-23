<?php

require_once 'Models/BlogCategory.php';

/**
 * Class BlogCategoryController
 *
 * Lớp BlogCategoryController quản lý các chức năng CRUD cho danh mục blog trong phần quản trị.
 */
class BlogCategoryController{

    /**
     * @var BlogCategory $_blogCategoryModel Đối tượng model BlogCategory để thao tác với dữ liệu
     *      danh mục blog
     */
    private $_blogCategoryModel;

    /**
     * BlogCategoryController constructor.
     * Khởi tạo đối tượng BlogCategory model.
     */
    public function __construct(){
        $this->_blogCategoryModel = new BlogCategory();
    }

    /**
     * Hiển thị danh sách các danh mục blog.
     *
     * Lấy tất cả danh mục blog và nạp giao diện danh sách cho người dùng.
     */
    public function index(){
        $result = $this->_blogCategoryModel->getAll();
        // hiển thị danh sách danh mục cho người dùng
        include 'Views/Admin/BlogCategory/index.php';
    }

    /**
     * Hiển thị form sửa danh mục blog.
     *
     * Kiểm tra id, lấy thông tin danh mục theo id và nạp giao diện form sửa.
     */
    public function edit(){
        // bắt lỗi id phải là số nguyên dương
        $id = $_GET['id'] ?? '';

        if ($id == ''){
            header('location: ?page=blog-category&action=index');
            exit;
        }

        $result = $this->_blogCategoryModel->getOne($id);
        // nếu ko có dữ liệu
        if (!$result){
            header('location: ?page=blog-category&action=index');
            exit;
        }

        // nếu tìm thấy
        // hiển thị giao diện form sửa
        include 'Views/Admin/BlogCategory/edit.php';
    }

    /**
     * Thực hiện cập nhật danh mục blog.
     *
     * Lấy dữ liệu từ form, kiểm tra hợp lệ và cập nhật vào cơ sở dữ liệu.
     * Chuyển hướng về trang danh sách hoặc trang sửa tuỳ theo kết quả.
     */
    public function update(){
        //    lấy dữ liệu ngừoi dùng nhập
        // kiểm tra trống
        // kiểm tra trùng tên => ngoại trừ tên hiện tại của id đang sửa

        $id     = $_POST['id'] ?? '';
        $name   = $_POST['name'] ?? '';
        $status = $_POST['status'] ?? '';

        // truyền dữ liệu qua model
        $data = [
            'id'     => $id,
            'name'   => $name,
            'status' => $status
        ];

        // model trả về kết quả
        $result = $this->_blogCategoryModel->update($id, $data);

        // nếu thành công => chuyển sang trang danh sách và thông báo
        if ($result){
            header('location: ?page=blog-category');
        }
        else{
            header('location: ?page=blog-category&action=edit&id=' . $id);
        }
        // nếu thất bại thì chuyển sang trang edit

        // kiểm tra kết quả cập nhật thành công / thất bại
    }

    /**
     * Hiển thị form thêm mới danh mục blog.
     *
     * Nạp giao diện trang thêm danh mục blog.
     */
    public function create(){
        // hiển thị giao diện trang thêm danh mục
        include 'Views/Admin/BlogCategory/create.php';
    }

    /**
     * Thực hiện thêm mới danh mục blog vào cơ sở dữ liệu.
     *
     * Kiểm tra dữ liệu đầu vào, xử lý lỗi và thêm mới vào cơ sở dữ liệu.
     * Chuyển hướng về trang danh sách hoặc trang thêm tuỳ theo kết quả.
     */
    public function store(){
        // bắt đầu kiểm tra, bắt lỗi client và admin
        // kiểm tra có $_POST create không ?

        if (!isset($_POST['create'])){
            header('location: ?page=blog-category&action=index');
            exit;
        }

        // kiểm tra các trường dữ liệu không được trống
        // $name = isset($_POST['name']) ? $_POST['name'] : '';
        $name   = $_POST['name'] ?? '';
        $status = $_POST['status'] ?? '';

        // bắt trùng
        // getByName($name) nếu trả mảng rỗng => insert
        // nếu ko báo lỗi trùng name

        // lưu session lỗi
        $error = FALSE;
        if ($name == ''){
            // echo 'Chưa nhập';
            $error_name_message = '';
            $error_name_value   = '';
            $error              = TRUE;
        }

        if ($error){
            header('location: ?page=blog-category&action=create');
            exit;
        }
        // kết thúc kiểm tra

        // thêm vào cơ sở dữ liệu
        // dữ liệu để thêm: $name, $status

        $data = [
            'name'   => $name,
            'status' => $status
        ];
        // gọi model
        $result = $this->_blogCategoryModel->insert($data);

        // var_dump($result);
        if ($result){
            // Lưu session thêm thành công
            // Chuyển về trang danh sách
            header('location: ?page=blog-category&action=index');
            exit;
        }

        // Lưu session thêm thất bại
        header('location: ?page=blog-category&action=create');


        // Chuyển về trang danh sách danh mục
    }

    /**
     * Thực hiện xoá danh mục blog.
     *
     * Kiểm tra id, xoá danh mục theo id và chuyển hướng về trang danh sách.
     */
    public function delete(){
        $id = $_GET['id'] ?? '';

        if ($id == ''){
            header('location: ?page=blog-category&action=index');
            exit;
        }

        $result = $this->_blogCategoryModel->delete($id);

        if ($result){
            // thành công

        }
        else{
            // thất bại
        }
        header('location: ?page=blog-category&action=index');
    }
}
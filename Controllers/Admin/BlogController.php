<?php

require_once 'Models/Blog.php';

/**
 * Class BlogController
 *
 * Lớp BlogController quản lý các chức năng CRUD cho blog trong phần quản trị.
 */
class BlogController{

    /**
     * @var Blog $_blogModel Đối tượng model Blog để thao tác với dữ liệu blog
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
     * Hiển thị danh sách các blog.
     *
     * Lấy tất cả blog hoặc theo trạng thái và nạp giao diện danh sách cho người dùng.
     */
    public function index(){
        $status = $_GET['status'] ?? '';

        if ($status === ''){
            // nếu status null thì gọi getAll
            $result = $this->_blogModel->getAll();
        }
        else{
            // nếu không thì gọi getAllByStatus
            $result = $this->_blogModel->getAllByStatus($status);
        }
        // hiển thị danh sách danh mục cho người dùng
        include 'Views/Admin/Blog/index.php';
    }

    /**
     * Hiển thị form sửa blog.
     *
     * Kiểm tra id, lấy thông tin blog theo id và nạp giao diện form sửa.
     */
    public function edit(){
        // bắt lỗi id phải là số nguyên dương
        $id = $_GET['id'] ?? '';

        if ($id == ''){
            header('location: ?page=blog&action=index');
            exit;
        }

        $result = $this->_blogModel->getOne($id);
        // nếu ko có dữ liệu
        if (!$result){
            header('location: ?page=blog&action=index');
            exit;
        }

        // nếu tìm thấy
        // hiển thị giao diện form sửa
        include 'Views/Admin/Blog/edit.php';
    }

    /**
     * Thực hiện cập nhật blog.
     *
     * Lấy dữ liệu từ form, kiểm tra hợp lệ và cập nhật vào cơ sở dữ liệu.
     * Chuyển hướng về trang danh sách hoặc trang sửa tuỳ theo kết quả.
     */
    public function update(){
        // lấy dữ liệu ngừoi dùng nhập
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
        $result = $this->_blogModel->update($id, $data);

        // var_dump($result);
        // nếu thành công => chuyển sang trang danh sách và thông báo
        if ($result){
            header('location: ?page=blog');
        }
        else{
            header('location: ?page=blog&action=edit&id=' . $id);
        }
        // nếu thất bại thì chuyển sang trang edit

        // kiểm tra kết quả cập nhật thành công / thất bại
    }

    /**
     * Hiển thị form thêm mới blog.
     *
     * Nạp giao diện trang thêm blog.
     */
    public function create(){
        // hiển thị giao diện trang thêm danh mục
        include 'Views/Admin/Blog/create.php';
    }

    /**
     * Thực hiện thêm mới blog vào cơ sở dữ liệu.
     *
     * Kiểm tra dữ liệu đầu vào, xử lý lỗi và thêm mới vào cơ sở dữ liệu.
     * Chuyển hướng về trang danh sách hoặc trang thêm tuỳ theo kết quả.
     */
    public function store(){
        // bắt đầu kiểm tra, bắt lỗi client và admin
        // kiểm tra có $_POST create không ?

        if (!isset($_POST['create'])){
            header('location: ?page=blog&action=index');
            exit;
        }

        // kiểm tra các trường dữ liệu không được trống
        // $name = isset($_POST['name']) ? $_POST['name'] : '';
        $name   = $_POST['name'] ?? '';
        $status = $_POST['status'] ?? '';

        $error = FALSE;

        if ($error){
            header('location: ?page=blog&action=create');
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
        $result = $this->_blogModel->insert($data);

        // var_dump($result);
        if ($result){
            // Lưu session thêm thành công
            // Chuyển về trang danh sách
            header('location: ?page=blog&action=index');
            exit;
        }

        // Lưu session thêm thất bại
        header('location: ?page=blog&action=create');

        // Chuyển về trang danh sách danh mục
    }

    /**
     * Thực hiện xoá blog.
     *
     * Kiểm tra id, xoá blog theo id và chuyển hướng về trang danh sách.
     */
    public function delete(){
        $id = $_GET['id'] ?? '';

        if ($id == ''){
            header('location: ?page=product&action=index');
            exit;
        }

        $result = $this->_blogModel->delete($id);

        if ($result){
            // thành công

        }
        else{
            // thất bại
        }
        header('location: ?page=blog&action=index');
    }
}
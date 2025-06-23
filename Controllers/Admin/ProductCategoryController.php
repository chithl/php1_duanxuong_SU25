<?php

require_once 'Models/ProductCategory.php';

/**
 * Class ProductCategoryController
 *
 * Lớp ProductCategoryController quản lý các chức năng CRUD cho danh mục sản phẩm trong phần quản
 * trị.
 */
class ProductCategoryController{

    /**
     * @var ProductCategory $_productCategoryModel Đối tượng model ProductCategory để thao tác với
     *      dữ liệu danh mục sản phẩm
     */
    private $_productCategoryModel;

    /**
     * ProductCategoryController constructor.
     * Khởi tạo đối tượng ProductCategory model.
     */
    public function __construct(){
        $this->_productCategoryModel = new ProductCategory();
    }

    /**
     * Hiển thị danh sách các danh mục sản phẩm.
     *
     * Lấy tất cả danh mục sản phẩm hoặc theo trạng thái và nạp giao diện danh sách cho người dùng.
     */
    public function index(){
        $status = $_GET['status'] ?? '';

        if ($status === ''){
            // nếu status null thì gọi getAll
            $result = $this->_productCategoryModel->getAll();
        }
        else{
            // nếu không thì gọi getAllByStatus
            $result = $this->_productCategoryModel->getAllByStatus($status);
        }
        // hiển thị danh sách danh mục cho người dùng
        include 'Views/Admin/ProductCategory/index.php';
    }

    /**
     * Hiển thị form sửa danh mục sản phẩm.
     *
     * Kiểm tra id, lấy thông tin danh mục theo id và nạp giao diện form sửa.
     */
    public function edit(){
        // bắt lỗi id phải là số nguyên dương
        $id = $_GET['id'] ?? '';

        if ($id == ''){
            header('location: ?page=product-category&action=index');
            exit;
        }

        $result = $this->_productCategoryModel->getOne($id);
        // nếu ko có dữ liệu
        if (!$result){
            header('location: ?page=product-category&action=index');
            exit;
        }

        // nếu tìm thấy
        // hiển thị giao diện form sửa
        include 'Views/Admin/ProductCategory/edit.php';
    }

    /**
     * Thực hiện cập nhật danh mục sản phẩm.
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
        $result = $this->_productCategoryModel->update($id, $data);

        // var_dump($result);
        // nếu thành công => chuyển sang trang danh sách và thông báo
        if ($result){
            header('location: ?page=product-category');
        }
        else{
            header('location: ?page=product-category&action=edit&id=' . $id);
        }
        // nếu thất bại thì chuyển sang trang edit

        // kiểm tra kết quả cập nhật thành công / thất bại
    }

    /**
     * Hiển thị form thêm mới danh mục sản phẩm.
     *
     * Nạp giao diện trang thêm danh mục sản phẩm.
     */
    public function create(){
        // hiển thị giao diện trang thêm danh mục
        include 'Views/Admin/ProductCategory/create.php';
    }

    /**
     * Thực hiện thêm mới danh mục sản phẩm vào cơ sở dữ liệu.
     *
     * Kiểm tra dữ liệu đầu vào, xử lý lỗi và thêm mới vào cơ sở dữ liệu.
     * Chuyển hướng về trang danh sách hoặc trang thêm tuỳ theo kết quả.
     */
    public function store(){
        // bắt đầu kiểm tra, bắt lỗi client và admin
        // kiểm tra có $_POST create không ?

        if (!isset($_POST['create'])){
            header('location: ?page=product-category&action=index');
            exit;
        }

        // kiểm tra các trường dữ liệu không được trống
        // $name = isset($_POST['name']) ? $_POST['name'] : '';
        $name   = $_POST['name'] ?? '';
        $status = $_POST['status'] ?? '';

        $error = FALSE;

        if ($error){
            header('location: ?page=product-category&action=create');
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
        $result = $this->_productCategoryModel->insert($data);

        // var_dump($result);
        if ($result){
            // Lưu session thêm thành công
            // Chuyển về trang danh sách
            header('location: ?page=product-category&action=index');
            exit;
        }

        // Lưu session thêm thất bại
        header('location: ?page=product-category&action=create');

        // Chuyển về trang danh sách danh mục
    }

    /**
     * Thực hiện xoá danh mục sản phẩm.
     *
     * Kiểm tra id, xoá danh mục theo id và chuyển hướng về trang danh sách.
     */
    public function delete(){
        $id = $_GET['id'] ?? '';

        if ($id == ''){
            header('location: ?page=product-category&action=index');
            exit;
        }

        $result = $this->_productCategoryModel->delete($id);

        if ($result){
            // thành công

        }
        else{
            // thất bại
        }
        header('location: ?page=product-category&action=index');
    }
}
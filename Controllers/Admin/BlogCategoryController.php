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
        $id = $_POST['id'] ?? '';
        $name = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');

        $errors = [];
        if (empty($name)){
            $errors['name'] = "Tên không được để trống.";
            $_SESSION['messageError'] = "Có lỗi xảy ra, vui lòng nhập lại dữ liệu.";
        }

        if (empty($description)) {
            $errors['description'] = "Mô tả không được để trống.";
            $_SESSION['messageError'] = "Có lỗi xảy ra, vui lòng nhập lại dữ liệu.";
        }


        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = ['description' => $description, 'name' => $name];
            // echo "lỗi ở đây";
            header('Location: admin.php?page=blog-category&action=edit&id=' . $id);
            exit;
        }

        $data = [
            "id" => $id,
            "name" => $name,
            "description" => $description,
        ];

        $result = $this->_blogCategoryModel->update($id, $data);

        if ($result){
            $_SESSION['messageSuccess'] = "Cập nhật thành công";
            header('location: admin.php?page=blog-category&action=index');
        } else {
            $_SESSION['messageError'] = "Cập nhật thất bại";
            header('location: ?page=blog-category&action=edit&id=' . $id);
        }
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

        if (isset($_POST["create"])) {
            // echo "Có";
            $name = htmlspecialchars(trim($_POST['name'] ?? ''));
            $description = htmlspecialchars(trim($_POST['description'] ?? ''));

            $errors = [];

            if (empty($name)) {
                $errors['name'] = "Tên không được để trống.";
                $_SESSION['messageError'] = "Có lỗi xảy ra, vui lòng nhập lại dữ liệu.";
            }else {
                $nameTemp = $this->_blogCategoryModel->getByName($name);
                if ($nameTemp) {
                    $errors['name'] = 'Tên không được trùng.';
                }
                $_SESSION['messageError'] = "Có lỗi xảy ra, vui lòng nhập lại dữ liệu.";
            }

            if (empty($description)) {
                $errors['description'] = "Mô tả không được để trống.";
                $_SESSION['messageError'] = "Có lỗi xảy ra, vui lòng nhập lại dữ liệu.";
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old'] = ['description' => $description, 'name' => $name];
                // echo "lỗi ở đây";
                header('Location: admin.php?page=blog-category&action=create');
                exit;
            }

            $data = [
                "name" => $name,
                "description" => $description,
            ];

            $result = $this->_blogCategoryModel->insert($data);
            var_dump($result);
            if ($result) {
                $messageSuccess = "Thêm thành công";
                $_SESSION["messageSuccess"] = $messageSuccess;
                header("location: admin.php?page=blog-category&action=index");
            } else {
                $messageError = "Thêm thất bại do lỗi hệ thống";
                $_SESSION["messageError"] = $messageError;
                header("location: admin.php?page=blog-category&action=create");
            }
        } else {
            echo "Ko có post";
        }
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
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
        $categories = $this->_blogModel->getCategories();
        $result = $this->_blogModel->getOne($id);

        // nếu ko có dữ liệu
        if (!$result){
            header('location: ?page=blog&action=index');
            exit;
        }

        // nếu tìm thấy
        // hiển thị giao diện form sửa
        include 'Views/Admin/Blog/edit.php';
        unset($_SESSION['errors']);
    }

    /**
     * Thực hiện cập nhật blog.
     *
     * Lấy dữ liệu từ form, kiểm tra hợp lệ và cập nhật vào cơ sở dữ liệu.
     * Chuyển hướng về trang danh sách hoặc trang sửa tuỳ theo kết quả.
     */
    public function update(){
        $id = $_POST['id'] ?? '';
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $blog_category_id = trim($_POST['blog_category_id'] ?? '');

        $errors = [];
        if (empty($title)) {
            $errors['title'] = "Tiêu đề không được để trống.";
//            $_SESSION['messageError'] = "Xảy ra lỗi, vui lòng kiểm tra lại dữ liệu.";
        }
        if (empty($content)) {
            $errors['content'] = "Nội dung không được để trống.";
//            $_SESSION['messageError'] = "Xảy ra lỗi, vui lòng kiểm tra lại dữ liệu.";
        }
        if ($blog_category_id == '') {
            $errors['blog_category_id'] = "Danh mục không được để trống.";
        }

        $currentBlog = $this->_blogModel->getOne($id);
        $image = $currentBlog['image'] ?? '';

        if (!empty($_FILES["image"]["name"])) {
            $target_dir    = "Uploads/";
            $file_name     = basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $newName       = "Blog" . date("Ymd_His") . "." . $imageFileType;
            $target_file   = $target_dir . '/' . $newName;

            $allowTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            if (!in_array($imageFileType, $allowTypes)){
                $errors["image"] = "Chỉ chấp nhận file ảnh (jpg, jpeg, png, gif, webp)";
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                    $image = $newName;
                } else {
                    $errors["image"] = "Upload ảnh thất bại, vui lòng thử lại";
                }
            }
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = ['content' => $content, 'title' => $title, 'blog_category_id' => $blog_category_id];
            // echo "lỗi ở đây";
            header('Location: admin.php?page=blog&action=edit&id=' . $id);
            exit;
        }

        $data = [
            "id" => $id,
            "title" => $title,
            "content" => $content,
            "blog_category_id" => $blog_category_id,
            "image" => $image
        ];

        $result = $this->_blogModel->update($id, $data);

        if ($result){
            $_SESSION['messageSuccess'] = "Cập nhật thành công";
            header('location: admin.php?page=blog&action=index');
        } else {
            $_SESSION['messageError'] = "Cập nhật thất bại";
            header('location: ?page=blog&action=edit&id=' . $id);
        }
    }

    /**
     * Hiển thị form thêm mới blog.
     *
     * Nạp giao diện trang thêm blog.
     */
    public function create(){
        // hiển thị giao diện trang thêm danh mục
        $categories = $this->_blogModel->getCategories();
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

        if (isset($_POST["create"])) {
            // echo "Có";
            $title = htmlspecialchars(trim($_POST['title'] ?? ''));
            $content = htmlspecialchars(trim($_POST['content'] ?? ''));
            $blog_category_id = htmlspecialchars(trim($_POST['blog_category_id'] ?? ''));

            $errors = [];

            if (empty($title)) {
                $errors['title'] = "Tiêu đề không được để trống.";
                $_SESSION['messageError'] = "Xảy ra lỗi, vui lòng kiểm tra lại dữ liệu.";
            }

            if (empty($content)) {
                $errors['content'] = "Nội dung không được để trống.";
                $_SESSION['messageError'] = "Xảy ra lỗi, vui lòng kiểm tra lại dữ liệu.";
            }
            if (empty($blog_category_id)) {
                $errors['blog_category_id'] = "Danh mục không được để trống.";
                $_SESSION['messageError'] = "Xảy ra lỗi, vui lòng kiểm tra lại dữ liệu.";
            }

            if ($_FILES["image"]["name"] == "") {
                $errors["image"] = "Vui lòng thêm ảnh";
            } else {
                $target_dir = "Uploads/";
                $file_name = basename($_FILES["image"]["name"]);
                $imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                $newName = date("Ymd_His") . "." . $imageFileType;
                $target_file = $target_dir . $newName;

                $allowTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                if (!in_array($imageFileType, $allowTypes)) {
                    $errors["image"] = "Chỉ chấp nhận file ảnh (jpg, jpeg, png, gif, webp)";
                } else {
                    $newName = "Blog" . date("Ymd_His") . "." . $imageFileType;
                    $target_file = $target_dir . '/' . $newName;

                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        $image = $newName;
                    } else {
                        $errors["image"] = "Upload ảnh thất bại, vui lòng thử lại";
                    }
                }
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old'] = ['content' => $content, 'title' => $title, 'blog_category_id' => $blog_category_id];
                // echo "lỗi ở đây";
                header('Location: admin.php?page=blog&action=create');
                exit;
            }

            $data = [
                "title" => $title,
                "content" => $content,
                "blog_category_id" => $blog_category_id,
                "image" => $image
            ];

            $result = $this->_blogModel->insert($data);
            var_dump($result);
            if ($result) {
                $messageSuccess = "Thêm thành công";
                $_SESSION["messageSuccess"] = $messageSuccess;
                header("location: admin.php?page=blog&action=index");
            } else {
                $messageError = "Thêm thất bại do lỗi hệ thống";
                $_SESSION["messageError"] = $messageError;
                header("location: admin.php?page=blog&action=create");
            }
        } else {
            echo "Ko có post";
        }
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
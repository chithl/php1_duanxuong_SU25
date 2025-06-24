<?php

require_once 'Models/Product.php';

/**
 * Class ProductController
 *
 * Lớp ProductController quản lý các chức năng CRUD cho sản phẩm trong phần quản trị.
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
     * Hiển thị danh sách các sản phẩm.
     *
     * Lấy tất cả sản phẩm hoặc theo trạng thái và nạp giao diện danh sách cho người dùng.
     */
    public function index(){
        $status = $_GET['status'] ?? '';

        if ($status === ''){
            // nếu status null thì gọi getAll
            $result = $this->_productModel->getAll();
        }
        else{
            // nếu không thì gọi getAllByStatus
            $result = $this->_productModel->getAllByStatus($status);
        }
        // hiển thị danh sách danh mục cho người dùng
        include 'Views/Admin/Product/index.php';
    }

    /**
     * Hiển thị form sửa sản phẩm.
     *
     * Kiểm tra id, lấy thông tin sản phẩm theo id và nạp giao diện form sửa.
     */
    public function edit(){
        // bắt lỗi id phải là số nguyên dương
        $id = $_GET['id'] ?? '';

        if ($id == ''){
            header('location: ?page=product&action=index');
            exit;
        }

        $result = $this->_productModel->getOne($id);
        // nếu ko có dữ liệu
        if (!$result){
            header('location: ?page=product&action=index');
            exit;
        }

        // nếu tìm thấy
        // hiển thị giao diện form sửa
        include 'Views/Admin/ProductCategory/edit.php';
    }

    /**
     * Thực hiện cập nhật sản phẩm.
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
        $result = $this->_productModel->update($id, $data);

        // var_dump($result);
        // nếu thành công => chuyển sang trang danh sách và thông báo
        if ($result){
            header('location: ?page=product');
        }
        else{
            header('location: ?page=product&action=edit&id=' . $id);
        }
        // nếu thất bại thì chuyển sang trang edit

        // kiểm tra kết quả cập nhật thành công / thất bại
    }

    /**
     * Hiển thị form thêm mới sản phẩm.
     *
     * Nạp giao diện trang thêm sản phẩm.
     */
    public function create(){
        // hiển thị giao diện trang thêm danh mục
        $categories = $this->_productModel->getCategories();
        include 'Views/Admin/Product/create.php';
    }

    /**
     * Thực hiện thêm mới sản phẩm vào cơ sở dữ liệu.
     *
     * Kiểm tra dữ liệu đầu vào, xử lý lỗi và thêm mới vào cơ sở dữ liệu.
     * Chuyển hướng về trang danh sách hoặc trang thêm tuỳ theo kết quả.
     */
    public function store()
    {
        if (isset($_POST["create"])):
            $category_id = $_POST['category_id'] ?? '';
            if ($_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
                $image_error = "Vui lòng chọn file để upload";
                $errors['image_error'] = $image_error;
            } else {
                $target_dir = "Uploads/";

                // Lấy kiểu file
                $imageFileType = strtolower(pathinfo(basename($_FILES['image']['name']), PATHINFO_EXTENSION));
                if ($imageFileType != 'webp' && $imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png') {
                    $errors['image_error'] = 'Sai định dạng file';
                }
                // Đổi tên
                $new_name = date('ymdhs') . '.' . $imageFileType;
                // Vị trí chuyển ảnh vào
                $target_file = $target_dir . $new_name;
            }
            if (isset($_POST["name"]) && isset($_POST["price"])) {
                $category_id = trim(htmlspecialchars($_POST['category_id']));
                $name = trim(htmlspecialchars($_POST["name"]));
                $description = trim(htmlspecialchars($_POST["description"]));
                $price = trim(htmlspecialchars($_POST["price"]));
                $featured =trim(htmlspecialchars($_POST['featured'])) ;
                $discount_price = trim(htmlspecialchars($_POST["discount_price"])) ?? 0;
                $status = trim(htmlspecialchars($_POST["status"]));
                $image = (isset($new_name)) ? $new_name : '';

                if (empty($category_id)) {
                    $category_id_error = "Vui lòng chọn mã loại sản phẩm";
                    $errors['category_id_error'] = $category_id_error;
                }
                if (empty($name)) {
                    $name_error = "Vui lòng nhập tên sản phẩm";
                    $errors['name_error'] = $name_error;
                }
                if (empty($price)) {
                    $price_error = "Vui lòng nhập giá sản phẩm";
                    $errors['price_error'] = $price_error;
                } elseif ($price < 0) {
                    $price_error = "Giá sản phẩm phải lớn hơn 0";
                    $errors['price_error'] = $price_error;
                } elseif (!is_numeric($price)) {
                    $price_error = "Giá sản phẩm phải là số";
                    $errors['price_error'] = $price_error;
                }
                if (empty($featured)) {
                    $featured_error = "Vui lòng nhập đặc trưng sản phẩm";
                    $errors['featured_error'] = $featured_error;
                }
                if (empty($quantity)) {
                    $quantity_error = "Vui lòng nhập số lượng sản phẩm";
                    $errors['quantity_error'] = $quantity_error;
                } elseif ($quantity < 0) {
                    $quantity_error = "Số lượng sản phẩm phải lớn hơn 0";
                    $errors['quantity_error'] = $quantity_error;
                } elseif (!is_numeric($quantity)) {
                    $quantity_error = "Số lượng sản phẩm phải là số";
                    $errors['quantity_error'] = $quantity_error;
                }
                if(empty($description)){
                    $description_error = "Vui lòng nhập mô tả sản phẩm";
                    $errors['description_error'] = $description_error;
                }
                if (empty($status) && $status != 0) {
                    $status_error = "Vui lòng chọn trạng thái";
                    $errors['status_error'] = $status_error;
                }
                $checkName = $this->_productModel->checkName($name);
                if ($checkName) {
                    $name_error = "Tên sản phẩm đã tồn tại";
                    $errors['name_error'] = $name_error;
                }
                if (isset($errors)) {
                    $errors['category_id_old'] = $category_id;
                    $errors['name_old'] = $name;
                    $errors['price_old'] = $price;
                    $errors['quantity_old'] = $quantity;
                    $errors['description_old'] = $description;
                    $errors['featured_old'] = $featured;
                    $errors['status_old'] = $status;
                    $errors['image_old'] = $image;
                    $mess_error = "Đã có lỗi xảy ra. Vui lòng kiểm tra lại thông tin";
                    $errors['message'] = $mess_error;
                    $_SESSION['errors'] = $errors;
                    header('location: ?page=product&action=create');
                    exit;
                }
            }
        endif;

        $result = $this->_productModel->insert($data);
        if ($result) {
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            $success = 'Thêm thành công';
            $_SESSION['success'] = $success;
            header('location: ?page=product&action=index');
            exit;
        } else {
            $errors['message'] = 'Thêm thất bại. Có lỗi xảy ra khi thao tác với cơ sở dữ liệu';
            $_SESSION['errors'] = $errors;
            var_dump($_SESSION['errors']);
            header('location: ?page=product&action=create');
            exit;
        }

    }

    /**
     * Thực hiện xoá sản phẩm.
     *
     * Kiểm tra id, xoá sản phẩm theo id và chuyển hướng về trang danh sách.
     */
    public function delete(){
        $id = $_GET['id'] ?? '';

        if ($id == ''){
            header('location: ?page=product&action=index');
            exit;
        }

        $result = $this->_productModel->delete($id);

        if ($result){
            // thành công

        }
        else{
            // thất bại
        }
        header('location: ?page=product&action=index');
    }
}
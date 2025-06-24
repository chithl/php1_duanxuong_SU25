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
        $status  = $_GET['status'] ?? '';
        $keyword = $_GET['keyword'] ?? '';
        if ($status === ''){
            if ($keyword != ''){
                $result = $this->_productModel->getByName($keyword);
            }else{
                $result = $this->_productModel->getAll();
            }
        }elseif (!empty($keyword) && $status !== ''){
            $result = $this->_productModel->getByNameAndStatus($keyword, $status);
        }else{
            $result = $this->_productModel->getAllByStatus($status);
        }
        // Lấy dữ liệu từ model trả về
        include 'Views/Admin/Product/index.php';
    }

    public function search(){
        $keyword = $_GET['keyword'] ?? '';
        $status  = $_GET['status'] ?? '';
        if ($status === ''){
            if ($keyword != ''){
                $products = $this->_productModel->getByName($keyword);
            }else{
                $products = $this->_productModel->getAll();
            }
        }elseif (!empty($keyword) && $status !== ''){
            $products = $this->_productModel->getByNameAndStatus($keyword, $status);
        }else{
            $products = $this->_productModel->getAllByStatus($status);
        }
        include 'Views/Admin/Product/search.php';
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
        $categories = $this->_productModel->getCategories();
        $result     = $this->_productModel->getOne($id);
        // nếu ko có dữ liệu
        if (!$result){
            header('location: ?page=product&action=index');
            exit;
        }

        // nếu tìm thấy
        // hiển thị giao diện form sửa
        include 'Views/Admin/Product/edit.php';
    }

    /**
     * Thực hiện cập nhật sản phẩm.
     *
     * Lấy dữ liệu từ form, kiểm tra hợp lệ và cập nhật vào cơ sở dữ liệu.
     * Chuyển hướng về trang danh sách hoặc trang sửa tuỳ theo kết quả.
     */
    public function update(){
        if (isset($_POST["update"])):
            $category_id = $_POST['category_id'] ?? '';
            $id          = trim(htmlspecialchars($_POST['id']));
            $product     = $this->_productModel->getOne($id);
            if ($_FILES['image']['error'] === UPLOAD_ERR_NO_FILE){
                $new_name = $product['image'];
            }else{

                $target_dir = "Uploads/Products/";

                // Lấy kiểu file
                $imageFileType = strtolower(pathinfo(basename($_FILES['image']['name']),
                    PATHINFO_EXTENSION));
                // Đổi tên
                $new_name = date('ymdhs') . '.' . $imageFileType;
                // Vị trí chuyển ảnh vào
                $target_file = $target_dir . $new_name;
            }
            if (isset($_POST["name"]) && isset($_POST["price"])){
                $category_id    = trim(htmlspecialchars($_POST['category_id']));
                $name           = trim(htmlspecialchars($_POST["name"]));
                $description    = trim(htmlspecialchars($_POST["description"]));
                $price          = trim(htmlspecialchars($_POST["price"]));
                $is_featured    = trim(htmlspecialchars($_POST['featured']));
                $weight         = trim(htmlspecialchars($_POST["weight"]));
                $discount_price = trim(htmlspecialchars($_POST["discount_price"]));
                $view           = trim(htmlspecialchars($_POST["view"])) ?? 0;
                $stock          = trim(htmlspecialchars($_POST["stock"]));
                $image          = (isset($new_name)) ? $new_name : '';
                $status         = trim(htmlspecialchars($_POST["status"]));

                if (empty($category_id)){
                    $category_id_error           = "Vui lòng chọn mã loại sản phẩm";
                    $errors['category_id_error'] = $category_id_error;
                }
                if (empty($name)){
                    $name_error           = "Vui lòng nhập tên sản phẩm";
                    $errors['name_error'] = $name_error;
                }
                if (empty($price)){
                    $price_error           = "Vui lòng nhập giá sản phẩm";
                    $errors['price_error'] = $price_error;
                }elseif ($price < 0){
                    $price_error           = "Giá sản phẩm phải lớn hơn 0";
                    $errors['price_error'] = $price_error;
                }elseif (!is_numeric($price)){
                    $price_error           = "Giá sản phẩm phải là số";
                    $errors['price_error'] = $price_error;
                }
                if (empty($weight)){
                    $weight_error           = "Vui lòng nhập trọng lượng sản phẩm";
                    $errors['weight_error'] = $weight_error;
                }elseif ($weight < 0){
                    $weight_error           = "Trọng lượng sản phẩm phải lớn hơn 0";
                    $errors['weight_error'] = $weight_error;
                }elseif (!is_numeric($weight)){
                    $weight_error           = "Trọng lượng sản phẩm phải là số";
                    $errors['weight_error'] = $weight_error;
                }
                if (empty($is_featured) && $is_featured != '0' && $is_featured != '1'){
                    $featured_error           = "Vui lòng nhập đặc trưng sản phẩm";
                    $errors['featured_error'] = $featured_error;
                }
                if (empty($stock)){
                    $stock_error           = "Vui lòng nhập số lượng sản phẩm";
                    $errors['stock_error'] = $stock_error;
                }elseif ($stock < 0){
                    $stock_error           = "Số lượng sản phẩm phải lớn hơn 0";
                    $errors['stock_error'] = $stock_error;
                }elseif (!is_numeric($stock)){
                    $stock_error           = "Số lượng sản phẩm phải là số";
                    $errors['stock_error'] = $stock_error;
                }
                if ($stock != 0 && $status == 'out_of_stock'){
                    $status_error           = "Không thể cập nhật trạng thái sản phẩm là hết hàng khi số lượng sản phẩm lớn hơn 0";
                    $errors['status_error'] = $status_error;
                }elseif ($stock == 0 && $status != 'out_of_stock'){
                    $status_error           = "Không thể cập nhật trạng thái sản phẩm là còn hàng khi số lượng sản phẩm bằng 0";
                    $errors['status_error'] = $status_error;
                }
                if (empty($description)){
                    $description_error           = "Vui lòng nhập mô tả sản phẩm";
                    $errors['description_error'] = $description_error;
                }
                if (empty($discount_price)){
                    $discount_price = 0;
                }elseif ($discount_price < 0){
                    $discount_price_error           = "Giá khuyến mãi phải lớn hơn 0";
                    $errors['discount_price_error'] = $discount_price_error;
                }elseif (!is_numeric($discount_price)){
                    $discount_price_error           = "Giá khuyến mãi phải là số";
                    $errors['discount_price_error'] = $discount_price_error;
                }elseif ($discount_price > $price){
                    $discount_price_error           = "Giá khuyến mãi không được lớn hơn giá sản phẩm";
                    $errors['discount_price_error'] = $discount_price_error;
                }
                if (empty($view)){
                    $view = 0; // nếu không có view thì mặc định là 0
                }elseif (!is_numeric($view)){
                    $view_error           = "Lượt xem phải là số";
                    $errors['view_error'] = $view_error;
                }elseif ($view < 0){
                    $view_error           = "Lượt xem phải lớn hơn hoặc bằng 0";
                    $errors['view_error'] = $view_error;
                }

                $checkName = $this->_productModel->checkIdAndName($id, $name);
                if ($checkName){
                    $name_error           = "Tên sản phẩm đã tồn tại";
                    $errors['name_error'] = $name_error;
                }
                if (isset($errors)){
                    $errors['category_id_old'] = $category_id;
                    $errors['name_old']        = $name;
                    $errors['price_old']       = $price;
                    $errors['weight_old']      = $weight;
                    $errors['stock_old']       = $stock;
                    $errors['description_old'] = $description;
                    $errors['featured_old']    = $is_featured;
                    $errors['image_old']       = $image;
                    $mess_error                = "Đã có lỗi xảy ra. Vui lòng kiểm tra lại thông tin";
                    $errors['message']         = $mess_error;
                    $_SESSION['errors']        = $errors;
                    header('location: ?page=product&action=edit&id=' . $id);
                    exit;
                }
            }
        endif;
        $data   = [
            'id'                  => $id,
            'product_category_id' => $category_id,
            'name'                => $name,
            'description'         => $description,
            'price'               => $price,
            'weight'              => $weight,
            'discount_price'      => $discount_price,
            'stock'               => $stock,
            'image'               => $image,
            'is_featured'         => $is_featured,
            'status'              => $status
        ];
        $result = $this->_productModel->update($data);
        var_dump($result);
        if ($result){
            if ($image !== $product['image']){
                // nếu không có ảnh mới thì không cần xóa ảnh cũ
                $pathFile = 'Uploads/Products/' . $product['image'];
                if (file_exists($pathFile)){
                    unlink($pathFile);
                }
            }

            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            $success             = 'Sửa thành công';
            $_SESSION['success'] = $success;
            header('location: ?page=product&action=index');
            exit;
        }else{
            $errors['message']  = 'Sửa thất bại. Có lỗi xảy ra khi thao tác với cơ sở dữ liệu';
            $_SESSION['errors'] = $errors;
            var_dump($_SESSION['errors']);
            header('location: ?page=product&action=edit&id=' . $id);
            exit;
        }
    }        // truyền dữ liệu qua model


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
    public function store(){
        if (isset($_POST["create"])):
            $category_id = $_POST['category_id'] ?? '';
            if ($_FILES['image']['error'] === UPLOAD_ERR_NO_FILE){
                $image_error           = "Vui lòng chọn file để upload";
                $errors['image_error'] = $image_error;
            }else{
                $target_dir = "Uploads/Products/";

                // Lấy kiểu file
                $imageFileType = strtolower(pathinfo(basename($_FILES['image']['name']),
                    PATHINFO_EXTENSION));
                if ($imageFileType != 'webp' && $imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png'){
                    $errors['image_error'] = 'Sai định dạng file';
                }
                // Đổi tên
                $new_name = date('ymdhs') . '.' . $imageFileType;
                // Vị trí chuyển ảnh vào
                $target_file = $target_dir . $new_name;
            }
            if (isset($_POST["name"]) && isset($_POST["price"])){
                $category_id    = trim(htmlspecialchars($_POST['category_id']));
                $name           = trim(htmlspecialchars($_POST["name"]));
                $description    = trim(htmlspecialchars($_POST["description"]));
                $price          = trim(htmlspecialchars($_POST["price"]));
                $is_featured    = trim(htmlspecialchars($_POST['featured']));
                $weight         = trim(htmlspecialchars($_POST["weight"]));
                $discount_price = trim(htmlspecialchars($_POST["discount_price"]));
                $view           = trim(htmlspecialchars($_POST["view"])) ?? 0;
                $stock          = trim(htmlspecialchars($_POST["stock"]));
                $image          = (isset($new_name)) ? $new_name : '';

                if (empty($category_id)){
                    $category_id_error           = "Vui lòng chọn mã loại sản phẩm";
                    $errors['category_id_error'] = $category_id_error;
                }
                if (empty($name)){
                    $name_error           = "Vui lòng nhập tên sản phẩm";
                    $errors['name_error'] = $name_error;
                }
                if (empty($price)){
                    $price_error           = "Vui lòng nhập giá sản phẩm";
                    $errors['price_error'] = $price_error;
                }elseif ($price < 0){
                    $price_error           = "Giá sản phẩm phải lớn hơn 0";
                    $errors['price_error'] = $price_error;
                }elseif (!is_numeric($price)){
                    $price_error           = "Giá sản phẩm phải là số";
                    $errors['price_error'] = $price_error;
                }
                if (empty($weight)){
                    $weight_error           = "Vui lòng nhập trọng lượng sản phẩm";
                    $errors['weight_error'] = $weight_error;
                }elseif ($weight < 0){
                    $weight_error           = "Trọng lượng sản phẩm phải lớn hơn 0";
                    $errors['weight_error'] = $weight_error;
                }elseif (!is_numeric($weight)){
                    $weight_error           = "Trọng lượng sản phẩm phải là số";
                    $errors['weight_error'] = $weight_error;
                }
                if (empty($is_featured) && $is_featured != '0' && $is_featured != '1'){
                    $featured_error           = "Vui lòng nhập đặc trưng sản phẩm";
                    $errors['featured_error'] = $featured_error;
                }
                if (empty($stock)){
                    $stock_error           = "Vui lòng nhập số lượng sản phẩm";
                    $errors['stock_error'] = $stock_error;
                }elseif ($stock < 0){
                    $stock_error           = "Số lượng sản phẩm phải lớn hơn 0";
                    $errors['stock_error'] = $stock_error;
                }elseif (!is_numeric($stock)){
                    $stock_error           = "Số lượng sản phẩm phải là số";
                    $errors['stock_error'] = $stock_error;
                }
                if (empty($description)){
                    $description_error           = "Vui lòng nhập mô tả sản phẩm";
                    $errors['description_error'] = $description_error;
                }
                if (empty($discount_price)){
                    $discount_price = 0;
                }elseif ($discount_price < 0){
                    $discount_price_error           = "Giá khuyến mãi phải lớn hơn 0";
                    $errors['discount_price_error'] = $discount_price_error;
                }elseif (!is_numeric($discount_price)){
                    $discount_price_error           = "Giá khuyến mãi phải là số";
                    $errors['discount_price_error'] = $discount_price_error;
                }elseif ($discount_price > $price){
                    $discount_price_error           = "Giá khuyến mãi không được lớn hơn giá sản phẩm";
                    $errors['discount_price_error'] = $discount_price_error;
                }
                if (empty($view)){
                    $view = 0; // nếu không có view thì mặc định là 0
                }elseif (!is_numeric($view)){
                    $view_error           = "Lượt xem phải là số";
                    $errors['view_error'] = $view_error;
                }elseif ($view < 0){
                    $view_error           = "Lượt xem phải lớn hơn hoặc bằng 0";
                    $errors['view_error'] = $view_error;
                }

                $checkName = $this->_productModel->checkName($name);
                if ($checkName){
                    $name_error           = "Tên sản phẩm đã tồn tại";
                    $errors['name_error'] = $name_error;
                }
                if (isset($errors)){
                    $errors['category_id_old'] = $category_id;
                    $errors['name_old']        = $name;
                    $errors['price_old']       = $price;
                    $errors['weight_old']      = $weight;
                    $errors['stock_old']       = $stock;
                    $errors['description_old'] = $description;
                    $errors['featured_old']    = $is_featured;
                    $errors['image_old']       = $image;
                    $mess_error                = "Đã có lỗi xảy ra. Vui lòng kiểm tra lại thông tin";
                    $errors['message']         = $mess_error;
                    $_SESSION['errors']        = $errors;
                    header('location: ?page=product&action=create');
                    exit;
                }
            }
        endif;
        $data   = [
            'product_category_id' => $category_id,
            'name'                => $name,
            'description'         => $description,
            'price'               => $price,
            'weight'              => $weight,
            'discount_price'      => $discount_price,
            'view'                => $view,
            'stock'               => $stock,
            'image'               => $image,
            'is_featured'         => $is_featured
        ];
        $result = $this->_productModel->insert($data);
        if ($result){
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            $success             = 'Thêm thành công';
            $_SESSION['success'] = $success;
            header('location: ?page=product&action=index');
            exit;
        }else{
            $errors['message']  = 'Thêm thất bại. Có lỗi xảy ra khi thao tác với cơ sở dữ liệu';
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
            $_SESSION['success'] = 'Xoá thành công';
        }else{
            $_SESSION['errors'] = [
                'message' => 'Xoá thất bại. Có lỗi xảy ra khi thao tác với cơ sở dữ liệu'
            ];
            // thất bại
        }
        header('location: ?page=product&action=index');
    }
}
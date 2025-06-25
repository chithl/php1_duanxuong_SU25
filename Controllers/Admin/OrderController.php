<?php

require_once 'Models/Order.php';

/**
 * Class OrderController
 *
 * Lớp OrderController quản lý các chức năng CRUD cho đơn hàng trong phần quản trị.
 */
class OrderController{

    /**
     * @var Order $_orderModel Đối tượng model Order để thao tác với dữ liệu đơn hàng
     */
    private $_orderModel;

    /**
     * OrderController constructor.
     * Khởi tạo đối tượng Order model.
     */
    public function __construct(){
        $this->_orderModel = new Order();
    }

    /**
     * Hiển thị danh sách các đơn hàng.
     *
     * Lấy tất cả đơn hàng và nạp giao diện danh sách cho người dùng.
     */
    public function index(){
        $payment_status  = $_GET['payment_status'] ?? '';
        $keyword = $_GET['keyword'] ?? '';

        if ($payment_status === ''){
            $result = $this->_orderModel->getAll();
        }else{
            $result = $this->_orderModel->getAllByStatus($payment_status);
        }
        // hiển thị danh sách danh mục cho người dùng
        include 'Views/Admin/Order/index.php';
    }

    /**
     * Hiển thị form sửa đơn hàng.
     *
     * Kiểm tra id, lấy thông tin đơn hàng theo id và nạp giao diện form sửa.
     */
    public function edit(){
        // bắt lỗi id phải là số nguyên dương
        $id = $_GET['id'] ?? '';

        if ($id == ''){
            header('location: ?page=order&action=index');
            exit;
        }

        $result = $this->_orderModel->getOne($id);
        // nếu ko có dữ liệu
        if (!$result){
            header('location: ?page=order&action=index');
            exit;
        }

        // nếu tìm thấy
        // hiển thị giao diện form sửa
        include 'Views/Admin/Order/edit.php';
    }

    /**
     * Thực hiện cập nhật đơn hàng.
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
        $result = $this->_orderModel->update($id, $data);

        // nếu thành công => chuyển sang trang danh sách và thông báo
        if ($result){
            header('location: ?page=order');
        }else{
            header('location: ?page=order&action=edit&id=' . $id);
        }
        // nếu thất bại thì chuyển sang trang edit

        // kiểm tra kết quả cập nhật thành công / thất bại
    }

    /**
     * Hiển thị form thêm mới đơn hàng.
     *
     * Nạp giao diện trang thêm đơn hàng.
     */
    public function create(){
        // hiển thị giao diện trang thêm danh mục
        include 'Views/Admin/Order/create.php';
    }

    /**
     * Thực hiện thêm mới đơn hàng vào cơ sở dữ liệu.
     *
     * Kiểm tra dữ liệu đầu vào, xử lý lỗi và thêm mới vào cơ sở dữ liệu.
     * Chuyển hướng về trang danh sách hoặc trang thêm tuỳ theo kết quả.
     */
    public function store(){

    }

    /**
     * Thực hiện xoá đơn hàng.
     *
     * Kiểm tra id, xoá đơn hàng theo id và chuyển hướng về trang danh sách.
     */
    public function delete(){
        $id = $_GET['id'] ?? '';

        if ($id == ''){
            header('location: ?page=order&action=index');
            exit;
        }

        $result = $this->_orderModel->delete($id);

        if ($result){
            // thành công

        }else{
            // thất bại
        }
        header('location: ?page=order&action=index');
    }

    public function detail(){
        // hiển thị chi tiết đơn hàng
        $id = $_GET['id'] ?? '';

        if ($id == ''){
            header('location: ?page=order&action=index');
            exit;
        }

        $order        = $this->_orderModel->getOne($id);
        $orderDetails = $this->_orderModel->getOrderDetails($id);

        // nếu không có dữ liệu
        if (!$order){
            header('location: ?page=order&action=index');
            exit;
        }

        // nếu tìm thấy
        include 'Views/Admin/Order/orderDetail.php';
    }

    public function updateStatus(){
        $id              = $_POST['id'] ?? NULL;
        $payment_status  = $_POST['payment_status'] ?? NULL;
        $shipping_status = $_POST['shipping_status'] ?? NULL;

        if ($id === NULL){
            $_SESSION['error'] = 'Thiếu ID đơn hàng';
            header('Location: ?page=order&action=index&status=');

            return;
        }

        $updated = $this->_orderModel->updateStatus((int) $id, $payment_status, $shipping_status);

        if ($updated){
            $_SESSION['success'] = 'Cập nhật trạng thái thành công';
        }else{
            $_SESSION['error'] = 'Cập nhật trạng thái thất bại';
        }

        header("Location: ?page=order&action=detail&id=$id");
    }
}
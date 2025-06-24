<?php

require_once 'Models/User.php';

/**
 * Class UserController
 *
 * Quản lý các chức năng CRUD cho người dùng trong phần quản trị.
 */
class UserController
{
    /**
     * @var User $_userModel Đối tượng model User để thao tác với dữ liệu người dùng.
     */
    private $_userModel;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->_userModel = new User();
    }

    /**
     * Hiển thị danh sách người dùng (theo status nếu có).
     */
    public function index()
    {
        $status = $_GET['status'] ?? '';
        $result = $status === ''
            ? $this->_userModel->getAll()
            : $this->_userModel->getAllByStatus($status);
        include 'Views/Admin/User/index.php';
    }

    /**
     * Hiển thị form sửa người dùng.
     */
    public function edit()
    {
        $id = $_GET['id'] ?? '';

        if (!is_numeric($id) || $id <= 0) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('location: ?page=user&action=index');
            exit;
        }

        $result = $this->_userModel->getOne($id);
        if (!$result) {
            header('location: ?page=user&action=index');
            exit;
        }

        include 'Views/Admin/User/edit.php';
    }

    /**
     * Cập nhật người dùng.
     */
    public function update()
    {
        $id = $_POST['id'] ?? '';
        $status = $_POST['status'] ?? '';

        // Get current user info
        $result = $this->_userModel->getOne($id);

        // Prevent update if already active and trying to set active again
        if ($result && $result['status'] === 'active' && $status === 'active') {
            $_SESSION['success'] = 'Người dùng đã hoạt động. Không có thay đổi nào được thực hiện.';
            header('location: ?page=user&action=detail&id=' . $id);
            exit;
        }

        $data = [
            'id' => $id,
            'status' => $status,
        ];

        $result = $this->_userModel->update($id, $data);

        if ($result) {
            $_SESSION['success'] = 'Cập nhật trạng thái thành công';
            header('location: ?page=user&action=detail&id=' . $id);
            exit;
        } else {
            $_SESSION['error'] = 'Update failed';
            header('location: ?page=user&action=edit&id=' . $id);
            exit;
        }
    }


    /**
     * Xem chi tiết người dùng.
     */
    public function detail()
    {
        $id = $_GET['id'] ?? '';
//        if (!is_numeric($id) || $id <= 0) {
//            $_SESSION['error'] = 'ID không hợp lệ';
//            header('Location: ?page=user&action=index');
//            exit;
//        }

        $userModel = new User();
        // Gọi model để lấy dữ liệu
        $result= $userModel->getOne($id);
//var_dump($result);
        if (!$result) {
            $_SESSION['error'] = "Người dùng không tồn tại";
            header('Location: ?page=user&action=index');
            exit;
        }
        // Hiển thị giao diện chi tiết người dùng

        include 'Views/Admin/User/detail.php';

    }

    /**
     * Xoá người dùng.
     */
    public
    function delete()
    {
        $id = $_GET['id'] ?? '';

        if (empty($id) || !is_numeric($id) || $id <= 0) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('location: ?page=user&action=index');
            exit;
        }

        $result = $this->_userModel->delete($id);

        $_SESSION['success'] = $result ? 'Xoá tài khoản thành công' : 'Xoá tài khoản thất bại';
        header('location: ?page=user&action=index');
        exit;
    }
}

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
        var_dump($result);
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
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $birth = $_POST['birth'] ?? '';
        $avatar = $_FILES['avatar'] ?? '';
        $status = $_POST['status'] ?? '';
        $role = $_POST['role'] ?? '';
        $oldImage = $_POST['old_avatar'] ?? '';
        $filename = $oldImage;
        $reset_token = $_POST['reset_token'] ?? '';
        $reset_token_time = $_POST['reset_token_time'] ?? '';
        $created_at = $_POST['created_at'] ?? '';
        $updated_at = $_POST['updated_at'] ?? '';



        $error = false;

        $_SESSION['error'] = [];

        if (empty($username) || empty($email) || empty($phone) || empty($birth) || empty($status) || empty($role)) {
            $_SESSION['error']['error_username'] = 'Vui lòng điền đầy đủ thông tin';
            $error = true;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error']['error_email'] = 'Email không hợp lệ';
            $error = true;
        }
        if (!preg_match('/^[0-9]{10,11}$/', $phone)) {
            $_SESSION['error']['phone'] = 'Số điện thoại không hợp lệ';
            $error = true;
        }
        if (strtotime($birth) === false) {
            $_SESSION['error']['error_birth'] = 'Ngày sinh không hợp lệ';
            $error = true;
        }

        if (!in_array($status, ['active', 'inactive'])) {
            $_SESSION['error']['error_status'] = 'Trạng thái không hợp lệ';
            $error = true;
        }
        if (!in_array($role, ['admin', 'user'])) {
            $_SESSION['error']['error_role'] = 'Vai trò không hợp lệ';
            $error = true;
        }

        if ($avatar && $avatar['error'] !== 0 && $avatar['error'] !== 4) {
            $_SESSION['error']['avatar_mess'] = 'Lỗi khi tải ảnh';
            $error = true;
        }
        if ($avatar && $avatar['error'] === 0) {
            $ext = strtolower(pathinfo($avatar['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            if (!in_array($ext, $allowed)) {
                $_SESSION['error']['avatar_mess'] = 'Chỉ chấp nhận ảnh jpg, jpeg, png, gif, webp.';
                $error = true;
            }
        } elseif ($avatar && $avatar['error'] !== 4) {
            $_SESSION['error']['avatar_mess'] = 'Lỗi khi tải ảnh.';
            $error = true;
        }
        if ($error) {
            header('location: ?page=user&action=edit&id=' . $id);
            exit;
        }
        if ($avatar && $avatar['error'] === 0) {
            $date = date('Ymd');
            $nameSlug = preg_replace('/[^a-zA-Z0-9]+/', '_', strtolower(trim($username)));
            $ext = pathinfo($avatar['name'], PATHINFO_EXTENSION);
            $newImage = $nameSlug . '_' . $date . '.' . $ext;

            $targetFile = 'Uploads/' . $newImage;

            if (move_uploaded_file($avatar['tmp_name'], $targetFile)) {
                $filename = $newImage;
                if (!empty($oldImage) && $oldImage !== $newImage && file_exists('Uploads/' . $oldImage)) {
                    unlink('Uploads/' . $oldImage);
                }

            } else {
                $_SESSION['error']['image_mess'] = 'Không thể upload ảnh.';
                header('location: ?page=user&action=edit&id=' . $id);
                exit;
            }
        }
            $data = [
                'id' => $id,
                'username' => $username,
                'email' => $email,
                'phone' => $phone,
                'birth' => $birth,
                'avatar' => $filename,
                'status' => $status,
                'role' => $role,
                'reset_token' => $reset_token,
                'reset_token_time' => $reset_token_time,
                'created_at' => $created_at,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $result = $this->_userModel->update($id, $data);

            if ($result) {
                $_SESSION['success'] = 'Cập nhật thành công';
                header('location: ?page=user');
            } else {
                $_SESSION['error'] = 'Cập nhật thất bại';
                header('location: ?page=user&action=edit&id=' . $id);
            }
            exit;
        }

        /**
         * Xem chi tiết người dùng.
         */
        public
        function detail()
        {
            $id = $_GET['id'] ?? '';
            if (!is_numeric($id) || $id <= 0) {
                $_SESSION['error'] = 'ID không hợp lệ';
                header('Location: ?page=user&action=index');
                exit;
            }


            // Gọi model để lấy dữ liệu
            $user = $this->_userModel->getOne($id);

            if (!$user) {
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

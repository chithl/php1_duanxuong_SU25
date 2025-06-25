<?php

require_once 'Database.php';

/**
 * Class User
 *
 * Lớp User quản lý các thao tác CRUD với bảng `users` trong cơ sở dữ liệu.
 */
class User{

    /**
     * @var PDO $_conn Kết nối cơ sở dữ liệu
     */
    private $_conn;

    /**
     * @var string $_table Tên bảng trong cơ sở dữ liệu
     */
    private $_table = 'users';

    /**
     * User constructor.
     * Khởi tạo kết nối đến cơ sở dữ liệu.
     */
    public function __construct(){
        $db          = new Database;
        $this->_conn = $db->getConnection();
    }

    /**
     * Lấy tất cả dữ liệu từ bảng users với phân trang.
     *
     * @param int $start Vị trí bắt đầu
     * @param int $end   Số lượng bản ghi cần lấy
     *
     * @return array Mảng kết quả các bản ghi
     */
    public function getAll(int $start = 0, int $end = 30){
        // require_once 'Models/Connect.php';
        $sql = "SELECT * FROM $this->_table LIMIT :start, :end";

        $stmt = $this->_conn->prepare($sql);

        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':end', $end, PDO::PARAM_INT);

        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    public function getUserById($id)
    {
        $stmt = $this->_conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        } else {
            return null;
        }
    }

    /**
     * Lấy tất cả bản ghi theo trạng thái.
     *
     * @param string $status Trạng thái của user (mặc định là '1')
     *
     * @return array Mảng kết quả các bản ghi
     */
    public function getAllByStatus($status = '1'){
        $sql = "SELECT * FROM $this->_table WHERE status=:status";

        $stmt = $this->_conn->prepare($sql);

        $data = [
            'status' => $status,
        ];

        $stmt->execute($data);

        $result = $stmt->fetchAll();

        return $result;
    }

    /**
     * Lấy một bản ghi theo id.
     *
     * @param int $id ID của user
     *
     * @return array|false Mảng thông tin user hoặc false nếu không tìm thấy
     */
    public function getOne(int $id){
        $sql = "SELECT * FROM $this->_table WHERE id=:id";

        $stmt = $this->_conn->prepare($sql);

        // do id là int nên dùng bindParam
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Thêm mới một bản ghi vào bảng users.
     *
     * @param array $data Dữ liệu cần thêm (name, status)
     *
     * @return bool|null True nếu thành công, null nếu thất bại
     */
    public function insert($username, $password, $email, $phone, $birth, $avatar_name)
    {
        try {
            $stmt = $this->_conn->prepare("INSERT INTO users (username, password, email, phone, birth, avatar) VALUES (:username, :password, :email, :phone, :birth, :avatar)");
            $data = [
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'email' => $email,
                'phone' => $phone,
                'birth' => $birth,
                'avatar' => $avatar_name
            ];
            return $stmt->execute($data);
        } catch (PDOException $e) {
            $errorMessage = date('Y-m-d H:i:s') . " - Lỗi khi đăng ký tài khoản: " . $e->getMessage() . PHP_EOL;
            file_put_contents(__DIR__ . '/../Logs/Error.log', $errorMessage, FILE_APPEND);
            return false;
        }
    }

    public function getInfoExact($username)
    {
        $stmt = $this->_conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getInfoByEmail($email)
    {
        $stmt = $this->_conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function resetToken($username, $email)
    {
        try {
            $reset_token = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $reset_token_expiry = date('Y-m-d H:i:s', time() + 600);

            $stmt = $this->_conn->prepare("
                UPDATE users 
                SET reset_token = :reset_token, reset_token_expiry = :reset_token_expiry 
                WHERE username = :username AND email = :email
            ");
            $data = [
                'reset_token' => $reset_token,
                'reset_token_expiry' => $reset_token_expiry,
                'username' => $username,
                'email' => $email
            ];
            $stmt->execute($data);

            require_once __DIR__ . '/../Assets/PHPMailer-6.10.0/src/PHPMailer.php';
            require_once __DIR__ . '/../Assets/PHPMailer-6.10.0/src/SMTP.php';
            require_once __DIR__ . '/../Assets/PHPMailer-6.10.0/src/Exception.php';

            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'nguyenben08083508@gmail.com';
            $mail->Password = 'qosy bpdj qlkz wnmb';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('nguyenben08083508@gmail.com', 'WD20301');
            $mail->addAddress($email, $username);

            $mail->isHTML(true);
            $mail->Subject = 'Mã xác nhận đặt lại mật khẩu';
            $mail->Body = "Xin chào <b>$username</b>,<br><br>Mã xác nhận đặt lại mật khẩu của bạn là: 
                          <h2>$reset_token</h2><br>Mã này sẽ hết hạn sau 10 phút.<br><br>-- <i>Xưởng thực hành FPT Polytechnic</i>";

            $mail->send();

            return $reset_token;
        } catch (PDOException $e) {
            $errorMessage = date('Y-m-d H:i:s') . " - Lỗi khi reset token: " . $e->getMessage() . PHP_EOL;
            file_put_contents(__DIR__ . '/../Logs/Error.log', $errorMessage, FILE_APPEND);
            return false;
        } catch (Exception $e) {
            $errorMessage = date('Y-m-d H:i:s') . " - Lỗi gửi email: " . $e->getMessage() . PHP_EOL;
            file_put_contents(__DIR__ . '/../Logs/Error.log', $errorMessage, FILE_APPEND);
            return false;
        }
    }

    public function getTokenInfo($username, $token)
    {
        $stmt = $this->_conn->prepare("SELECT reset_token_expiry FROM users WHERE username = :username AND reset_token = :token");
        $stmt->execute([
            'username' => $username,
            'token' => $token
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function resetPassword($username, $token, $newPassword)
    {
        try {
            $stmt = $this->_conn->prepare(
                "UPDATE users SET password = :password, reset_token = NULL, reset_token_expiry = NULL WHERE username = :username"
            );
            $data = [
                'username' => $username,
                'password' => password_hash($newPassword, PASSWORD_DEFAULT)
            ];
            return $stmt->execute($data);
        } catch (PDOException $e) {
            $errorMessage = date('Y-m-d H:i:s') . " - Lỗi khi đổi mật khẩu mới: " . $e->getMessage() . PHP_EOL;
            file_put_contents(__DIR__ . '/../Logs/Error.log', $errorMessage, FILE_APPEND);
            return false;
        }
    }

    /**
     * Cập nhật thông tin một bản ghi theo id.
     *
     * @param int   $id   ID của user
     * @param array $data Dữ liệu cập nhật (name, status, id)
     *
     * @return int|null Số dòng bị ảnh hưởng hoặc null nếu thất bại
     */
    public function update(int $id, array $data){
        try{
            $sql  = "UPDATE $this->_table SET name=:name,status=:status WHERE id=:id";
            $stmt = $this->_conn->prepare($sql);

            $result = $stmt->execute($data);

            return $stmt->rowCount();
            // return $result;
        }
        catch (PDOException $e){
            // ghi log
            var_dump($e->getMessage());
        }
    }

    /**
     * Xoá một bản ghi theo id.
     *
     * @param int $id ID của user cần xoá
     *
     * @return int|null Số dòng bị ảnh hưởng hoặc null nếu thất bại
     */
    public function delete(int $id){
        try{
            $sql  = "DELETE FROM $this->_table WHERE id=:id";
            $stmt = $this->_conn->prepare($sql);

            $result = $stmt->execute(['id' => $id]);

            // số hàng bị tác động
            return $stmt->rowCount();

            // return $result;
        }
        catch (PDOException $e){
            // echo '<pre>';
            var_dump($e);
        }
    }
}
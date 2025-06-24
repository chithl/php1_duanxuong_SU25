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
    public function insert($data){
        try{
            $sql    = "INSERT INTO $this->_table (name, status) VALUES (:name, :status)";
            $stmt   = $this->_conn->prepare($sql);
            $result = $stmt->execute($data);

            return $result;
        }
        catch (PDOException $e){
            // ghi log
            var_dump($e->getMessage());
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

    public function Login($username, $password)
    {

        $sql = "SELECT * FROM users WHERE username =:username";
        $stmt = $this->_conn->prepare($sql);
        $data = [
            ':username' => $username
        ];
        $stmt->execute($data);
        $user = $stmt->fetch();
        $password_hash = $user['password'] ?? '';
        if ($user && password_verify($password, $password_hash)) {
            return $user;
        } else {
            return false;
        }
    }
}
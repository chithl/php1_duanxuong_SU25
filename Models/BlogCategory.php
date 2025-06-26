<?php

require_once 'Database.php';

/**
 * Class BlogCategory
 *
 * Lớp BlogCategory quản lý các thao tác CRUD với bảng `blog_categories` trong cơ sở dữ liệu.
 */
class BlogCategory{

    /**
     * @var PDO $_conn Kết nối cơ sở dữ liệu
     */
    private $_conn;

    /**
     * @var string $_table Tên bảng trong cơ sở dữ liệu
     */
    private $_table = 'blog_categories';

    /**
     * BlogCategory constructor.
     * Khởi tạo kết nối đến cơ sở dữ liệu.
     */
    public function __construct(){
        $db          = new Database;
        $this->_conn = $db->getConnection();
    }

    /**
     * Lấy tất cả dữ liệu từ bảng blog_categories với phân trang.
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

        // $stmt = $this->_conn->query($sql);

        $result = $stmt->fetchAll();

        return $result;
    }

    /**
     * Lấy một bản ghi theo id.
     *
     * @param int $id ID của danh mục blog
     *
     * @return array|false Mảng thông tin hoặc false nếu không tìm thấy
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
     * Thêm mới một bản ghi vào bảng blog_categories.
     *
     * @param array $data Dữ liệu cần thêm (name, status)
     *
     * @return bool|null True nếu thành công, null nếu thất bại
     */
    public function insert($data){
        try{
            $sql    = "INSERT INTO $this->_table (name, description) VALUES (:name, :description)";
            $stmt   = $this->_conn->prepare($sql);
            $result = $stmt->execute($data);

            return $result;
        }catch (PDOException $e){
            // ghi log
            var_dump($e->getMessage());
        }
    }

    /**
     * Cập nhật thông tin một bản ghi theo id.
     *
     * @param int   $id   ID của danh mục blog
     * @param array $data Dữ liệu cập nhật (name, status, id)
     *
     * @return int|null Số dòng bị ảnh hưởng hoặc null nếu thất bại
     */
    public function update(int $id, array $data){
        try{
            $sql    = "UPDATE $this->_table SET name=:name,description=:description WHERE id=:id";
            $stmt   = $this->_conn->prepare($sql);
            $result = $stmt->execute($data);

            return $result;
            // return $result;
        }catch (PDOException $e){
            // ghi log
            var_dump($e->getMessage());
        }
    }

    /**
     * Xoá một bản ghi theo id.
     *
     * @param int $id ID của danh mục blog cần xoá
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
        }catch (PDOException $e){
            // echo '<pre>';
            var_dump($e);
        }
    }

    public function getByName($name){
        $sql  = "SELECT * FROM $this->_table WHERE name = :name";
        $stmt = $this->_conn->prepare($sql);
        $data = [
            "name" => $name,
        ];
        $stmt->execute($data);

        return $stmt->fetch();
    }
}
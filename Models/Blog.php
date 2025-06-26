<?php

require_once 'Database.php';

/**
 * Class Blog
 *
 * Lớp Blog quản lý các thao tác CRUD với bảng `blogs` trong cơ sở dữ liệu.
 */
class Blog{

    /**
     * @var PDO $_conn Kết nối cơ sở dữ liệu
     */
    private $_conn;

    /**
     * @var string $_table Tên bảng trong cơ sở dữ liệu
     */
    private $_table = 'blogs';

    /**
     * Blog constructor.
     * Khởi tạo kết nối đến cơ sở dữ liệu.
     */
    public function __construct(){
        $db          = new Database;
        $this->_conn = $db->getConnection();
    }

    public function getCategories(){
        $sql    = "SELECT * FROM blog_categories";
        $stmt   = $this->_conn->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Lấy tất cả dữ liệu từ bảng blogs với phân trang.
     *
     * @param int $start Vị trí bắt đầu
     * @param int $end   Số lượng bản ghi cần lấy
     *
     * @return array Mảng kết quả các bản ghi
     */
    public function getAll(int $start = 0, int $end = 30){
        $sql  = "SELECT * FROM $this->_table LIMIT :start, :end";
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
     * @param string $status Trạng thái của blog (mặc định là '1')
     *
     * @return array Mảng kết quả các bản ghi
     */
    public function getAllByStatus($status = '1'){
        $sql  = "SELECT * FROM $this->_table WHERE status=:status";
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
     * @param int $id ID của blog
     *
     * @return array|false Mảng thông tin blog hoặc false nếu không tìm thấy
     */
    public function getOne(int $id){
        $sql  = "SELECT * FROM $this->_table WHERE id=:id";
        $stmt = $this->_conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Thêm mới một bản ghi vào bảng blogs.
     *
     * @param array $data Dữ liệu cần thêm (name, status)
     *
     * @return bool|null True nếu thành công, null nếu thất bại
     */
    public function insert($data){
        try{
            $sql    = "INSERT INTO $this->_table (title, content, blog_category_id, image) VALUES (:title, :content, :blog_category_id, :image)";
            $stmt   = $this->_conn->prepare($sql);

            $result = $stmt->execute($data);

            return $result;
        }
        catch (PDOException $e){
            // ghi log lỗi
            var_dump($e->getMessage());
        }
    }

    /**
     * Cập nhật thông tin một bản ghi theo id.
     *
     * @param int   $id   ID của blog
     * @param array $data Dữ liệu cập nhật (name, status, id)
     *
     * @return int|null Số dòng bị ảnh hưởng hoặc null nếu thất bại
     */
    public function update(int $id, array $data){
        try{
            $sql = "UPDATE $this->_table SET title=:title, content=:content, blog_category_id=:blog_category_id, image=:image WHERE id=:id";
            $stmt = $this->_conn->prepare($sql);
            $result = $stmt->execute($data);
            return  $result;

        }
        catch (PDOException $e){
            file_put_contents(
                __DIR__ . '/../Logs/error.log', // Đường dẫn tới thư mục logs
                date('Y-m-d H:i:s') . ' - ' . $e->getMessage() . PHP_EOL,
                FILE_APPEND
            );

        }
    }

    /**
     * Xoá một bản ghi theo id.
     *
     * @param int $id ID của blog cần xoá
     *
     * @return int|null Số dòng bị ảnh hưởng hoặc null nếu thất bại
     */
    public function delete(int $id){
        try{
            $sql    = "DELETE FROM $this->_table WHERE id=:id";
            $stmt   = $this->_conn->prepare($sql);
            $result = $stmt->execute(['id' => $id]);

            return $stmt->rowCount();
        }
        catch (PDOException $e){
            // ghi log lỗi
            var_dump($e);
        }
    }
}
<?php

require_once 'Database.php';

/**
 * Class Product
 *
 * Lớp Product quản lý các thao tác CRUD với bảng `products` trong cơ sở dữ liệu.
 */
class Product{

    /**
     * @var PDO $_conn Kết nối cơ sở dữ liệu
     */
    private $_conn;

    /**
     * @var string $_table Tên bảng trong cơ sở dữ liệu
     */
    private $_table = 'products';

    /**
     * Product constructor.
     * Khởi tạo kết nối đến cơ sở dữ liệu.
     */
    public function __construct(){
        $db          = new Database;
        $this->_conn = $db->getConnection();
    }

    public function getCategories(){
        $sql    = "SELECT * FROM product_categories";
        $stmt   = $this->_conn->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Lấy tất cả dữ liệu từ bảng products với phân trang.
     *
     * @param int $start Vị trí bắt đầu
     * @param int $end   Số lượng bản ghi cần lấy
     *
     * @return array Mảng kết quả các bản ghi
     */
    public function getAll(int $start = 0, int $end = 30){
        // require_once 'Models/Connect.php';
        $sql = "SELECT p.*,c.name as category_name FROM $this->_table p INNER JOIN product_categories c ON p.product_category_id = c.id LIMIT :start, :end";

        $stmt = $this->_conn->prepare($sql);

        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':end', $end, PDO::PARAM_INT);

        $stmt->execute();

        // $stmt = $this->_conn->query($sql);

        $result = $stmt->fetchAll();

        return $result;
    }

    /**
     * Lấy tất cả bản ghi theo trạng thái.
     *
     * @param string $status Trạng thái của sản phẩm (mặc định là '1')
     *
     * @return array Mảng kết quả các bản ghi
     */
    public function getAllByStatus($status = 'available'){
        $sql = "SELECT p.id,c.name as category_name,p.name,p.price,p.stock,p.image,p.status FROM $this->_table p INNER JOIN product_categories c ON p.product_category_id = c.id WHERE p.status=:status";

        $stmt = $this->_conn->prepare($sql);

        $data = [
            'status' => $status,
        ];

        $stmt->execute($data);

        $result = $stmt->fetchAll();

        return $result;
    }

    //    search by name product
    public function getAllByName($name){
        $name = "%" . $name . "%";
        $sql  = "SELECT * FROM products WHERE name like '$name'";

        $stmt = $this->_conn->query($sql);


        $result = $stmt->fetchAll();

        return $result;

    }

    public function getByName($keyword){
        $sql     = "SELECT p.id,c.name as category_name,p.name,p.price,p.stock,p.image,p.status FROM $this->_table p INNER JOIN product_categories c ON p.product_category_id = c.id WHERE p.name LIKE '%$keyword%'";
        $product = $this->_conn->query($sql);
        $product = $this->_conn->prepare($sql);
        $product->execute([':keyword' => "%$keyword%"]);
        $result = $product->fetchAll();

        return $result;
    }

    public function getByNameAndStatus($keyword, $status){
        $sql     = "SELECT p.id,c.name as category_name,p.name,p.price,p.stock,p.image,p.status FROM $this->_table p INNER JOIN product_categories c ON p.product_category_id = c.id WHERE p.name LIKE :keyword AND p.status = :status";
        $product = $this->_conn->prepare($sql);
        $product->execute([':keyword' => "%$keyword%", ":status" => $status]);
        $result = $product->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Lấy một bản ghi theo id.
     *
     * @param int $id ID của sản phẩm
     *
     * @return array|false Mảng thông tin sản phẩm hoặc false nếu không tìm thấy
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

    public function getByFeaturedAndStatus($is_featured = 1, $status = 'available'){
        $sql = "SELECT p.id,c.name as category_name,p.name,p.price,p.stock,p.image,p.status FROM $this->_table p INNER JOIN product_categories c ON p.product_category_id = c.id WHERE p.is_featured=:is_featured AND p.status=:status";

        $stmt = $this->_conn->prepare($sql);

        $data = [
            'is_featured' => $is_featured,
            'status'      => $status,
        ];

        $stmt->execute($data);

        $result = $stmt->fetchAll();

        return $result;
    }

    /**
     * Thêm mới một bản ghi vào bảng products.
     *
     * @param array $data Dữ liệu cần thêm (name, status)
     *
     * @return bool|null True nếu thành công, null nếu thất bại
     */
    public function insert($data){
        try{
            $sql    = "INSERT INTO $this->_table (product_category_id,name,description,weight,price,discount_price,view,stock,image,is_featured) VALUES (:product_category_id,:name,:description,:weight,:price,:discount_price,:view,:stock,:image,:is_featured)";
            $stmt   = $this->_conn->prepare($sql);
            $result = $stmt->execute($data);

            return $result;
        }catch (PDOException $e){
            // ghi log
            file_put_contents(
                __DIR__ . '/../Logs/error.log', // Đường dẫn tới thư mục logs
                date('Y-m-d H:i:s') . ' - ' . $e->getMessage() . PHP_EOL,
                FILE_APPEND
            );

        }
    }

    public function checkName($name){
        $sql     = "SELECT COUNT(*) FROM $this->_table WHERE name = :name";
        $product = $this->_conn->prepare($sql);
        $product->execute([':name' => $name]);
        if ($product->fetchColumn() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function checkIdAndName($id, $name){
        $sql     = "SELECT COUNT(*) FROM $this->_table WHERE id != :id AND name = :name";
        $product = $this->_conn->prepare($sql);
        $product->execute([':id' => $id, ':name' => $name]);
        if ($product->fetchColumn() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /**
     * Cập nhật thông tin một bản ghi theo id.
     *
     * @param int   $id   ID của sản phẩm
     * @param array $data Dữ liệu cập nhật (name, status, id)
     *
     * @return int|null Số dòng bị ảnh hưởng hoặc null nếu thất bại
     */
    public function update(array $data){
        try{
            $sql  = "UPDATE $this->_table SET name=:name,product_category_id=:product_category_id,description=:description,price=:price,weight=:weight,discount_price=:discount_price,stock=:stock,image=:image,is_featured=:is_featured ,status=:status WHERE id=:id";
            $stmt = $this->_conn->prepare($sql);

            $result = $stmt->execute($data);

            return $result;

            // return $result;
        }catch (PDOException $e){
            // ghi log
            file_put_contents(
                __DIR__ . '/../Logs/error.log', // Đường dẫn tới thư mục logs
                date('Y-m-d H:i:s') . ' - ' . $e->getMessage() . PHP_EOL,
                FILE_APPEND
            );
            var_dump($e->getMessage());
        }
    }

    /**
     * Xoá một bản ghi theo id.
     *
     * @param int $id ID của sản phẩm cần xoá
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
}
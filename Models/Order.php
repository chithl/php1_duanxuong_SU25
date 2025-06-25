<?php

require_once 'Database.php';

/**
 * Class Order
 *
 * Lớp Order quản lý các thao tác CRUD với bảng `orders` trong cơ sở dữ liệu.
 */
class Order{

    /**
     * @var PDO $_conn Kết nối cơ sở dữ liệu
     */
    private $_conn;

    /**
     * @var string $_table Tên bảng trong cơ sở dữ liệu
     */
    private $_table = 'orders';

    /**
     * Order constructor.
     * Khởi tạo kết nối đến cơ sở dữ liệu.
     */
    public function __construct(){
        $db          = new Database;
        $this->_conn = $db->getConnection();
    }

    /**
     * Lấy tất cả dữ liệu từ bảng orders với phân trang.
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

    public function getAllByStatus($payment_status = 'Chờ xác nhận', int $start = 0, int $end = 30){
        $sql  = "SELECT * FROM $this->_table WHERE payment_status = :payment_status LIMIT :start, :end";
        $stmt = $this->_conn->prepare($sql);

        // Bind các giá trị đúng kiểu
        $stmt->bindValue(':payment_status', $payment_status);
        $stmt->bindValue(':start', $start, PDO::PARAM_INT);
        $stmt->bindValue(':end', $end, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();
    }

//    public function searchByNameAndStatus($keyword, $payment_status){
//        if ($payment_status == ''){
//            $sql  = "SELECT * FROM $this->_table WHERE shipping_address LIKE '%$keyword%' ";
//            $stmt = $this->_conn->query($sql);
//        }else{
//            $sql  = "SELECT * FROM $this->_table WHERE shipping_address LIKE :keyword AND status = :status ORDER BY id DESC";
//            $stmt = $this->_conn->prepare($sql);
//            $stmt->execute([
//                ':keyword' => "%$keyword%",
//                ':payment_status'  => $payment_status
//            ]);
//        }
//
//        return $stmt->fetchAll();
//    }


/**
 * Lấy một bản ghi theo id.
 *
 * @param int $id ID của đơn hàng
 *
 * @return array|false Mảng thông tin đơn hàng hoặc false nếu không tìm thấy
 */
public
function getOne($id){
    $sql  = "SELECT o.*, u.username AS user_name  FROM $this->_table o LEFT JOIN users u ON o.user_id = u.id WHERE o.id = :id";
    $stmt = $this->_conn->prepare($sql);
    $stmt->execute(['id' => $id]);

    return $stmt->fetch();
}

/**
 * Thêm mới một bản ghi vào bảng orders.
 *
 * @param array $data Dữ liệu cần thêm (name, status)
 *
 * @return bool|null True nếu thành công, null nếu thất bại
 */
public
function insert($data){
    try{
        $sql    = "INSERT INTO $this->_table (name, status) VALUES (:name, :status)";
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
 * @param int   $id   ID của đơn hàng
 * @param array $data Dữ liệu cập nhật (name, status, id)
 *
 * @return int|null Số dòng bị ảnh hưởng hoặc null nếu thất bại
 */
public
function update(int $id, array $data){
    try{
        $sql  = "UPDATE $this->_table SET name=:name,status=:status WHERE id=:id";
        $stmt = $this->_conn->prepare($sql);

        $result = $stmt->execute($data);

        return $stmt->rowCount();
        // return $result;
    }catch (PDOException $e){
        // ghi log
        var_dump($e->getMessage());
    }
}


/**
 * Xoá một bản ghi theo id.
 *
 * @param int $id ID của đơn hàng cần xoá
 *
 * @return int|null Số dòng bị ảnh hưởng hoặc null nếu thất bại
 */
public
function delete(int $id){
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

function generateTrackingCode($id, $randomize = FALSE){
    $date     = date('Ymd'); // 20250623
    $idPadded = str_pad($id, 4, '0', STR_PAD_LEFT);
    if ($randomize){
        $rand = rand(10, 99); // Nếu cần, thêm số ngẫu nhiên để tránh trùng

        return "SHIP-{$date}-{$idPadded}-{$rand}";
    }

    return "SHIP-{$date}-{$idPadded}";// 0012

}

public
function updateStatus($id, $payment_status, $shipping_status){
    if ($id === NULL){
        return FALSE;
    }

    $sql  = "UPDATE $this->_table SET payment_status = :payment_status, shipping_status = :shipping_status WHERE id = :id";
    $stmt = $this->_conn->prepare($sql);

    return $stmt->execute([
        ':payment_status'  => $payment_status,
        ':shipping_status' => $shipping_status,
        ':id'              => $id
    ]);
}

public
function getOrderDetails($orderId){
    $sql  = "SELECT od.*, p.name AS product_name, p.image , p.weight, p.description
            FROM order_details od
            JOIN products p ON od.product_id = p.id
            WHERE od.order_id = :id";
    $stmt = $this->_conn->prepare($sql);
    $stmt->execute(['id' => $orderId]);

    return $stmt->fetchAll();
}

public
function insertOrder($data){
    $sql  = "INSERT INTO orders (price, address, phone, payments, payments_status, status, user_id) 
                VALUES (:price, :address, :phone, :payments, :payments_status, :status, :user_id)";
    $stmt = $this->_connection->prepare($sql);
    $stmt->execute($data);

    return $this->_connection->lastInsertId();
}
}
<?php
require_once 'Database.php';

class StaticModel{

    /**
     * @var PDO $_conn Kết nối cơ sở dữ liệu
     */
    private $_conn;

    public function __construct(){
        $db          = new Database;
        $this->_conn = $db->getConnection();
    }

    public function countOrders(){
        $sql = "SELECT COUNT(*) as total FROM orders";

        return $this->_conn->query($sql)->fetch()['total'];
    }

    public function countUsers(){
        $sql = "SELECT COUNT(*) as total FROM users";

        return $this->_conn->query($sql)->fetch()['total'];
    }

    public function countProducts(){
        $sql = "SELECT COUNT(*) as total FROM products";

        return $this->_conn->query($sql)->fetch()['total'];
    }

    public function countNewUsers($days = 7){
        $sql  = "SELECT COUNT(*) as total FROM users WHERE created_at >= DATE_SUB(NOW(), INTERVAL :days DAY)";
        $stmt = $this->_conn->prepare($sql);
        $stmt->execute([':days' => $days]);

        return $stmt->fetch()['total'];
    }

    public function pendingOrders(){
        $sql  = "SELECT COUNT(*) as total FROM orders WHERE payment_status = 'pending'";
        $stmt = $this->_conn->prepare($sql);

        return $this->_conn->query($sql)->fetch()['total'];
    }

    public function completedOrders(){
        $sql  = "SELECT COUNT(*) as total FROM orders WHERE payment_status ='completed'";
        $stmt = $this->_conn->prepare($sql);

        return $this->_conn->query($sql)->fetch()['total'];
    }

    function getTodayRevenue(){
        $sql = "SELECT SUM(total_price) FROM orders
            WHERE payment_status = 'completed' AND DATE(created_at) = CURDATE()";

        return $this->_conn->query($sql)->fetchColumn() ?? 0;
    }

    function getMonthRevenue(){
        $sql = "SELECT SUM(total_price) FROM orders
            WHERE payment_status = 'completed'
            AND MONTH(created_at) = MONTH(CURDATE())
            AND YEAR(created_at) = YEAR(CURDATE())";

        return $this->_conn->query($sql)->fetchColumn() ?? 0;
    }

    function countTodayOrders(){
        $sql = "SELECT COUNT(*) FROM orders
            WHERE payment_status = 'completed' AND DATE(created_at) = CURDATE()";

        return $this->_conn->query($sql)->fetchColumn() ?? 0;
    }

    function countPendingOrders(){
        $sql = "SELECT COUNT(*) FROM orders WHERE payment_status = 'pending'";

        return $this->_conn->query($sql)->fetchColumn() ?? 0;
    }

    function getRevenueByDay(){
        $sql = "SELECT DATE(created_at) AS day, SUM(total_price) AS revenue
            FROM orders
            WHERE payment_status = 'completed'
            AND created_at >= CURDATE() - INTERVAL 7 DAY
            GROUP BY DATE(created_at)
            ORDER BY day ASC";

        return $this->_conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTopSellingProducts($limit = 10){
        $sql = "SELECT p.name, SUM(od.quantity) AS total_sold
                FROM order_details od
                JOIN orders o ON od.order_id = o.id
                JOIN products p ON od.product_id = p.id
                WHERE o.payment_status = 'completed'
                GROUP BY p.name
                ORDER BY total_sold DESC
                LIMIT :limit";

        $stmt = $this->_conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

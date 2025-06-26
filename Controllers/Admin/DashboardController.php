<?php

require_once 'Models/StaticModel.php';

class DashboardController{

    private $_staticModel;

    public function __construct(){
        $this->_staticModel = new StaticModel();
    }

    public function index(){
        $data          = [
            'totalOrders'     => $this->_staticModel->countOrders(),
            'totalUsers'      => $this->_staticModel->countUsers(),
            'totalProducts'   => $this->_staticModel->countProducts(),
            'newUsers'        => $this->_staticModel->countNewUsers(7),
            'pendingOrders'   => $this->_staticModel->pendingOrders(),
            'completedOrders' => $this->_staticModel->completedOrders()
        ];
        $todayRevenue  = $this->_staticModel->getTodayRevenue();
        $monthRevenue  = $this->_staticModel->getMonthRevenue();
        $todayOrders   = $this->_staticModel->countTodayOrders();
        $pendingOrders = $this->_staticModel->countPendingOrders();
        $revenueByDay  = $this->_staticModel->getRevenueByDay();
        $bestSell      = $this->_staticModel->getTopSellingProducts();

        if (isset($_POST['best-selling'])){
            include 'Views/Admin/Layouts/bestSell.php'; // gọi View hiển thị
        }
        else{
            include 'Views/Admin/Layouts/dashboard.php'; // gọi View hiển thị
        }
    }
}
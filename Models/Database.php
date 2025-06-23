<?php

class Database{

    private $_DB_host = DB_HOST; // 127.0.0.1
    private $_DB_name = DB_NAME; // tên cơ sở dữ liệu
    private $_DB_username = DB_USER; // mặc định => viết giống cô
    private $_DB_password = DB_PASSWORD; // mật khẩu của cơ sở dữ liệu => mặc định là mysql

    private $_connection;

    public function __construct(){
        $this->connect();
    }

    // hàm kết nối cơ sở dữ liệu
    public function connect(){
        try{
            $this->_connection = new PDO("mysql:host=$this->_DB_host;dbname=$this->_DB_name", $this->_DB_username, $this->_DB_password);
            // set the PDO error mode to exception
            $this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // echo "Connected successfully";
        }
        catch (PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }


    }

    public function disconnect(){
        $this->_connection = '';
    }

    public function getConnection(){
        return $this->_connection;
    }
}

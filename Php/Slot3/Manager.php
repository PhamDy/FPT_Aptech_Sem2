<?php

class Manager
{
    public $conn;

    public function __construct()
    {
        // thực hiện câu lệnh kết nối với cơ sở dữ liệu
        $servername = "localhost:3306";
        $username="root";
        $password="";
        $database="php_slot3";

        // tạo đối tượng Connection
        $this->conn = new mysqli($servername, $username, $password, $database);

        // Kiểm tra kết nối đến CSDL
        if ($this->conn->connect_error) {
            die("Kết nối CSDL không thành công!" . $this->conn->connect_errno);
        } else {
            echo "ok";
        }
    }
}
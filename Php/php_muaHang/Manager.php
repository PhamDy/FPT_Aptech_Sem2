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
    $database="php_muahang";

    // tạo đối tượng Connection
    $this->conn = new mysqli($servername, $username, $password, $database);

    // Kiểm tra kết nối đến CSDL
    if ($this->conn->connect_error) {
        die("Kết nối CSDL không thành công!" . $this->conn->connect_errno);
    } else {
        echo "ok b";
        die("ok b");
    }
}

public function getAllProducts()
{
    $products = [];
    $sql ="SELECT * FROM product";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    $stmt->close();

    return $products;
}

    public function getOrders()
    {
        $orders= [];
        $sql ="SELECT * FROM orders";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }

        $stmt->close();

        return $orders;
    }

    public function getOrdersDetails()
    {
        $orders_details= [];
        $sql ="SELECT * FROM order_details";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $orders_details[] = $row;
        }

        $stmt->close();

        return $orders_details;
    }

    public function getProductById($id)
    {
        $sql ="SELECT * FROM product WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        $stmt->close();

        return $row;
    }

    public function getOrderByCustomerId($id)
    {
        $sql ="SELECT * FROM orders WHERE customer_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        $stmt->close();

        return $row;
    }


    public function getOrderByCustomer($id)
    {
        $sql ="SELECT * FROM product WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        $stmt->close();

        return $row;
    }

    public function addOrders($customer_id)
    {
        $sql = "INSERT INTO orders (customer_id) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $customer_id);
        $success = $stmt->execute();

        // Get the last inserted ID
        $lastInsertedId = $this->conn->insert_id;

        // Đóng statement
        $stmt->close();

        return ($success) ? $lastInsertedId : false;
    }

    public function addOrdersDetails($product_id, $order_id, $price, $quantity)
    {
        $sql = "INSERT INTO order_details (product_id, order_id, price, quantity) VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iidi", $product_id,$order_id, $price, $quantity);
        if ($stmt->execute()) {
            return true; // Thành công
        } else {
            return false; // Thất bại
        }

        $stmt->close();
    }

    public function getCheckOut()
    {
        $sql ="SELECT customer.username AS customer_name, product.name AS product_name, order_details.price AS order_details_price, order_details.quantity AS order_details_quantity
                FROM customer
                INNER JOIN orders ON customer.id = orders.customer_id
                INNER JOIN order_details ON order_details.order_id = orders.id
                INNER JOIN product ON product.id = order_details.product_id";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $checkOut[] = $row;
        }

        $stmt->close();

        return $checkOut;
    }

}
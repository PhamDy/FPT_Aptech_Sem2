<?php

class StudentManager
{
    public $conn;

    public function __construct()
    {
        // thực hiện câu lệnh kết nối với cơ sở dữ liệu
        $servername = "localhost:3306";
        $username="root";
        $password="";
        $database="fptaptechdb";

        // tạo đối tượng Connection
        $this->conn = new mysqli($servername, $username, $password, $database);

        // Kiểm tra kết nối đến CSDL
        if ($this->conn->connect_error) {
            die("Kết nối CSDL không thành công!" . $this->conn->connect_error);
        }
    }

    public function getAllStudents()
    {
        $students = [];
        $sql = "SELECT * FROM students";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }

        $stmt->close();

        return $students;
    }

    public function addStudent($id, $name, $address)
    {
        $sql = "INSERT INTO students (id, name, address) VALUES (?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iss", $id, $name, $address);
        if ($stmt->execute()) {
            return true; // Thành công
        } else {
            return false; // Thất bại
        }

        $stmt->close();
    }

    public function getStudentById($id)
    {
        $sql = "SELECT * FROM students WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        $stmt->close();

        return $row;
    }

    public function updateStudent($id, $name, $address)
    {
        $sql = "UPDATE students SET name=?, address=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $address, $id);
        if ($stmt->execute()) {
            return true; // Thành công
        } else {
            return false; // Thất bại
        }
        $stmt->close();
    }

    public function deleteStudent($id)
    {
        $sql = "DELETE FROM students WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i",$id);
        if ($stmt->execute()) {
            return true; // Thành công
        } else {
            return false; // Thất bại
        }

        $stmt->close();
    }

    public function getMarkDetails()
    {
        $markDetails = [];
        $sql = "SELECT students.id AS student_id, students.name AS student_name, subjects.name AS subject, marks.mark
                FROM students
                INNER JOIN marks ON students.id = marks.student_id
                INNER JOIN subjects ON marks.subject_id = subjects.id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $markDetails[] = $row;
        }

        $stmt->close();

        return $markDetails;
    }

    public function getAllStudentsWithMarks()
    {
        $students = [];

        // Lấy danh sách sinh viên và số điểm
        $sql = "SELECT students.id, students.name, students.address, COUNT(marks.id) AS mark_count
                FROM students
                LEFT JOIN marks ON students.id = marks.student_id
                GROUP BY students.id, students.name, students.address ";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $students[] = $row;
            }
        }

        return $students;
    }

    public function __destruct()
    {
        $this->conn->close();
    }

}
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
    $database="slot6_php";

    // tạo đối tượng Connection
    $this->conn = new mysqli($servername, $username, $password, $database);


    // Kiểm tra kết nối đến CSDL
    if ($this->conn->connect_error) {
        die("Kết nối CSDL không thành công!" . $this->conn->connect_errno);
    }
}
    public function checkMorningAttendance($employee_id, $work_date) {
        $sql = "SELECT * FROM time_sheets WHERE employee_id = ? AND work_date = ? AND attendance = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $employee_id, $work_date);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0; // Trả về true nếu đã điểm danh, ngược lại trả về false
    }

    public function checkAfternoonAttendance($employee_id, $work_date) {
        $sql = "SELECT * FROM time_sheets WHERE employee_id = ? AND work_date = ? AND attendance = 2";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $employee_id, $work_date);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0; // Trả về true nếu đã điểm danh, ngược lại trả về false
    }

    public function attendanceEmployeeMorning($employee_id, $work_date, $start_time, $late, $attendance)
    {

        $sql ="INSERT INTO time_sheets (employee_id, work_date, start_time, late, attendance) VALUES(?,?,?,?,?) ";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("issss", $employee_id, $work_date, $start_time, $late, $attendance);

        $stmt->execute();

        // Kiểm tra và trả về kết quả
        if ($stmt->affected_rows > 0) {
            return "Chấm công buổi sáng thành công!";
        } else {
            return "Đã xảy ra lỗi khi chấm công buổi sáng!";
        }

    }


    public function attendanceEmployeeAftermnoon($employee_id, $end_time, $leave_early, $work_date)
    {
        $sql ="UPDATE time_sheets SET end_time = ? , leave_early = ? , attendance = 2
                   WHERE employee_id = ? AND work_date = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return "Lỗi: " . $this->conn->error;
        }

        $stmt->bind_param("ssis", $end_time, $leave_early, $employee_id, $work_date);

        $stmt->execute();

        // Kiểm tra và trả về kết quả
        if ($stmt->affected_rows > 0) {
            return "Chấm công buổi chiều thành công!";
        } else {
            return "Đã xảy ra lỗi khi chấm công chiều sáng!";
        }

    }

}
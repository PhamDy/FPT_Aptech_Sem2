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

    public function getEmployees() {
        $employees = [];
        $sql = "SELECT * FROM employees WHERE username != 'admin'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $employees[] = $row;
        }

        $stmt->close();

        return $employees;
    }

    public function checkAdmin($pwd) {
        $sql = "SELECT * FROM employees WHERE username = 'admin' AND pwd=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $pwd);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0; // Trả về true nếu đã điểm danh, ngược lại trả về false
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

    public function countLate()
    {
        $sql = "SELECT COUNT(late) FROM time_sheets WHERE late = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $late_count = $row['late_count'];

        $stmt->close();

        return $late_count;
    }

    public function countLeaveEarly()
    {
        $sql = "SELECT COUNT(leave_early) FROM time_sheets WHERE leave_early = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $leaveEarly_count = $row['leaveEarly_count'];

        $stmt->close();

        return $leaveEarly_count;
    }

    public function countAttendance0()
    {
        $sql = "SELECT COUNT(attendance) FROM time_sheets WHERE attendance = 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $attendance_0_count = $row['attendance_0_count'];

        $stmt->close();

        return $attendance_0_count;
    }

    public function countAttendance1()
    {
        $sql = "SELECT COUNT(attendance) FROM time_sheets WHERE attendance = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $attendance_1_count = $row['attendance_1_count'];

        $stmt->close();

        return $attendance_1_count;
    }

    public function countAttendance2()
    {
        $sql = "SELECT COUNT(attendance) FROM time_sheets WHERE attendance = 2";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $attendance_2_count = $row['attendance_2_count'];

        $stmt->close();

        return $attendance_2_count;
    }

    public function addPerformanceEmployee($employee_id, $years, $months, $days_off, $working_days, $score)
    {

        $sql ="UPDATE performances SET end_time = ? , days_off = ? , working_days = ?
                   WHERE employee_id = ? AND years = ? AND months = ?";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("isssss", $employee_id, $years, $months, $days_off, $working_days, $score);

        $stmt->execute();

        // Kiểm tra và trả về kết quả
        if ($stmt->affected_rows > 0) {
            return "ok";
        } else {
            return "error";
        }

    }


}
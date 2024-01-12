<?php
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập, chuyen hướng về trang đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Xử lý khi có dữ liệu được submit từ form
if (isset($_GET['id'])) {
    include 'StudentManager.php';

    $id = $_GET["id"];

    $studentManager = new StudentManager();

    // Xoa sinh viên khoi cơ sở dữ liệu
    $result = $studentManager->deleteStudent($id);

    // Kiểm tra kết quả và chuyển hướng về trang danh sách sinh viên
    if ($result) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Error adding student. Please try again.";
    }

}
?>


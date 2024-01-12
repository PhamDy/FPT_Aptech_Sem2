<?php
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập, chuyen hướng về trang đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Xử lý khi có dữ liệu được submit từ form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'StudentManager.php';

// Kết nối đến StudentManager
    $studentManager = new StudentManager();
    // Lấy thông tin từ form
    $id = $_POST["id"];
    $name = $_POST["name"];
    $address = $_POST["address"];

    // Thêm sinh viên vào cơ sở dữ liệu
    $result = $studentManager->addStudent( $id, $name, $address);

    // Kiểm tra kết quả và chuyển hướng về trang danh sách sinh viên
    if ($result) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Error adding student. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2>Add New Student</h2>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label for="id">Id:</label>
            <input type="text" class="form-control" id="id" name="id" required>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Student</button>
        <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
    </form>

</div>
</body>
</html>

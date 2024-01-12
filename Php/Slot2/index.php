<?php
session_start();





// Kiểm tra nếu người dùng đã đăng nhập, chuyển hướng đến trang dashboard.php
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

// Kiểm tra nếu người dùng đã gửi form đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kết nối đến database
    include 'StudentManager.php';
    $studentManager = new StudentManager();

    // Lấy dữ liệu từ form đăng nhập
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Thực hiện truy vấn kiểm tra đăng nhập
    $sql = "SELECT * FROM account WHERE username=? AND password=?";
    $stmt = $studentManager->conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Đăng nhập thành công, lưu thông tin người dùng vào session
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];

        // Chuyển hướng đến trang dashboard.php
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Đăng nhập không thành công. Vui lòng kiểm tra lại tên đăng nhập và mật khẩu.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2>Login</h2>

    <?php
    if (isset($error_message)) {
        echo '<div class="alert alert-danger">' .$error_message . '</div>';
    }
    ?>

    <form action="" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" id="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

</div>
</body>
</html>


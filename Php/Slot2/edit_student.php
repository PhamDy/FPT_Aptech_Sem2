<?php
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập, chuyen hướng về trang đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

include 'StudentManager.php';

if (isset($_GET['id'])) {

    $id = $_GET["id"];

    $studentManager = new StudentManager();

    $student = $studentManager->getStudentById($id);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST["name"];
    $address = $_POST["address"];

    // Thêm sinh viên vào cơ sở dữ liệu
    $result = $studentManager->updateStudent($id, $name, $address);

    if ($result) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Error updating student. Please try again.";
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
    <h2>Edit Student</h2>

    <form method="post">

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name"  value="<?php echo $student['name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $student['address']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Student</button>
        <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
    </form>

</div>
</body>
</html>


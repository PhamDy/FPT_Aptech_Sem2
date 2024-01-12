<?php
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập, chuyen hướng về trang đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

include 'StudentManager.php';

// Kết nối đến StudentManager
$studentManager = new StudentManager();

// Lấy danh sách sinh viên
$students = $studentManager->getAllStudentsWithMarks();
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
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    <p>This is the main page after successful login.</p>

    <a href="logout.php" class="btn btn-danger">Logout</a>

    <h3>Student List</h3>
    <a href="add_student.php" class="btn btn-success mb-3">Add Student</a>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Action</th>
            <th>Mark Details</th>
            <!-- Add other columns as needed -->
        </tr>
        </thead>
        <tbody>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?php echo $student['id']; ?></td>
            <td><?php echo $student['name']; ?></td>
            <td><?php echo $student['address']; ?></td>
            <td>
                <a href="edit_student.php?id=<?php echo $student['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="delete_student.php?id=<?php echo $student['id']; ?>"  class="btn btn-danger btn-sm"
                   onclick="return confirm('Are you sure you want to delete this student?')" >Delete</a>
            </td>
            <td>
                <?php
                // Kiểm tra xem sinh viên có điểm hay không
                if ($student['mark_count'] > 0) {
                    echo '<a href="mark_detail.php?student_id=' . $student['id'] . '" class="btn btn-info btn-sm">
                                                                                                    Mark Details</a>';
                } else {
                    echo '<button class="btn btn-info btn-sm" disabled>Mark Details</button>';
                }
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>
</body>
</html>




<?php
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'Manager.php';
$Manager = new Manager();

$list = $Manager->getEmployees()


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard employees</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    <p>This is the employee tracking sheet.</p>
    <a href="logout.php" class="btn btn-danger">Logout</a>
    <br>
    <table class="table" style="margin-top: 40px">
        <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Start date working</th>
            <th>Check</th>
<!--            <th>Update</th>-->
        </tr>
        </thead>
        <tbody>
        <?php foreach ($list as $item): ?>
            <tr>
                <td><?php echo $item['username']; ?></td>
                <td><?php echo $item['position']; ?></td>
                <td><?php echo $item['start_date']; ?></td>
                <td>
                    <a href="Performance.php?id=<?php echo $item['id']; ?>" class="btn btn-success btn-sm" >Performance test</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>
</body>
</html>
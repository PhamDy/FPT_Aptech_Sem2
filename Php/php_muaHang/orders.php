<?php
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'Manager.php';
$Manager = new Manager();

$list = $Manager->getCheckOut()


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    <p>This is your Orders.</p>
    <a href="product.php" class="btn btn-primary mb-3">Back to Products</a>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($list as $item): ?>
            <tr>
                <td><?php echo $item['customer_name']; ?></td>
                <td><?php echo $item['product_name']; ?></td>
                <td><?php echo $item['order_details_price']; ?></td>
                <td><?php echo $item['order_details_quantity']; ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <a href="" class="btn btn-danger btn-sm">Check out</a>
            </td>
        </tr>
        </tbody>
    </table>

</div>
</body>
</html>



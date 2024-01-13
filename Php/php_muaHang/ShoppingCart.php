<?php
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include 'Manager.php';

    $Manager = new Manager();

    $customerId = $_SESSION['user_id'];

    $success = $Manager->addOrders($customerId);

    if ($success) {
        $orderId = $Manager->conn->insert_id;

        foreach ($_SESSION['cart'] as $item) {
            $productId = $item['id'];
            $price = $item['price'];
            $quantity = $item['quantity'];

            // Insert into 'order_details' table
            $Manager->addOrdersDetails($productId, $orderId, $price, $quantity);
        }

        $_SESSION['cart'] = array();

        header("Location: orders.php");
        exit();
    } else {
        echo "Order insertion failed.";
    }
}

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
    <p>This is your shopping cart.</p>
    <a href="product.php" class="btn btn-primary mb-3">Back to Products</a>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($_SESSION['cart'] as $item): ?>
            <tr>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['price']; ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td>
                    <a href="Delete.php?id=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Remove from cart?')">Remove</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <!-- Sử dụng thẻ form để thực hiện POST -->
                <form method="post" action="">
                    <input type="hidden" name="order" value="true">
                    <button type="submit" class="btn btn-success btn-sm">Order</button>
                </form>
            </td>
        </tr>
        </tbody>
    </table>


</div>
</body>
</html>

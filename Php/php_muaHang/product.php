<?php
session_start();
//     Kiểm tra nếu người dùng chưa đăng nhập, chuyen hướng về trang đăng nhập
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    include 'Manager.php';

    $Manager = new Manager();

    $products =$Manager->getAllProducts();

    // Kiểm tra nếu $_SESSION['cart'] chưa được khởi tạo, khởi tạo nó là một mảng trống
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
// Xử lý khi có dữ liệu POST được gửi lên từ form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    // Lấy thông tin sản phẩm từ ID sản phẩm được gửi lên
    $productId = $_POST['product_id'];

    // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
    $index = array_search($productId, array_column($_SESSION['cart'], 'id'));

    if ($index !== false) {
        // Sản phẩm đã có trong giỏ hàng, tăng số lượng
        $_SESSION['cart'][$index]['quantity'] += 1;
    } else {
        // Sản phẩm chưa có trong giỏ hàng, thêm mới
        $selectedProduct = $Manager->getProductById($productId);
        $_SESSION['cart'][] = array(
            'id' => $productId,
            'name' => $selectedProduct['name'],
            'price' => $selectedProduct['price'],
            'quantity' => 1,
        );
    }

    // Chuyển hướng đến trang ShoppingCart
    header("Location: ShoppingCart.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    <p>This is the main page after a successful login.</p>

    <a href="logout.php" class="btn btn-danger">Logout</a>

    <h3>Product List</h3>
    <a href="infor.php" class="btn btn-success mb-3">Information User</a>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="<?php echo $product['img']; ?>" class="card-img-top" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['name']; ?></h5>
                        <p class="card-text">Price: $<?php echo $product['price']; ?></p>
                        <p class="card-text"><?php echo 'Desc: ' . $product['product_desc']; ?></p>
                        <!-- Thêm form và input hidden để chứa ID sản phẩm -->
                        <form method="post" action="">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Add to cart successful')">Add to cart</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>



<?php
session_start();

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $productIdToRemove = $_GET['id'];

    // Find the index of the product in the cart
    $indexToRemove = array_search($productIdToRemove, array_column($_SESSION['cart'], 'id'));

    // Check if the product was found in the cart
    if ($indexToRemove !== false) {
        // Remove the product at the specified index
        unset($_SESSION['cart'][$indexToRemove]);

        // Reindex the array to avoid gaps in the indices
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

// Redirect back to the ShoppingCart.php page after removing the item
header("Location: ShoppingCart.php");
exit();
?>


<?php
session_start();

// Retrieve order details from session
$orderDetails = $_SESSION['order_details'] ?? null;

if (!$orderDetails) {
    // If no order details, redirect to cart page
    header("Location: cart.php");
    exit();
}

// Here, you would normally store the order in the database
// Example: Save order to database
// saveOrderToDatabase($orderDetails);

// Clear the cart after order completion
unset($_SESSION['cart']);
unset($_SESSION['order_details']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Completed</title>
</head>
<body>
    <h1>Thank You for Your Order!</h1>
    <p>Your order has been successfully placed. We will process it shortly.</p>
    <a href="menu.php" class="btn">Return to Home</a>
</body>
</html>

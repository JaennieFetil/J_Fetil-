<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user_info_id']) || !isset($_SESSION['cart'])) {
    header('location: cart.php?error=noItems');
    exit();
}

$user_id = $_SESSION['user_info_id'];

// Collect additional details from a form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];

    if (empty($name) || empty($address) || empty($payment_method)) {
        header('location: cart.php?error=missingDetails');
        exit();
    }

    try {
        // Calculate total amount
        $total_amount = 0;
        foreach ($_SESSION['cart'] as $cart_item) {
            $total_amount += $cart_item['item_price'] * $cart_item['item_quantity'];
        }

        // Insert order into the `orders` table
        $stmt = $conn->prepare("
            INSERT INTO orders (user_id, total_amount, name, address, payment_method, created_at)
            VALUES (:user_id, :total_amount, :name, :address, :payment_method, NOW())
        ");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':total_amount', $total_amount);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':payment_method', $payment_method);
        $stmt->execute();

        // Get the last inserted order ID
        $order_id = $conn->lastInsertId();

        // Insert items into the `order_items` table
        $order_item_stmt = $conn->prepare("
            INSERT INTO order_items (order_id, item_id, quantity, price)
            VALUES (:order_id, :item_id, :quantity, :price)
        ");

        foreach ($_SESSION['cart'] as $cart_item) {
            $order_item_stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
            $order_item_stmt->bindParam(':item_id', $cart_item['item_id'], PDO::PARAM_INT);
            $order_item_stmt->bindParam(':quantity', $cart_item['item_quantity'], PDO::PARAM_INT);
            $order_item_stmt->bindParam(':price', $cart_item['item_price']);
            $order_item_stmt->execute();
        }

        // Clear the cart after order submission
        unset($_SESSION['cart']);
        header('location: order_summary.php?success=orderPlaced');
        exit();
    } catch (PDOException $e) {
        echo "Order submission failed: " . $e->getMessage();
        exit();
    }
}
?>

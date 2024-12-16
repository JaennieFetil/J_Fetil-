<?php
session_start();
include 'db_config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_info_fullname'])) {
    header('location: loginform.php?error=pleaseLogIn');
    exit();
}

// Get the logged-in user's name from the session
$username = $_SESSION['user_info_fullname'];

try {
    // Fetch orders only for the logged-in user based on their full name
    $stmt = $conn->prepare("SELECT o.* FROM orders o 
                            JOIN user_info u ON o.user_id = u.user_info_id 
                            WHERE u.fullname = :username 
                            ORDER BY o.created_at DESC");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #faf3e0; /* Coffee-themed background */
            color: #4e342e; /* Coffee brown color */
        }
        header {
            background-color: #6d4c41; /* Dark coffee theme */
            color: #fff;
            text-align: center;
            padding: 15px 0;
        }
        header h1 {
            margin: 0;
            font-size: 24px;
        }
        .orders-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .order-card {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            background-color: #f7f0e6;
        }
        .order-card h3 {
            margin: 0 0 10px;
            color: #6d4c41;
        }
        .order-details {
            font-size: 14px;
            line-height: 1.6;
            color: #5d4037;
        }
        .order-status {
            font-weight: bold;
            color: #388e3c; /* Green for confirmed */
        }
        .order-status.pending {
            color: #fbc02d; /* Yellow for pending */
        }
        .order-status.delivered {
            color: #d32f2f; /* Red for delivered */
        }
        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #795548;
        }
        .header-actions {
            position: left;
            top: 10px;
            right: 10px;
            margin-left: 20px;
            margin-bottom:10px;
            display: flex;
            gap: 10px;
        }
        .btn {
            text-decoration: none;
            padding: 10px 15px;
            color: white;
            background-color: #5c4032;
            border-radius: 5px;
            font-weight: bold;
            font-size: 14px;
        }
        .btn:hover {
            background-color: #5c4032;
        }
    </style>
</head>
<body>

<header>
    <h1>Welcome, <?= htmlspecialchars($username) ?>!</h1>
</header>

<h2 style="text-align: center; margin-top: 10px;">My Orders</h2>

<div class="header-actions">
    <a href="menu.php" class="btn">Back</a>
</div>

<div class="orders-container">
    <?php if (!empty($orders)): ?>
        <?php foreach ($orders as $order): ?>
            <div class="order-card">
                <h3>Order ID: <?= htmlspecialchars($order['order_id']) ?></h3>

                <?php
                // Fetch the item name(s) using the item_id(s) from the order_items table
                $item_names = [];
                $item_query = "SELECT m.item_name 
                               FROM menu_items m
                               JOIN order_items oi ON m.item_id = oi.item_id
                               WHERE oi.order_id = :order_id";
                $stmt_items = $conn->prepare($item_query);
                $stmt_items->bindParam(':order_id', $order['order_id'], PDO::PARAM_INT);
                $stmt_items->execute();
                $items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);

                foreach ($items as $item) {
                    $item_names[] = $item['item_name'];
                }
                ?>

                <p><strong>Item Name(s):</strong> <?= htmlspecialchars(implode(', ', $item_names)) ?></p>
                <p><strong>Customer Name:</strong> <?= htmlspecialchars($order['name']) ?></p>
                <p><strong>Status:</strong> <span class="order-status <?= strtolower($order['status']) ?>"><?= htmlspecialchars($order['status']) ?></span></p>
                <p><strong>Total Amount:</strong> Php <?= number_format($order['total_amount'], 2) ?></p>
                <p><strong>Order Date:</strong> <?= date('F j, Y, g:i a', strtotime($order['created_at'])) ?></p>
                <p><strong>Payment Method:</strong> <?= htmlspecialchars($order['payment_method']) ?></p>
                <p><strong>Shipping Address:</strong> <?= htmlspecialchars($order['address']) ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align: center; color: #795548;">No orders found for this user.</p>
    <?php endif; ?>
</div>

<footer>
    <p>Tiny Coders</p>
</footer>

</body>
</html>

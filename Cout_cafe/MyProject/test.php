<?php
session_start();
include 'db_config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_info_id'])) {
    header('Location: loginform.php?error=pleaseLogIn');
    exit();
}

$user_id = $_SESSION['user_info_id'];

// Fetch cart items from the database
$cartItems = [];
$stmt = $conn->prepare("SELECT * FROM cart_items WHERE user_id = ?");
$stmt->execute([$user_id]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Add items to the cart
if (isset($_POST['addToCart'])) {
    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];
    $item_quantity = $_POST['item_quantity'];
    $item_image = $_POST['item_image'];

    // Check if the item already exists in the cart
    $stmt = $conn->prepare("SELECT * FROM cart_items WHERE user_id = ? AND item_id = ?");
    $stmt->execute([$user_id, $item_id]);
    $existingItem = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingItem) {
        // Update quantity if item exists
        $stmt = $conn->prepare("UPDATE cart_items SET item_quantity = item_quantity + ? WHERE user_id = ? AND item_id = ?");
        $stmt->execute([$item_quantity, $user_id, $item_id]);
    } else {
        // Insert new item into the cart
        $stmt = $conn->prepare("INSERT INTO cart_items (user_id, item_id, item_name, item_price, item_quantity, item_image) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $item_id, $item_name, $item_price, $item_quantity, $item_image]);
    }

    // Reload the page
    header('Location: cart.php');
    exit();
}

// Remove an item from the cart
if (isset($_POST['removeFromCart'])) {
    $cart_item_id = $_POST['cart_item_id'];
    $stmt = $conn->prepare("DELETE FROM cart_items WHERE cart_item_id = ?");
    $stmt->execute([$cart_item_id]);

    // Reload the page
    header('Location: cart.php');
    exit();
}

// Place an order
if (isset($_POST['placeOrder'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];

    // Calculate total amount
    $total_amount = 0;
    foreach ($cartItems as $item) {
        $total_amount += $item['item_price'] * $item['item_quantity'];
    }

    try {
        // Begin transaction
        $conn->beginTransaction();

        // Insert order details
        $stmt = $conn->prepare("INSERT INTO orders (user_id, total_amount, name, address, payment_method) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $total_amount, $name, $address, $payment_method]);
        $order_id = $conn->lastInsertId();

        // Insert items into order_items table
        foreach ($cartItems as $item) {
            $stmt = $conn->prepare("INSERT INTO order_items (order_id, item_id, item_name, item_price, item_quantity) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$order_id, $item['item_id'], $item['item_name'], $item['item_price'], $item['item_quantity']]);
        }

        // Clear cart for the user
        $stmt = $conn->prepare("DELETE FROM cart_items WHERE user_id = ?");
        $stmt->execute([$user_id]);

        // Commit transaction
        $conn->commit();

        // Redirect to order summary
        header("Location: order_summary.php?order_id=" . $order_id);
        exit();

    } catch (PDOException $e) {
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <style>
        /* Add your styles here */
    </style>
</head>
<body>
    <h1>Your Shopping Cart</h1>
    <?php if (!empty($cartItems)): ?>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0;
                foreach ($cartItems as $item): 
                    $subtotal = $item['item_price'] * $item['item_quantity'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><img src="images/<?= htmlspecialchars($item['item_image']) ?>" alt="<?= htmlspecialchars($item['item_name']) ?>" width="50"></td>
                        <td><?= htmlspecialchars($item['item_name']) ?></td>
                        <td>Php<?= number_format($item['item_price'], 2) ?></td>
                        <td><?= htmlspecialchars($item['item_quantity']) ?></td>
                        <td>Php<?= number_format($subtotal, 2) ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="cart_item_id" value="<?= $item['cart_item_id'] ?>">
                                <button type="submit" name="removeFromCart">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p class="cart-summary">Total: Php<?= number_format($total, 2) ?></p>

        <!-- Order Form -->
        <form method="POST">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required>
            
            <label for="address">Address</label>
            <textarea id="address" name="address" required></textarea>
  
            <label for="payment_method">Payment Method</label>
            <select id="payment_method" name="payment_method" required>
                <option value="Cash">Cash</option>
                <option value="Credit Card">Credit Card</option>
                <option value="Mobile Payment">Mobile Payment</option>
            </select>

            <button type="submit" name="placeOrder">Place Order</button>
        </form>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</body>
</html>

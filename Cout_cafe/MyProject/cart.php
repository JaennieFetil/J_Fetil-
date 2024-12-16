<?php
session_start();

try {
    $conn = new PDO("mysql:host=localhost;dbname=Sample", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$cartItems = $_SESSION['cart'] ?? [];

if (!isset($_SESSION['user_info_id'])) {
    die("Error: User is not logged in.");
}
$user_id = $_SESSION['user_info_id'];

$name = "";
$address = "";
$payment_method = "Cash on Delivery"; // Default value

// Fetch user details from the users table
$sql = "SELECT name, address FROM orders WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $name = $row['name'];
    $address = $row['address'];
} else {
    // Handle case where no data is found
    $name = "Unknown User";
    $address = "No Address Found";
}

// Set payment method explicitly
$payment_method = "Cash on Delivery";

// Handle item deletion from cart
if (isset($_POST['delete_item'])) {
    $item_id_to_delete = $_POST['item_id'];

    // Remove the item from the cart
    foreach ($cartItems as $key => $item) {
        if ($item['item_id'] == $item_id_to_delete) {
            unset($cartItems[$key]); // Remove item from cart
            $_SESSION['cart'] = $cartItems; // Update session cart
            break;
        }
    }

    // Redirect back to the cart page
    header("Location: cart.php");
    exit();
}

if (isset($_POST['placeOrder'])) {
    // Collect the user information
    $name = $_POST['name'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];

    // Save the order details into the session or a database (for simplicity, using session here)
    $_SESSION['order_details'] = [
        'name' => $name,
        'address' => $address,
        'payment_method' => $payment_method,
        'cart_items' => $cartItems
    ];

    // Redirect to the order summary page
    header("Location: order_summary.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f1e1;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #6f4f28;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #6f4f28;
            color: white;
        }

        .cart-summary {
            font-size: 18px;
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
        }

        .btn {
            background-color: #6f4f28;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #5c4032;
        }

        .form-container {
        width: 100%;
        max-width: 500px;
        margin: 50px auto;
        padding: 50px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-container form {
        display: flex;
        flex-direction: column;
    }

    .form-container label {
        margin-bottom: 8px;
        font-size: 14px;
        color: #333;
        font-weight: bold;
    }

    .form-container input,
    .form-container textarea {
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        width: 100%;
    }

    .form-container textarea {
        resize: none;
        height: 100px;
    }

    .form-container input[readonly] {
        background-color: #e9ecef;
        cursor: not-allowed;
    }

    .form-container .btn {
        background-color: #28a745;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }

    .form-container .btn:hover {
        background-color: #218838;
    }
    .header-actions {
            position: absolute;
            top: 20px;
            right: 20px;
            margin-bottom:20px;
            display: flex;
            gap: 10px;
        }
        .btn {
            text-decoration: none;
            padding: 10px 15px;
            color: white;
            background-color: #6f4f28;
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
<div class="header-actions">
    <a href="menu.php" class="btn">Back</a>
</div>
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
                    <th>Action</th> <!-- Added Action column for the delete button -->
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
                            <!-- Form to handle item deletion -->
                            <form action="cart.php" method="POST">
                                <input type="hidden" name="item_id" value="<?= $item['item_id'] ?>">
                                <button type="submit" name="delete_item" class="btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p class="cart-summary">Total: Php<?= number_format($total, 2) ?></p>

        <!-- Order Form -->
        <div class="form-container">
    <form action="submit_order.php" method="POST">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" placeholder="Enter your full name" required>

        <label for="address">Address</label>
        <textarea id="address" name="address" placeholder="Enter your address" required></textarea>

        <label for="payment_method">Payment Method</label>
        <input type="text" id="payment_method" name="payment_method" value="<?php echo htmlspecialchars($payment_method); ?>" readonly>

        <button type="submit" class="btn">Submit Order</button>
    </form>
</div>

        </div>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</body>
</html>
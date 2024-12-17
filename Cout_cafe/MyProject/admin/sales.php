<?php
include '../db_config.php'; // Database connection

// Fetch data for total sales per user
$sql_users = "SELECT user_id, SUM(total_amount) as total_sales FROM orders GROUP BY user_id ORDER BY total_sales DESC";
$stmt_users = $conn->query($sql_users);
$users_sales = $stmt_users->fetchAll(PDO::FETCH_ASSOC);

// Fetch data for total sales per date
$sql_dates = "SELECT DATE(created_at) as sale_date, SUM(total_amount) as total_sales FROM orders GROUP BY sale_date ORDER BY sale_date DESC";
$stmt_dates = $conn->query($sql_dates);
$date_sales = $stmt_dates->fetchAll(PDO::FETCH_ASSOC);

// Fetch data for total sales per order
$sql_orders = "SELECT order_id, total_amount FROM orders ORDER BY order_id DESC";
$stmt_orders = $conn->query($sql_orders);
$order_sales = $stmt_orders->fetchAll(PDO::FETCH_ASSOC);

// Fetch data for total sales per item (assuming item quantities are available)
// Example assumes an `order_items` table with columns: item_id, order_id, quantity, price
$sql_items = "SELECT item_id, SUM(quantity * price) as total_sales FROM order_items GROUP BY item_id ORDER BY total_sales DESC";
$stmt_items = $conn->query($sql_items);
$item_sales = $stmt_items->fetchAll(PDO::FETCH_ASSOC);

// Fetch total overall sales
$sql_total_sales = "SELECT SUM(total_amount) as total_sales FROM orders";
$stmt_total_sales = $conn->query($sql_total_sales);
$total_sales = $stmt_total_sales->fetch(PDO::FETCH_ASSOC)['total_sales'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Sales Dashboard - Cout Cafe</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('images/coffee_background.jpg'); /* Replace with your image path */
            background-size: cover;
            background-attachment: fixed;
            color: #fff;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            color: #c69c6d;
            margin-bottom: 30px;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            color: #fff;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #6f4e37;
            color: #fff;
        }

        .btn {
            background-color: #c69c6d;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #a6825c;
        }
        .btn-back {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #6b4e2e;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
        }

        .btn-back:hover {
            background-color: #4e3921;
        }

    </style>
</head>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Sales Dashboard - Cout Cafe</title>
    <style>
        /* Existing styles retained */
    </style>
</head>
<body>
    <h1>Total Sales Dashboard - Cout Cafe</h1>
    <a href="index.php" class="btn-back">Back to Dashboard</a>

    <!-- Total Overall Sales -->
    <div class="container">
        <h2>Total Overall Sales</h2>
        <p style="font-size: 1.5rem; font-weight: bold; color: #c69c6d;">
            &#8369;<?= number_format($total_sales, 2); ?>
        </p>
    </div>

    <div class="container">
        <h2>Total Sales Per User</h2>
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Total Sales</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users_sales as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['user_id']); ?></td>
                        <td>&#8369;<?= number_format($user['total_sales'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="container">
        <h2>Total Sales Per Date</h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Total Sales</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($date_sales as $date): ?>
                    <tr>
                        <td><?= htmlspecialchars($date['sale_date']); ?></td>
                        <td>&#8369;<?= number_format($date['total_sales'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="container">
        <h2>Total Sales Per Order</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_sales as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['order_id']); ?></td>
                        <td>&#8369;<?= number_format($order['total_amount'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>


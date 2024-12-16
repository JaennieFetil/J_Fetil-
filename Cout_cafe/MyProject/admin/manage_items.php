<?php
// Include database connection
include '../db_config.php'; // Ensure this contains your PDO connection as $conn

// Handle status update request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    // Update the order status in the database
    $sql = "UPDATE orders SET status = :status WHERE order_id = :order_id";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute([':status' => $status, ':order_id' => $order_id]);
        echo json_encode(['success' => true, 'message' => 'Order status updated successfully!']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Failed to update order status: ' . $e->getMessage()]);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders - Coffee Shop</title>
    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f5f0;
            color: #4a3c31;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #6b4e2e;
        }

        /* Search Bar Styling */
        .search-bar {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .search-bar input {
            padding: 10px;
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-right: 10px;
        }

        .search-bar button {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #6b4e2e;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #4e3921;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #6b4e2e;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2ebe1;
        }

        tr:hover {
            background-color: #e8d9c1;
        }

        select {
            padding: 5px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        /* Button Styling */
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

        /* Footer Styling */
        footer {
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
            font-size: 14px;
            color: #6b4e2e;
        }
    </style>
    <script>
        function updateStatus(orderId, selectElement) {
            const status = selectElement.value;
            const formData = new FormData();
            formData.append('order_id', orderId);
            formData.append('status', status);
            formData.append('update_status', true);

            fetch('manage_items.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the status.');
            });
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Manage Orders</h1>
        <a href="index.php" class="btn-back">Back to Dashboard</a>

        <!-- Search Bar -->
        <div class="search-bar">
            <form method="GET">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Search by User ID" 
                    value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit">Search</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Item Name</th>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Total Amount</th>
                    <th>Address</th>
                    <th>Payment Method</th>
                    <th>Created At</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch orders from the database based only on user_id search
                $sql = "SELECT * FROM orders";
                if (isset($_GET['search']) && !empty($_GET['search'])) {
                    $search = htmlspecialchars($_GET['search']);
                    // Filter only by user_id
                    $sql .= " WHERE user_id LIKE :search";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([':search' => "%$search%"]);
                } else {
                    $stmt = $conn->query($sql);
                }

                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        // Display order details
                        echo "<tr>
                                <td>{$row['order_id']}</td>
                                <td>{$row['item_Name']}</td> <!-- Ensure this is the correct field -->
                                <td>{$row['user_id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['total_amount']}</td>
                                <td>{$row['address']}</td>
                                <td>{$row['payment_method']}</td>
                                <td>{$row['created_at']}</td>
                                <td>
                                    <select onchange=\"updateStatus('{$row['order_id']}', this)\">
                                        <option value='Pending'" . ($row['status'] == 'Pending' ? ' selected' : '') . ">Pending</option>
                                        <option value='Confirmed'" . ($row['status'] == 'Confirmed' ? ' selected' : '') . ">Confirmed</option>
                                        <option value='Delivered'" . ($row['status'] == 'Delivered' ? ' selected' : '') . ">Delivered</option>
                                    </select>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No orders found</td></tr>";
                }                
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
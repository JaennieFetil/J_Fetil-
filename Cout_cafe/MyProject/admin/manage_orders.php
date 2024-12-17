<?php
include '../db_config.php';  // Database connection

// Handle Add New Item
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_item'])) {
    $item_name = $_POST['item_name'];
    $item_category = $_POST['item_category'];
    $item_desc = $_POST['item_desc'];
    $item_price = $_POST['item_price'];
    $item_image = $_FILES['item_image']['name'];
    $target = "images/" . basename($item_image);

    // Upload the image
    if (move_uploaded_file($_FILES['item_image']['tmp_name'], $target)) {
        $sql = "INSERT INTO menu_items (item_name, item_category, item_desc, item_price, item_image) 
                VALUES (:item_name, :item_category, :item_desc, :item_price, :item_image)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':item_name' => $item_name,
            ':item_category' => $item_category,
            ':item_desc' => $item_desc,
            ':item_price' => $item_price,
            ':item_image' => $item_image
        ]);
        echo "New item added successfully";
    } else {
        echo "Failed to upload image.";
    }
}

// Handle Update Status
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['item_id']) && isset($_GET['status'])) {
    $item_id = $_GET['item_id'];
    $status = $_GET['status'];

    // Update status in the database
    $sql = "UPDATE menu_items SET status = :status WHERE item_id = :item_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':status' => $status,
        ':item_id' => $item_id
    ]);

    
}


// Handle Update Item
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_item'])) {
    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $item_category = $_POST['item_category'];
    $item_desc = $_POST['item_desc'];
    $item_price = $_POST['item_price'];

    if ($_FILES['item_image']['name']) {
        $item_image = $_FILES['item_image']['name'];
        $target = "images/" . basename($item_image);
        move_uploaded_file($_FILES['item_image']['tmp_name'], $target);
        $sql = "UPDATE menu_items 
                SET item_name = :item_name, item_category = :item_category, item_desc = :item_desc, 
                    item_price = :item_price, item_image = :item_image 
                WHERE item_id = :item_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':item_name' => $item_name,
            ':item_category' => $item_category,
            ':item_desc' => $item_desc,
            ':item_price' => $item_price,
            ':item_image' => $item_image,
            ':item_id' => $item_id
        ]);
    } else {
        $sql = "UPDATE menu_items 
                SET item_name = :item_name, item_category = :item_category, item_desc = :item_desc, item_price = :item_price
                WHERE item_id = :item_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':item_name' => $item_name,
            ':item_category' => $item_category,
            ':item_desc' => $item_desc,
            ':item_price' => $item_price,
            ':item_id' => $item_id
        ]);
    }
    header("Location: manage_orders.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Coffee Shop</title>
    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f5f0;
            color: #4a3c31;
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
            color: #6b4e2e;
            margin-bottom: 20px;
        }

        h3 {
            color: #6b4e2e;
            margin-top: 30px;
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
            text-align: center;
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

        img {
            max-width: 100px;
            border-radius: 8px;
        }

        /* Button Styling */
        button, .btn-back, .delete-btn {
            padding: 10px 15px;
            font-size: 14px;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }

        button {
            background-color: #6b4e2e;
        }

        button:hover {
            background-color: #4e3921;
        }

        .btn-back {
            background-color: #6b4e2e;
            margin-bottom: 20px;
            display: inline-block;
        }

        .btn-back:hover {
            background-color: #4e3921;
        }

        
        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
        }

        .close {
            color: #6b4e2e;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
        }

        /* Form Styling */
        input[type="text"], input[type="number"], textarea, input[type="file"] {
            width: calc(100% - 22px);
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        button[type="submit"] {
            margin-top: 10px;
            background-color: #6b4e2e;
        }
        html {
            scroll-behavior: smooth;
        }
        .content {
            height: 1500px; /* This is just to make the page long enough to scroll */
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Items</h1>
        <a href="index.php" class="btn-back">Back</a>
        <a href="#haha" class="btn-back">Add Item</a>

        <!-- Search Bar -->
        <form method="GET" style="margin-bottom: 20px;">
            <input type="text" name="search" placeholder="Search by name or category" 
                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" 
                style="padding: 10px; width: 300px; border: 1px solid #ddd; border-radius: 4px;">
            <button type="submit" style="padding: 10px; background-color: #6b4e2e; color: #fff; border: none; border-radius: 4px; cursor: pointer;">
                Search
            </button>
        </form>

        <!-- Displaying Menu Items -->
        <!-- Displaying Menu Items -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Price</th>
            <th>Image</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $sql = "SELECT * FROM menu_items";
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = htmlspecialchars($_GET['search']);
        $sql .= " WHERE item_name LIKE :search OR item_category LIKE :search";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':search' => "%$search%"]);
    } else {
        $stmt = $conn->query($sql);
    }

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$row['item_id']}</td>
                    <td>{$row['item_name']}</td>
                    <td>{$row['item_category']}</td>
                    <td>{$row['item_desc']}</td>
                    <td>{$row['item_price']}</td>
                    <td><img src='images/{$row['item_image']}'></td>
                    <td>{$row['status']}</td>
                    <td>
                        <button onclick=\"openUpdateModal(
                            '{$row['item_id']}', 
                            '{$row['item_name']}', 
                            '{$row['item_category']}', 
                            '{$row['item_desc']}', 
                            '{$row['item_price']}'
                        )\">Update</button>
                        
                        <!-- Status Dropdown -->
                        <form action='' method='get'>
                            <select name='status'>
                                <option value='Active' ".($row['status'] == 'Active' ? 'selected' : '').">Active</option>
                                <option value='Inactive' ".($row['status'] == 'Inactive' ? 'selected' : '').">Inactive</option>
                            </select>
                            <input type='hidden' name='item_id' value='{$row['item_id']}'>
                            <button type='submit' class='status-btn'>Change Status</button>
                        </form>
                    </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No items found</td></tr>";
    }
    ?>
    </tbody>
</table>
 

        <!-- Add New Item Form -->
        <h3 id="haha">Add New Item</h3>
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="item_name" placeholder="Item Name" required>
              <select name="item_category" required>
                 <option value="" disabled selected>Select Category</option>
                  <option value="Hot Beverages">Hot Beverages</option>
                  <option value="Cold Beverages">Cold Beverages</option>
                  <option value="Snacks & Pastries">Snacks & Pastries</option>
                 <option value="Tea & Non-Coffee Drinks">Tea & Non-Coffee Drinks</option>
                 <option value="Specialty Drinks">Specialty Drinks</option>
                </select>
            <textarea name="item_desc" placeholder="Item Description" rows="4" required></textarea>
            <input type="number" name="item_price" placeholder="Item Price" required>
            <input type="file" name="item_image" required>
            <button type="submit" name="add_item">Add Item</button>
        </form>
    </div>

    <!-- Update Item Modal -->
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3>Update Item</h3>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" id="item_id" name="item_id">
                <input type="text" id="item_name" name="item_name" placeholder="Item Name" required>
                <input type="text" id="item_category" name="item_category" placeholder="Item Category" required>
                <textarea id="item_desc" name="item_desc" placeholder="Item Description" rows="4" required></textarea>
                <input type="number" id="item_price" name="item_price" placeholder="Item Price" required>
                <input type="file" name="item_image">
                <button type="submit" name="update_item">Update Item</button>
            </form>
        </div>
    </div>

    <script>
        function openUpdateModal(itemId, name, category, desc, price) {
            document.getElementById('updateModal').style.display = 'block';
            document.getElementById('item_id').value = itemId;
            document.getElementById('item_name').value = name;
            document.getElementById('item_category').value = category;
            document.getElementById('item_desc').value = desc;
            document.getElementById('item_price').value = price;
        }

        function closeModal() {
            document.getElementById('updateModal').style.display = 'none';
        }
    </script>
</body>
</html>
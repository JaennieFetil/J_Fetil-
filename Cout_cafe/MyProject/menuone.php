<?php
session_start();
include 'db_config.php';

try {
    $stmt = $conn->query("SELECT DISTINCT item_category FROM menu_items");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $itemsByCategory = [];
    foreach ($categories as $category) {
        $stmt = $conn->prepare("SELECT * FROM menu_items WHERE item_category = :category ORDER BY item_name");
        $stmt->bindParam(':category', $category['item_category']);
        $stmt->execute();
        $itemsByCategory[$category['item_category']] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}



include 'db_config.php';

$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';

try {
    // If there's a search query, fetch matching items
    if (!empty($searchQuery)) {
        $stmt = $conn->prepare("
            SELECT * FROM menu_items 
            WHERE item_name LIKE :search OR item_desc LIKE :search 
            ORDER BY item_name
        ");
        $searchParam = '%' . $searchQuery . '%';
        $stmt->bindParam(':search', $searchParam);
        $stmt->execute();
        $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Fetch items grouped by categories when no search query
        $stmt = $conn->query("SELECT DISTINCT item_category FROM menu_items");
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $itemsByCategory = [];
        foreach ($categories as $category) {
            $stmt = $conn->prepare("SELECT * FROM menu_items WHERE item_category = :category ORDER BY item_name");
            $stmt->bindParam(':category', $category['item_category']);
            $stmt->execute();
            $itemsByCategory[$category['item_category']] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
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
    <title>Coffee Shop Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f1e1; /* Light beige background for a warm feel */
        }
        h1 {
            text-align: center;
            font-family: 'Luminari', sans-serif;
            color: #6f4f28; /* Coffee brown color */
            padding: 20px;
            background-color: #f0e6d6; /* Light cream background */
            margin: 0;
        }
        .actions {
            text-align: right;
            padding: 20px;
        }
        .btn {
            text-decoration: none;
            padding: 10px 15px;
            color: white;
            background-color: #6f4f28; /* Dark coffee brown */
            border-radius: 5px;
            margin: 5px;
            font-weight: bold;
        }
        .btn:hover {
            background-color: #5c4032; /* Darker brown for hover effect */
        }
        /* Grid Layout for Items */
        .category-section {
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #fff7e6;
            border-radius: 8px;
        }
        .category-title {
            font-size: 24px;
            color: #6f4f28;
            text-align: center;
            font-weight: bold;
            padding: 10px;
            background-color: #f0e6d6; /* Cream background for category title */
            border-radius: 5px;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .grid-item {
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fff7e6; /* Light coffee cream background */
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: box-shadow 0.3s ease;
        }
        .grid-item:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        .grid-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .item-name {
            font-weight: bold;
            font-size: 16px;
            color: #6f4f28; /* Coffee brown for item name */
            margin-bottom: 10px;
        }
        .item-price {
            color: #9e7b44; /* Muted golden brown for price */
            font-size: 18px;
            margin-bottom: 15px;
        }
        .btn-add-to-cart {
            text-decoration: none;
            padding: 10px 15px;
            background-color: #6f4f28; /* Dark coffee brown for button */
            color: white;
            border-radius: 5px;
            font-size: 14px;
            margin-top: 10px;
            display: inline-block;
        }
        .btn-add-to-cart:hover {
            background-color: #5c4032; /* Darker brown for hover effect */
        }
        .quantity-control {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            padding: 10px 0;
        }
        .quantity-btn {
            padding: 10px 15px;
            background-color: #6d4c41;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .quantity-btn:hover {
            background-color: #5a3a2d;
        }
        .quantity-input {
            width: 60px;
            height: 40px;
            text-align: center;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f4f4f4;
        }
        .quantity-control:focus-within .quantity-input {
            border-color: #6d4c41;
        }
        .header-actions {
            position: absolute;
            top: 20px;
            right: 20px;
            margin-bottom:20px;
            display: flex;
            gap: 10px;
            margin-top: 3%;
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
        .search-bar {
            margin: 20px auto;
            text-align: center;
        }
        .search-input {
            width: 60%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .search-btn {
            padding: 10px 20px;
            background-color: #6f4f28;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .search-btn:hover {
            background-color: #5c4032;
        }
    </style>
</head>
<body>

<?php

try {
    $stmt = $conn->query("SELECT DISTINCT item_category FROM menu_items");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $itemsByCategory = [];
    foreach ($categories as $category) {
        $stmt = $conn->prepare("SELECT * FROM menu_items WHERE item_category = :category ORDER BY item_name");
        $stmt->bindParam(':category', $category['item_category']);
        $stmt->execute();
        $itemsByCategory[$category['item_category']] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
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
    <title>Coffee Shop Menu</title>
    <style>
        /* Existing styles here */
    </style>
</head>
<div class="header-actions">
    <a href="lp.php" class="btn">Back to Homepage</a>
    <a href="loginform.php" class="btn">Login</a>
</div>
<div class="search-bar">
        <form action="" method="get">
            <input type="text" name="search" class="search-input" placeholder="Search items..." value="<?= htmlspecialchars($searchQuery) ?>">
            <button type="submit" class="search-btn">Search</button>
        </form>
    </div>

    <!-- Display Search Results -->
    <?php if (!empty($searchQuery)): ?>
        <div class="category-section">
            <div class="category-title">Search Results for "<?= htmlspecialchars($searchQuery) ?>"</div>
            <div class="grid-container">
                <?php if (!empty($searchResults)): ?>
                    <?php foreach ($searchResults as $item): ?>
                        <div class="grid-item" title="<?= htmlspecialchars($item['item_desc']) ?>">
                            <img src="images/<?= htmlspecialchars($item['item_image']) ?>" alt="<?= htmlspecialchars($item['item_name']) ?>">
                            <div class="item-name"><?= htmlspecialchars($item['item_name']) ?></div>
                            <div class="item-price">Php <?= number_format($item['item_price'], 2) ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="text-align: center; color: #6f4f28;">No items found.</p>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <!-- Display Categorized Menu -->
        <?php foreach ($itemsByCategory as $category_name => $menu_items): ?>
            <div class="category-section">
                <div class="category-title"><?= htmlspecialchars($category_name) ?></div>
                <div class="grid-container">
                    <?php foreach ($menu_items as $item): ?>
                        <div class="grid-item" title="<?= htmlspecialchars($item['item_desc']) ?>">
                            <img src="images/<?= htmlspecialchars($item['item_image']) ?>" alt="<?= htmlspecialchars($item['item_name']) ?>">
                            <div class="item-name"><?= htmlspecialchars($item['item_name']) ?></div>
                            <div class="item-price">Php <?= number_format($item['item_price'], 2) ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
<body>
</script>

</body>
</html>
<?php
include 'db_config.php';

// Fetch menu items from the database
try {
    $stmt = $conn->query("SELECT * FROM menu_items ORDER BY item_category, item_name");
    $menu_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            margin: 20px;
        }
        .category {
            margin-top: 20px;
            font-size: 20px;
            font-weight: bold;
        }
        .item {
            margin: 5px 0;
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #ddd;
            padding: 5px 0;
        }
        .item-name {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Coffee Shop Menu</h1>

    <?php
    $current_category = '';
    foreach ($menu_items as $item):
        // Display category heading if it changes
        if ($current_category !== $item['item_category']):
            $current_category = $item['item_category'];
            echo "<div class='category'>" . htmlspecialchars($current_category) . "</div>";
        endif;
    ?>

    <div class="item">
        <span class="item-name"><?= htmlspecialchars($item['item_name']) ?></span>
        <span class="item-price">$<?= number_format($item['item_price'], 2) ?></span>
    </div>

    <?php endforeach; ?>
</body>
</html>

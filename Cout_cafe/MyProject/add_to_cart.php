<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['item_id'], $data['quantity'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
        exit;
    }

    $item_id = (int)$data['item_id'];
    $quantity = (int)$data['quantity'];

    include 'db_config.php';
    $stmt = $conn->prepare("SELECT * FROM menu_items WHERE item_id = :item_id");
    $stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
    $stmt->execute();
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($item) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$item_id])) {
            $_SESSION['cart'][$item_id]['item_quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$item_id] = [
                'item_id' => $item['item_id'],
                'item_name' => $item['item_name'],
                'item_price' => $item['item_price'],
                'item_image' => $item['item_image'],
                'item_quantity' => $quantity,
            ];
        }

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Item not found']);
    }
}
?>

<?php
session_start();

if (!isset($_GET['success'])) {
    header('location: menu.php');
    exit();
}
?>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f5f5dc; /* Light coffee shop theme */
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .order-summary {
        text-align: center;
        background-color: #fff8e1; /* Soft cream color */
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        max-width: 500px;
        width: 100%;
    }

    .order-summary h1 {
        font-size: 24px;
        color: #5d4037; /* Coffee brown color */
        margin-bottom: 15px;
    }

    .order-summary p {
        font-size: 16px;
        color: #6d4c41;
        margin-bottom: 20px;
    }

    .order-summary img {
        width: 100px;
        height: 100px;
        margin-bottom: 20px;
    }

    .order-summary .btn {
        display: inline-block;
        background-color: #795548;
        color: #ffffff;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .order-summary .btn:hover {
        background-color: #5d4037;
    }
</style>

<div class="order-summary">
    <img src="images\2364670_00ef6.gif" alt="Coffee and Cat Icon"> <!-- Replace with actual image path -->
    <h1>Order Confirmation</h1>
    <p>Your order has been successfully placed. Thank you for shopping with us!</p>
    <a href="menu.php" class="btn">Return to Menu</a>
</div>

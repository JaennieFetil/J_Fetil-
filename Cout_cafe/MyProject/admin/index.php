<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cout Café - Admin Dashboard</title>
    <style>
       body {
    font-family: 'Georgia', serif;
    margin-top: 20px;
    padding: 0;
    background-image: url('cout.jpg');
    background-color: #f8f2e7; /* Light beige background */
    background-repeat: no-repeat;
    background-size: cover; /* Adjust to fill the screen */
    background-position: center; /* Centers the image */
    color: #4b3832; /* Coffee brown text */
}
html, body {
    margin: 0;
    padding: 0;
    height: 100%; /* Ensures the background spans the entire height */
    overflow: hidden; /* Prevents any unnecessary scrolling */
}
footer {
    position: fixed;
    bottom: 0;
    width: 100%;
}



        h1 {
            text-align: center;
            background-color: #6f4e37; /* Dark coffee brown */
            color: #f8f2e7; /* Light beige text */
            padding: 20px;
            margin: 0;
            font-size: 2.5em;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            background-color: #a67b5b; /* Coffee tan */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #8b5a40; /* Darker coffee tan */
        }

        .ey {
            display: flex;
            justify-content: flex-end;
            padding: 20px;
        }

        .btnn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #d2691e; /* Coffee orange */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btnn:hover {
            background-color: #8b4513; /* SaddleBrown for hover */
        }

        footer {
            text-align: center;
            background-color: #6f4e37;
            color: #f8f2e7;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>Cout Café - Admin Dashboard</h1>

    <div class="actions">
        <a href="manage_items.php" class="btn">Manage Orders</a>
        <a href="manage_orders.php" class="btn">Manage Products</a>
        <a href="sales.php" class="btn">Sales</a>

    </div>

    <div class="ey">
        <a href="../lp.php" class="btnn">Logout</a>
    </div>

  
</body>
</html>

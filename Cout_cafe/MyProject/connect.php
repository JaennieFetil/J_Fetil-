<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "sample";
// Create connection
$conn = mysqli_connect($servername, $username, $password,
$database);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
//echo "CONNECTED SUCCESSFULLY";
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
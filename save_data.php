<?php
session_start();

// Check if the user is logged in as a customer
if (!isset($_SESSION['username']) || $_SESSION['username'] === 'admin') {
  header('Location: index.html');
  exit();
}

// Get form input value
$date = $_POST['date'];
$company = $_POST['company'];
$owner = $_POST['owner'];
$item = $_POST['item'];
$quantity = $_POST['quantity'];
$weight = $_POST['weight'];
$request = $_POST['request'];
$id = $_POST['id'];
$size = $_POST['size'];
$count = $_POST['count'];
$specification = $_POST['specification'];
$checklist = $_POST['checklist'];

// Database connection settings
$host = 'localhost';
$db_name = 'juhosi_db';
$username = 'root';
$password = '';

// Connect to MySQL database
$conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);

// Prepare and execute the query
$stmt = $conn->prepare('INSERT INTO customer_data (username, date, company, owner, item, quantity, weight, request, id, size, count, specification, checklist) VALUES (:username, :date, :company, :owner, :item, :quantity, :weight, :request, :id, :size, :count, :specification, :checklist)');
$stmt->bindParam(':username', $_SESSION['username']);
$stmt->bindParam(':date', $date);
$stmt->bindParam(':company', $company);
$stmt->bindParam(':owner', $owner);
$stmt->bindParam(':item', $item);
$stmt->bindParam(':quantity', $quantity);
$stmt->bindParam(':weight', $weight);
$stmt->bindParam(':request', $request);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':size', $size);
$stmt->bindParam(':count', $count);
$stmt->bindParam(':specification', $specification);
$stmt->bindParam(':checklist', $checklist);
$stmt->execute();
?>

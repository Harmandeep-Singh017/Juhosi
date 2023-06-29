<?php
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
  header('Location: index.html');
  exit();
}

// Database connection settings
$host = 'localhost';
$db_name = 'juhosi_db';
$username = 'root';
$password = '';

// Connect to MySQL database
$conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);

// Fetch data for customer1
$stmt1 = $conn->prepare('SELECT SUM(quantity) AS customer1_quantity, SUM(weight) AS customer1_weight, SUM(count) AS customer1_box_count FROM customer_data WHERE username = "customer1"');
$stmt1->execute();
$customer1_data = $stmt1->fetch(PDO::FETCH_ASSOC);

// Fetch data for customer2
$stmt2 = $conn->prepare('SELECT SUM(quantity) AS customer2_quantity, SUM(weight) AS customer2_weight, SUM(count) AS customer2_box_count FROM customer_data WHERE username = "customer2"');
$stmt2->execute();
$customer2_data = $stmt2->fetch(PDO::FETCH_ASSOC);

// Calculate the total quantity, weight, and box count
$total_quantity = $customer1_data['customer1_quantity'] + $customer2_data['customer2_quantity'];
$total_weight = $customer1_data['customer1_weight'] + $customer2_data['customer2_weight'];
$total_box_count = $customer1_data['customer1_box_count'] + $customer2_data['customer2_box_count'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin View</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }
    
    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #ffffff;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-top: 100px;
    }
    
    .container h2 {
      text-align: center;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    
    th, td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: left;
    }
    
    th {
      background-color: #f2f2f2;
    }
    .form-group a button {
        width: 100%;
      padding: 10px;
      border: none;
      color: #ffffff;
      cursor: pointer;
      border-radius: 3px;
      background-color: red;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <table>
      <tr>
        <th>Item/Customer</th>
        <th>Customer1</th>
        <th>Customer2</th>
        <th>Total</th>
      </tr>
      <tr>
        <td>Quantity</td>
        <td><?php echo $customer1_data['customer1_quantity']; ?></td>
        <td><?php echo $customer2_data['customer2_quantity']; ?></td>
        <td><?php echo $total_quantity; ?></td>
      </tr>
      <tr>
        <td>Weight</td>
        <td><?php echo $customer1_data['customer1_weight']; ?></td>
        <td><?php echo $customer2_data['customer2_weight']; ?></td>
        <td><?php echo $total_weight; ?></td>
      </tr>
      <tr>
        <td>Box Count</td>
        <td><?php echo $customer1_data['customer1_box_count']; ?></td>
        <td><?php echo $customer2_data['customer2_box_count']; ?></td>
        <td><?php echo $total_box_count; ?></td>
      </tr>
    </table>
    <div class="form-group">
        <a href="logout.php">
          <button>Logout</button>
        </a>
      </div>
  </div>
</body>
</html>

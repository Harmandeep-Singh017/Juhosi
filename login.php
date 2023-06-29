<?php
// Database connection settings
$host = 'localhost';
$db_name = 'juhosi_db';
$username = 'root';
$password = '';

// Connect to MySQL database
$conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
//$conn = mysqli_connect("mysql:host=$host;dbname=$db_name", $username, $password);

/*if (!$con) {
  die("connection to this database failed" .
  mysqli_connect_error());
}
echo "Success Connecting database"*/


// Get form input values
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare and execute the query
$stmt = $conn->prepare('SELECT * FROM auth WHERE username = :username AND password = :password');
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->execute();

// Check if login is successful
if ($stmt->rowCount() > 0) {
  session_start();
  $_SESSION['username'] = $username;
  echo 'success';
} else {
  echo 'failure';
}
?>

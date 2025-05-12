<?php
// Include any required libraries or functions here
include 'includes/library.php';
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

// Connect to the database
$pdo = connectDB();


$query= $pdo -> prepare( "SELECT * FROM users WHERE id = user_id");
if ($query->connect_error) {
  die("Connection failed: " . $query->connect_error);
}


$user_id = $_SESSION['user_id'];
$sql = "DELETE FROM `assignment3` WHERE user_id = $user_id";
$conn->query($sql);

// Delete the user's account data
$sql = "DELETE FROM users WHERE id = $user_id";
$pdo->query($sql);

// Close the database connection
$pdo->close();

// Destroy the session and redirect to login
session_destroy();
header("Location: login.php");
exit();
?>

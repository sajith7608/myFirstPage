<?php
// Database connection settings
$servername = "localhost";
$username = "root";  // MySQL username
$password = "";      // MySQL password
$dbname = "dressshop";  // Database name (ensure this matches)

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

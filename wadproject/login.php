<?php
session_start(); // Login success ஆனா session ஆரம்பிக்க

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "dressshop";

// Connect to DB
$conn = new mysqli($servername, $username, $password, $database);

// Connection check
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Login logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST["email"]);
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];

            echo "<p>Login successful! Welcome, " . $user["name"] . ".</p>";
            echo "<a href='Home.html'>Go to Home</a>";
            // Or redirect: header("Location: Home.html");
        } else {
            echo "<p>Invalid password. Please try again.</p>";
        }
    } else {
        echo "<p>User not found. Please register.</p>";
    }
}

$conn->close();
?>

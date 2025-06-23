<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "dressshop"; // இது உங்கள் database-ல இருக்கணும்

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form submit ஆயிருக்கா check பண்ணறது
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $message = mysqli_real_escape_string($conn, $_POST["message"]);

    // Insert query
    $sql = "INSERT INTO overcontact (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Thank you! Your message has been sent.</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}

$conn->close();
?>

<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Clean input data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Password check
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Check if email exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "Email already registered. Please use another email.";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into DB
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "Registration successful! <a href='login.html'>Login here</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

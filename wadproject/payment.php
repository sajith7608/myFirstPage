<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "dressshop";  // correct your DB name if needed

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $card_number = $conn->real_escape_string($_POST['card-number']);
    $expiry = $conn->real_escape_string($_POST['expiry']);
    $cvv = $conn->real_escape_string($_POST['cvv']);

    // Save to DB
    $sql = "INSERT INTO payments (name, card_number, expiry, cvv) 
            VALUES ('$name', '$card_number', '$expiry', '$cvv')";

    if ($conn->query($sql) === TRUE) {
        echo "<h2>Congrats! Payment Successful.</h2><p>Thank you for your purchase. Your order will be processed soon!</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

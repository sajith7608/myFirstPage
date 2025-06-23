<?php
include('db_connection.php');  // path சரி என்பதை உறுதி செய்யவும்

$sql = "SELECT * FROM admi";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "User: " . $row["username"] . "<br>";
    }
} else {
    echo "No users found";
}

$conn->close();
?>

<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db_connection.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Simple validation
    if (!empty($name) && !empty($email)) {
        $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $email);
        $stmt->execute();
        header("Location: manage_users.php");
        exit();
    } else {
        $error = "Please fill all fields";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Add User</title></head>
<body>
<h2>Add New User</h2>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="post" action="">
  Name: <input type="text" name="name" required><br><br>
  Email: <input type="email" name="email" required><br><br>
  <input type="submit" name="submit" value="Add User">
</form>
<br><a href="manage_users.php">Back to User Management</a>
</body>
</html>

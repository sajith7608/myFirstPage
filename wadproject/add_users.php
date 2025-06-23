<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New User</title>
</head>
<body>
    <h2>Add New User</h2>
    <form action="insert_user.php" method="post">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Add User">
    </form>

    <br><a href="manage_users.php">Back to User Management</a>
</body>
</html>

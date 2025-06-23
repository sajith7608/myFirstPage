<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db_connection.php'; // Include DB connection

// Fetch all users from database
$sql = "SELECT * FROM users"; // Make sure your table name is 'users'
$result = $conn->query($sql);

// Error handling
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f6f7;
            padding: 20px;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 0 auto;
            background-color: white;
        }

        th, td {
            padding: 10px 15px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }

        a:hover {
            text-decoration: underline;
        }

        .top-links {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<h2>User Management</h2>

<div class="top-links">
    <a href="add_users.php">Add New User</a> |
    <a href="admin_dashboard.php">Back to Dashboard</a>
</div>

<?php if ($result->num_rows > 0): ?>
    <table>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php while($user = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['id']); ?></td>
            <td><?php echo htmlspecialchars($user['name']); ?></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
            <td>
                <a href="edit_user.php?id=<?php echo urlencode($user['id']); ?>">Edit</a> |
                <a href="delete_user.php?id=<?php echo urlencode($user['id']); ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p style="text-align:center;">No users found.</p>
<?php endif; ?>

</body>
</html>

<?php
session_start();

// Admin login check
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db_connection.php';

// Fetch all products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .top-links {
            text-align: center;
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }

        a:hover {
            text-decoration: underline;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
            background-color: white;
        }

        th, td {
            padding: 10px 15px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #28a745;
            color: white;
        }

        img {
            width: 60px;
            height: auto;
        }
    </style>
</head>
<body>

<h2>Product Management</h2>

<div class="top-links">
    <a href="add_product.php">Add New Product</a> |
    <a href="admin_dashboard.php">Back to Dashboard</a>
</div>

<?php if ($result->num_rows > 0): ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price (LKR)</th>
            <th>Description</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php while($product = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($product['id']); ?></td>
            <td><?php echo htmlspecialchars($product['name']); ?></td>
            <td><?php echo htmlspecialchars($product['price']); ?></td>
            <td><?php echo htmlspecialchars($product['description']); ?></td>
            <td>
                <?php if (!empty($product['image'])): ?>
                    <img src="uploads/<?php echo htmlspecialchars($product['shirt1']); ?>" alt="Product Image">
                <?php else: ?>
                    N/A
                <?php endif; ?>
            </td>
            <td>
                <a href="edit_product.php?id=<?php echo urlencode($product['id']); ?>">Edit</a> |
                <a href="delete_product.php?id=<?php echo urlencode($product['id']); ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p style="text-align:center;">No products found.</p>
<?php endif; ?>

</body>
</html>

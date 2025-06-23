<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db_connection.php'; // Make sure this connects properly to your database

$sql = "SELECT * FROM orders ORDER BY order_date DESC";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef0f2;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
            background-color: #fff;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        .top-links {
            text-align: center;
            margin-bottom: 20px;
        }

        .top-links a {
            text-decoration: none;
            margin: 0 10px;
            color: #007BFF;
        }

        .top-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h2>Order Management</h2>
<div class="top-links">
    <a href="admin_dashboard.php">Back to Dashboard</a>
</div>

<?php if ($result->num_rows > 0): ?>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Order Date</th>
        </tr>
        <?php while($order = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($order['order_id']); ?></td>
            <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
            <td><?php echo htmlspecialchars($order['product_name']); ?></td>
            <td><?php echo htmlspecialchars($order['quantity']); ?></td>
            <td>$<?php echo htmlspecialchars($order['total_price']); ?></td>
            <td><?php echo htmlspecialchars($order['order_date']); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p style="text-align:center;">No orders found.</p>
<?php endif; ?>

</body>
</html>

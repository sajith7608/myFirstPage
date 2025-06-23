<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db_connection.php';

// Fetch all FAQs
$sql = "SELECT * FROM faqs ORDER BY faq_id DESC";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage FAQs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7f8;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            background: #fff;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
            vertical-align: top;
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
            color: #007BFF;
            margin: 0 10px;
        }
        .top-links a:hover {
            text-decoration: underline;
        }
        a.action {
            color: #007BFF;
            margin-right: 10px;
            text-decoration: none;
        }
        a.action:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h2>Manage FAQs</h2>
<div class="top-links">
    <a href="add_faq.php">Add New FAQ</a> |
    <a href="admin_dashboard.php">Back to Dashboard</a>
</div>

<?php if ($result->num_rows > 0): ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Question</th>
            <th>Answer</th>
            <th>Actions</th>
        </tr>
        <?php while ($faq = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($faq['faq_id']); ?></td>
                <td><?php echo nl2br(htmlspecialchars($faq['question'])); ?></td>
                <td><?php echo nl2br(htmlspecialchars($faq['answer'])); ?></td>
                <td>
                    <a class="action" href="edit_faq.php?id=<?php echo urlencode($faq['faq_id']); ?>">Edit</a> |
                    <a class="action" href="delete_faq.php?id=<?php echo urlencode($faq['faq_id']); ?>" onclick="return confirm('Are you sure to delete this FAQ?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p style="text-align:center;">No FAQs found.</p>
<?php endif; ?>

</body>
</html>

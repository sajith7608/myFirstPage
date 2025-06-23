
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
  <title>Admin Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #eef2f3;
      margin: 0;
      padding: 0;
    }

    .dashboard {
      max-width: 600px;
      margin: 50px auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h1 {
      text-align: center;
      color: #333;
    }

    ul {
      list-style-type: none;
      padding: 0;
    }

    li {
      margin: 15px 0;
      text-align: center;
    }

    a {
      display: inline-block;
      padding: 10px 20px;
      background-color: #007BFF;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      transition: 0.3s;
    }

    a:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

<div class="dashboard">
  <h1>Welcome, <?php echo htmlspecialchars($_SESSION['admin'] ?? 'Guest'); ?></h1>

  <ul>
    <li><a href="manage_users.php">Manage Users</a></li>
    <li><a href="manage_products.php">Manage Products</a></li>
    <li><a href="manage_orders.php">Manage Orders</a></li>
    <li><a href="manage_faq.php">Manage FAQs</a></li>
    <li><a href="admin_logout.php">Logout</a></li>
  </ul>
</div>

</body>
</html>

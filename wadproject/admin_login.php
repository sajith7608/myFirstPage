<?php
session_start();
include 'db_connection.php'; // DB connection file

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admi WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "Invalid username!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Admin Login</title>
<style>
  /* Basic Reset */
  * {
    box-sizing: border-box;
  }

  body {
    background: #f0f2f5;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }

  .login-container {
    background: white;
    padding: 30px 40px;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    width: 350px;
    text-align: center;
  }

  h2 {
    margin-bottom: 25px;
    color: #333;
  }

  input[type="text"],
  input[type="password"] {
    width: 100%;
    padding: 12px 15px;
    margin: 8px 0 20px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s ease;
  }

  input[type="text"]:focus,
  input[type="password"]:focus {
    border-color: #007bff;
    outline: none;
  }

  input[type="submit"] {
    background-color: #007bff;
    color: white;
    padding: 12px 0;
    border: none;
    width: 100%;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  input[type="submit"]:hover {
    background-color: #0056b3;
  }

  .error-msg {
    color: #d9534f;
    margin-bottom: 20px;
    font-weight: 600;
  }
</style>
</head>
<body>

<div class="login-container">
  <h2>Admin Login</h2>

  <?php if (isset($error)): ?>
    <p class="error-msg"><?php echo htmlspecialchars($error); ?></p>
  <?php endif; ?>

  <form method="post" action="">
    <input type="text" name="username" placeholder="Username" required autofocus>
    <input type="password" name="password" placeholder="Password" required>
    <input type="submit" name="login" value="Login">
  </form>
</div>

</body>
</html>

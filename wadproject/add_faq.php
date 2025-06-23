<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db_connection.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question = $conn->real_escape_string($_POST['question']);
    $answer = $conn->real_escape_string($_POST['answer']);

    if (!empty($question) && !empty($answer)) {
        $sql = "INSERT INTO faqs (question, answer) VALUES ('$question', '$answer')";
        if ($conn->query($sql) === TRUE) {
            $message = "FAQ added successfully.";
        } else {
            $message = "Error: " . $conn->error;
        }
    } else {
        $message = "Please fill both fields.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add FAQ</title>
</head>
<body>
<h2>Add New FAQ</h2>
<p style="color:green;"><?php echo $message; ?></p>
<form method="post" action="">
    <label>Question:<br>
        <textarea name="question" rows="4" cols="50" required></textarea>
    </label><br><br>
    <label>Answer:<br>
        <textarea name="answer" rows="6" cols="50" required></textarea>
    </label><br><br>
    <input type="submit" value="Add FAQ">
</form>
<p><a href="manage_faqs.php">Back to FAQ Management</a></p>
</body>
</html>

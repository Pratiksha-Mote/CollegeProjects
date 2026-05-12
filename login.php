<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testhub";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_POST['username'] && $_POST['password']) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    
    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, username FROM user_accounts WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $user;
        header("Location: recipemain.html");
        exit();
    } else {
        echo "<script>alert('Invalid username or password!'); window.location.href='reclog.html';</script>";
    }
    
    $stmt->close();
}
$conn->close();
?>
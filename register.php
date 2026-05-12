<?php
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

if ($_POST['username'] && $_POST['password'] && $_POST['email']) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $email = $_POST['email'];
    
    // Check if username already exists
    $check_stmt = $conn->prepare("SELECT username FROM user_accounts WHERE username = ?");
    $check_stmt->bind_param("s", $user);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows > 0) {
        echo "<script>alert('Username already exists!'); window.location.href='register.html';</script>";
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO user_accounts (username, password, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user, $pass, $email);
        
        if ($stmt->execute()) {
            echo "<script>alert('Registration successful! Please login.'); window.location.href='reclog.html';</script>";
        } else {
            echo "<script>alert('Registration failed!'); window.location.href='register.html';</script>";
        }
        $stmt->close();
    }
    $check_stmt->close();
}
$conn->close();
?>
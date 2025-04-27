<?php
session_start();

$conn = new mysqli("localhost", "root", "", "volunteer_platform");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = trim($_POST['email']);
$password = trim($_POST['password']);
$role = $_POST['role'];

// Check if user exists
$sql = "SELECT * FROM users WHERE email = ? AND password = ? AND role = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $email, $password, $role);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['full_name'] = $user['full_name'];
    $_SESSION['role'] = $user['role'];

    header("Location: profile.php");
    exit();
} else {
    echo "<script>alert('Invalid login credentials.'); window.location.href = '../login.html';</script>";
}

$conn->close();
?>

<?php
session_start();
require_once 'db_connection.php'; // adjust if your db connection file has a different name

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $appliedAt = $_POST['applied_at'];

    $sql = "DELETE FROM event_applications WHERE user_id = ? AND applied_at = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $userId, $appliedAt);
    $stmt->execute();

    header("Location: profile.php");
    exit();
}
?>

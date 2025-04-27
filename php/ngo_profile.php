<?php
session_start();
include 'php/db_connection.php';

// Check if user is logged in and has role 'ngo'
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'ngo') {
    echo "You are not authorized to view this page.";
    exit();
}

$ngo_id = $_SESSION['user_id']; // Get the logged-in NGO's ID

// Fetch events hosted by the NGO
$sql = "SELECT * FROM events WHERE ngo_id = ? ORDER BY event_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $ngo_id);
$stmt->execute();
$events = $stmt->get_result();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGO Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">My Events</h2>
    
    <table class="table">
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Type</th>
                <th>Location</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($event = $events->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($event['name']); ?></td>
                    <td><?php echo htmlspecialchars($event['type']); ?></td>
                    <td><?php echo htmlspecialchars($event['location']); ?></td>
                    <td><?php echo htmlspecialchars($event['event_date']); ?></td>
                    <td><?php echo htmlspecialchars($event['event_time']); ?></td>
                    <td><?php echo ucfirst($event['status']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="host_event.php" class="btn btn-primary">Host New Event</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
session_start();
include 'db_connection.php';

// Check if user is logged in and has role 'ngo'
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'ngo') {
    echo "You are not authorized to host events.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Form submission
    $name = $_POST['name'];
    $type = $_POST['type'];
    $location = $_POST['location'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $completion_hours = $_POST['completion_hours'];
    $ngo_id = $_SESSION['user_id']; // Get the logged-in NGO's ID

    // Insert the event details into the database
    $sql = "INSERT INTO events (ngo_id, name, type, location, event_date, event_time, completion_hours) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssi", $ngo_id, $name, $type, $location, $event_date, $event_time, $completion_hours);

    if ($stmt->execute()) {
        echo "Event hosted successfully!";
    } else {
        echo "Error hosting event: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Host Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Host a New Event</h2>
    <form action="host_event.php" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Event Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Event Type</label>
            <input type="text" class="form-control" id="type" name="type" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Event Location</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div class="mb-3">
            <label for="event_date" class="form-label">Event Date</label>
            <input type="date" class="form-control" id="event_date" name="event_date" required>
        </div>
        <div class="mb-3">
            <label for="event_time" class="form-label">Event Time</label>
            <input type="time" class="form-control" id="event_time" name="event_time" required>
        </div>
        <div class="mb-3">
            <label for="completion_hours" class="form-label">Completion Hours</label>
            <input type="number" class="form-control" id="completion_hours" name="completion_hours" required>
        </div>
        <button type="submit" class="btn btn-primary">Host Event</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

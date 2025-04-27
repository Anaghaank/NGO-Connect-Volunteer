<?php
// events.php
include 'db_connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the default status filter as 'upcoming'
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'upcoming';  // Default to 'upcoming'

$query = "SELECT * FROM events WHERE status = '$status_filter'"; // Only upcoming events by default
$result = $conn->query($query);

// Check for badge award logic when an event is completed
if ($status_filter == 'completed') {
    // Example: Give a badge after completing 5 events
    $userId = $_SESSION['user_id']; // Assuming user_id is stored in session

    // Get the number of completed events by the volunteer
    $sql = "SELECT COUNT(*) AS completed_events 
            FROM event_applications AS ea 
            JOIN events AS e ON ea.event_id = e.event_id
            WHERE ea.user_id = ? AND e.status = 'completed'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // If the volunteer has completed 5 or more events, award a badge
    if ($row['completed_events'] >= 5) {
        // Insert the badge into the volunteer_badges table
        $badgeId = 1;  // Assuming badge ID 1 corresponds to 'Completed 5 Events' badge
        $sql = "INSERT INTO volunteer_badges (user_id, badge_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $userId, $badgeId);
        $stmt->execute();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Events - Volunteer Platform</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #74ebd5, #ACB6E5);
      min-height: 100vh;
      font-family: 'Poppins', sans-serif;
    }
    .event-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      transition: 0.3s;
    }
    .event-card:hover {
      transform: translateY(-5px);
    }
    .apply-btn {
      background-color: #007bff;
      color: white;
      border-radius: 30px;
      padding: 8px 20px;
    }
    .apply-btn:hover {
      background-color: #0056b3;
    }
    h1 {
      color: #003B73;
      font-weight: bold;
    }
  </style>
</head>

<body>
<div class="container py-5">
  <h1 class="mb-4 text-center">Explore Volunteer Events</h1>

  <!-- Filter -->
  <form method="GET" class="d-flex justify-content-center mb-4">
    <select name="status" class="form-select w-25 me-2">
      <option value="upcoming" <?= $status_filter == 'upcoming' ? 'selected' : '' ?>>Upcoming</option>
      <option value="ongoing" <?= $status_filter == 'ongoing' ? 'selected' : '' ?>>Ongoing</option>
      <option value="completed" <?= $status_filter == 'completed' ? 'selected' : '' ?>>Completed</option>
    </select>
    <button type="submit" class="btn btn-primary">Filter</button>
  </form>

  <!-- Event Cards -->
  <div class="row">
    <?php if ($result && $result->num_rows > 0): ?>
      <?php while ($event = $result->fetch_assoc()): ?>
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="card event-card p-4">
            <h5><?= htmlspecialchars($event['name']) ?></h5>
            <p><strong>Type:</strong> <?= htmlspecialchars($event['type']) ?></p>
            <p><strong>Location:</strong> <?= htmlspecialchars($event['location']) ?></p>
            <p><strong>Date:</strong> <?= htmlspecialchars($event['event_date']) ?></p>
            <p><strong>Time:</strong> <?= htmlspecialchars($event['event_time']) ?></p>
            <p><strong>Hours:</strong> <?= htmlspecialchars($event['completion_hours']) ?> hrs</p>
            <!-- Apply Button Only for Upcoming Events -->
            <?php if ($event['status'] == 'upcoming'): ?>
              <button class="btn apply-btn mt-2" 
                data-bs-toggle="modal" 
                data-bs-target="#applyModal"
                data-eventid="<?= $event['event_id'] ?>"
                data-completionhours="<?= $event['completion_hours'] ?>"
                data-eventname="<?= htmlspecialchars($event['name']) ?>">
                Apply for this Event
              </button>
            <?php else: ?>
              <button class="btn btn-secondary mt-2" disabled>Event Not Available</button>
            <?php endif; ?>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-center fs-4">No events found.</p>
    <?php endif; ?>
  </div>
</div>

<!-- Apply Modal -->
<div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content rounded-4">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="applyModalLabel">Apply for Event</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="apply_event.php" method="POST">
        <div class="modal-body">
          <input type="hidden" name="event_id" id="event_id">
          <input type="hidden" name="completion_hours" id="completion_hours">
          <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>User ID:</label>
            <input type="number" name="user_id" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success w-100">Submit Application</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
var applyModal = document.getElementById('applyModal')
applyModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget
  var eventId = button.getAttribute('data-eventid')
  var completionHours = button.getAttribute('data-completionhours')
  var eventName = button.getAttribute('data-eventname')

  applyModal.querySelector('#event_id').value = eventId
  applyModal.querySelector('#completion_hours').value = completionHours
})
</script>
</body>
</html>

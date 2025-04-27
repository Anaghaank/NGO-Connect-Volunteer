<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
  echo "You are not logged in. <a href='../login.html'>Login here</a>";
  exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "volunteer_platform");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
  echo "User not found.";
  exit();
}

$user = $result->fetch_assoc();

// Handle event hosting form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['host_event']) && $user['role'] === 'ngo') {
  $event_name = $_POST['event_name'] ?? '';
  $event_type = $_POST['event_type'] ?? '';
  $event_location = $_POST['event_location'] ?? '';
  $event_date = $_POST['event_date'] ?? '';
  $event_time = $_POST['event_time'] ?? '';
  $completion_hours = $_POST['completion_hours'] ?? 0;
  $event_status = $_POST['event_status'] ?? 'upcoming';

  $event_sql = "INSERT INTO events (ngo_id, name, type, location, event_date, event_time, completion_hours, status) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
  $event_stmt = $conn->prepare($event_sql);
  $event_stmt->bind_param("isssssis", $user_id, $event_name, $event_type, $event_location, $event_date, $event_time, $completion_hours, $event_status);

  if ($event_stmt->execute()) {
    header("Location: profile.php?status=$event_status&success=EventCreated");
    exit();
  } else {
    echo "Error creating event: " . $conn->error;
  }
}

// Handle status update form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status']) && $user['role'] === 'ngo') {
  $event_id = $_POST['event_id'];
  $new_status = $_POST['new_status'];

  $update_sql = "UPDATE events SET status = ? WHERE event_id = ? AND ngo_id = ?";
  $update_stmt = $conn->prepare($update_sql);
  $update_stmt->bind_param("sii", $new_status, $event_id, $user_id);
  $update_stmt->execute();
}

// Fetch hosted events
$status_filter = $_GET['status'] ?? 'upcoming';
$events_sql = "SELECT * FROM events WHERE ngo_id = ? AND status = ?";
$events_stmt = $conn->prepare($events_sql);
$events_stmt->bind_param("is", $user_id, $status_filter);
$events_stmt->execute();
$events_result = $events_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>User Profile | Volunteer Platform</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #dbeafe, #fff7ed);
      font-family: 'Segoe UI', sans-serif;
      min-height: 100vh;
    }

    .profile-card {
      max-width: 900px;
      margin: 60px auto;
      padding: 40px;
      background: rgb(255, 255, 255);
      border-radius: 20px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
      animation: fadeIn 0.8s ease-in-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .btn-icon i {
      margin-right: 6px;
    }

    .event-form {
      background-color: #f8f9fa;
      border-radius: 15px;
      padding: 20px;
      display: none;
      margin-top: 20px;
    }

    .event-list {
      margin-top: 30px;
    }

    .event-card {
      border-radius: 15px;
      background-color: #fefefe;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
      margin-bottom: 20px;
    }

    footer {
      margin-top: 60px;
      text-align: center;
      font-size: 14px;
      color: #777;
    }

    /* Container styling */
    .applied-events {
      margin-top: 2rem;
    }

    .applied-events h5 {
      font-size: 1.75rem;
      margin-bottom: 1rem;
      text-align: center;
      color: #333;
    }

    /* Card grid */
    .event-cards {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
      gap: 1rem;
    }

    /* Individual card */
    .event-card {
      border: none;
      border-radius: 0.75rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .event-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    /* Card header */
    .event-card .card-header {
      background: linear-gradient(135deg, #6f42c1, #e83e8c);
      color: #fff;
      font-weight: 500;
      font-size: 1.1rem;
      border-top-left-radius: 0.75rem;
      border-top-right-radius: 0.75rem;
    }

    /* Card body text */
    .event-card .card-body p {
      margin-bottom: 0.5rem;
      color: #555;
    }

    /* Badges */
    .badge-hours {
      background-color: #20c997;
      color: #fff;
    }

    .badge-date {
      background-color: #0d6efd;
      color: #fff;
    }

    .badge-card {
      border-radius: 10px;
      padding: 10px;
      background-color: #f8f9fa;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .badge-icon {
      width: 50px;
      height: 50px;
      border-radius: 50%;
    }

    .modal-content {
      border-radius: 10px;
    }
  </style>
</head>

<body>

  <div class="profile-card">
    <h2 class="text-center mb-4"><i class="fas fa-user-circle"></i> Welcome, <?= htmlspecialchars($user['full_name']) ?>
    </h2>

    <div class="row">
      <div class="col-md-6">
        <p><strong>User ID:</strong> <?= htmlspecialchars($user['id']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
        <p><strong>Age:</strong> <?= htmlspecialchars($user['age']) ?></p>
        <p><strong>DOB:</strong> <?= htmlspecialchars($user['date_of_birth']) ?></p>
        <p><strong>Gender:</strong> <?= htmlspecialchars($user['gender']) ?></p>
      </div>
      <div class="col-md-6">
        <p><strong>Occupation:</strong> <?= htmlspecialchars($user['occupation']) ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($user['phone_number']) ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($user['address']) ?></p>
        <p><strong>Role:</strong> <?= htmlspecialchars($user['role']) ?></p>
      </div>
    </div>



    <?php if ($user['role'] === 'ngo') { ?>
      <div class="mt-4">
        <p><strong>NGO Name:</strong> <?= htmlspecialchars($user['ngo_name']) ?></p>
        <p><strong>NGO Location:</strong> <?= htmlspecialchars($user['ngo_location']) ?></p>

        <div class="d-flex justify-content-between align-items-center mt-3">
          <button id="hostNewEventBtn" class="btn btn-primary btn-icon">
            <i class="fas fa-calendar-plus"></i> Host New Event
          </button>

          <div class="btn-group">
            <a href="?status=upcoming" class="btn btn-outline-info"><i class="far fa-calendar-alt"></i> Upcoming</a>
            <a href="?status=ongoing" class="btn btn-outline-warning"><i class="fas fa-sync-alt"></i> Ongoing</a>
            <a href="?status=completed" class="btn btn-outline-success"><i class="fas fa-check-circle"></i> Completed</a>
          </div>
        </div>

        <div id="eventForm" class="event-form mt-4">
          <h5><i class="fas fa-plus"></i> Create Event</h5>
          <form action="profile.php" method="POST">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Event Name</label>
                <input type="text" class="form-control" name="event_name" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Type</label>
                <input type="text" class="form-control" name="event_type" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Location</label>
                <input type="text" class="form-control" name="event_location" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Date</label>
                <input type="date" class="form-control" name="event_date" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Time</label>
                <input type="time" class="form-control" name="event_time" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Hours</label>
                <input type="number" class="form-control" name="completion_hours" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Status</label>
                <select class="form-select" name="event_status" required>
                  <option value="upcoming">Upcoming</option>
                  <option value="ongoing">Ongoing</option>
                  <option value="completed">Completed</option>
                </select>
              </div>
            </div>
            <input type="hidden" name="host_event" value="1">
            <button type="submit" class="btn btn-success mt-3"><i class="fas fa-check-circle"></i> Submit</button>
          </form>
        </div>

        <div class="event-list">
          <h4 class="mt-5 mb-3 text-center"><i class="fas fa-list-alt"></i> Hosted Events</h4>

          <?php if ($events_result->num_rows > 0) { ?>
            <?php while ($event = $events_result->fetch_assoc()) { ?>
              <div class="event-card p-3">
                <h5><?= htmlspecialchars($event['name']) ?></h5>
                <p><strong>Type:</strong> <?= htmlspecialchars($event['type']) ?> |
                  <strong>Date:</strong> <?= htmlspecialchars($event['event_date']) ?> |
                  <strong>Time:</strong> <?= htmlspecialchars($event['event_time']) ?>
                </p>

                <form method="POST" action="profile.php" class="d-flex align-items-center">
                  <input type="hidden" name="event_id" value="<?= $event['event_id'] ?>">
                  <select name="new_status" class="form-select w-auto me-2">
                    <option value="upcoming" <?= $event['status'] == 'upcoming' ? 'selected' : '' ?>>Upcoming</option>
                    <option value="ongoing" <?= $event['status'] == 'ongoing' ? 'selected' : '' ?>>Ongoing</option>
                    <option value="completed" <?= $event['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                  </select>
                  <button type="submit" name="update_status" class="btn btn-primary btn-sm"><i class="fas fa-sync-alt"></i>
                    Update</button>
                </form>
              </div>
            <?php } ?>
          <?php } else { ?>
            <p class="text-center">No events found for <?= htmlspecialchars($status_filter) ?> status.</p>
          <?php } ?>
        </div>
      </div>



    </div><br><br>
  <?php } ?>

  <?php if ($user['role'] === 'volunteer'): ?>
    <!-- Button to open the badge modal -->
    <div class="d-flex justify-content-center mt-4" style="padding-top: 20px; padding-bottom: 30px;">
      <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#badgeModal" style="border-radius: 8px; padding: 15px 30px; font-size: 18px; background-color: #ADD8E6; color: white; border: none; 
                   box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; position: relative; width: 250px; 
                   height: 60px; display: flex; justify-content: center; align-items: center; overflow: hidden;">
        <span style="font-weight: bold;">View Your Badges</span>
        <!-- Background Badge Icons -->
        <div style="position: absolute; top: 10px; left: -20px; opacity: 0.1; font-size: 40px; color: #ffd700;">
          <i class="fas fa-medal"></i>
        </div>
        <div style="position: absolute; bottom: 10px; right: -20px; opacity: 0.1; font-size: 40px; color: #28a745;">
          <i class="fas fa-leaf"></i>
        </div>
      </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="badgeModal" tabindex="-1" aria-labelledby="badgeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 15px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);">
          <div class="modal-header"
            style="background-color:rgb(7, 13, 72); color: white; border-top-left-radius: 15px; border-top-right-radius: 15px;">
            <h5 class="modal-title" id="badgeModalLabel" style="font-size: 1.5rem; font-weight: 600;">Your Badges</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="background-color: #f0f8ff; padding: 20px; max-height: 500px; overflow-y: auto;">
            <!-- Sample Badges (Styled) -->

            <!-- Badge 1 -->
            <div class="badge-card d-flex align-items-center mb-3"
              style="background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
              <i class="badge-icon fas fa-medal" style="font-size: 50px; color: #ffd700; margin-right: 20px;"></i>
              <div>
                <strong style="font-size: 18px; color: #333;">Volunteer Hero</strong>
                <p style="font-size: 14px; color: #777; line-height: 1.5;">Awarded for completing 100 volunteer hours.</p>
              </div>
            </div>

            <!-- Badge 2 -->
            <div class="badge-card d-flex align-items-center mb-3"
              style="background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
              <i class="badge-icon fas fa-users" style="font-size: 50px; color: #28a745; margin-right: 20px;"></i>
              <div>
                <strong style="font-size: 18px; color: #333;">Community Leader</strong>
                <p style="font-size: 14px; color: #777; line-height: 1.5;">Awarded for leading 5 community projects.</p>
              </div>
            </div>

            <!-- Badge 3 -->
            <div class="badge-card d-flex align-items-center mb-3"
              style="background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
              <i class="badge-icon fas fa-leaf" style="font-size: 50px; color: #28a745; margin-right: 20px;"></i>
              <div>
                <strong style="font-size: 18px; color: #333;">Environmental Advocate</strong>
                <p style="font-size: 14px; color: #777; line-height: 1.5;">Awarded for participating in 10 environmental
                  campaigns.</p>
              </div>
            </div>

            <!-- Badge 4 -->
            <div class="badge-card d-flex align-items-center mb-3"
              style="background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
              <i class="badge-icon fas fa-users-cog" style="font-size: 50px; color: #17a2b8; margin-right: 20px;"></i>
              <div>
                <strong style="font-size: 18px; color: #333;">Team Player</strong>
                <p style="font-size: 14px; color: #777; line-height: 1.5;">Awarded for collaborating in 5 team activities.
                </p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>



    <div class="apply-card"
      style="padding: 20px; text-align: center; border-radius: 15px; background: linear-gradient(135deg,rgb(32, 88, 180),rgb(114, 172, 230)); color: #fff; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2); transition: transform 0.3s ease; padding-top:50px">
      <h5 style="font-size: 1.5rem; margin-bottom: 1rem; font-weight: 600;">Apply for the Events</h5>
      <p style="font-size: 1rem; color: #f8f9fa; margin-bottom: 1.5rem;">Join amazing events and contribute to meaningful
        causes! Sign up below to apply.</p>
      <form action="events.php" method="get">
        <button type="submit" class="btn"
          style="background-color: #fff; color:rgb(8, 1, 21); font-weight: 600; padding: 10px 25px; font-size: 1rem; border-radius: 30px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease, transform 0.3s ease;">
          Apply Now
        </button>
      </form>
    </div>

    <div class="applied-events"
      style="padding: 40px; background-color: #f8f9fa; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); max-width: 600px; margin: 20px auto; text-align: center;">
      <h5 style="font-size: 1.75rem; margin-bottom: 1rem; font-weight: 600; color: #333;">Your Applied Events</h5>
      <p style="font-size: 1.1rem; color: #6c757d; margin-bottom: 1.5rem;">Here is the list of events you've applied for.
        Stay updated with the latest opportunities!</p>

      <?php
      $userId = $_SESSION['user_id'];
      $sql = "
            SELECT
                ea.applied_at,
                ea.completion_hours,
                e.name,
                e.location,
                e.status
            FROM event_applications AS ea
            JOIN events AS e
                ON ea.event_id = e.event_id
            WHERE ea.user_id = ?
            ORDER BY ea.applied_at DESC
        ";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $userId);
      $stmt->execute();
      $result = $stmt->get_result();
      ?>

      <?php if ($result->num_rows > 0): ?>
        <div class="event-cards">
          <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card event-card mb-3">
              <div class="card-header d-flex justify-content-between align-items-center">
                <span>
                  <i class="fas fa-calendar-check me-2"></i>
                  <?= htmlspecialchars($row['name']) ?>
                </span>
                <!-- Delete button -->
                <form action="delete_application.php" method="post" style="margin: 0;">
                  <input type="hidden" name="applied_at" value="<?= htmlspecialchars($row['applied_at']) ?>">
                  <button type="submit" class="btn btn-sm btn-danger"
                    onclick="return confirm('Are you sure you want to delete this application?');">
                    <i class="fas fa-trash-alt"></i> Delete
                  </button>
                </form>
              </div>
              <div class="card-body">
                <p>
                  <i class="fas fa-map-marker-alt me-1"></i>
                  <?= htmlspecialchars($row['location']) ?>
                </p>
                <p>
                  <span class="badge badge-date">
                    <i class="fas fa-clock me-1"></i>
                    <?= date('M j, Y', strtotime($row['applied_at'])) ?>
                  </span>

                  <!-- Display completed hours if the event is marked as 'completed' -->
                  <?php if ($row['status'] === 'completed'): ?>
                    <span class="badge badge-hours">
                      <i class="fas fa-hourglass-half me-1"></i>
                      <?= htmlspecialchars($row['completion_hours']) ?> hrs (Completed)
                    </span>
                  <?php else: ?>
                    <span class="badge badge-hours">
                      <i class="fas fa-hourglass-half me-1"></i>
                      Not yet completed
                    </span>
                  <?php endif; ?>
                </p>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      <?php else: ?>
        <p class="text-center text-muted">You have not applied for any events yet.</p>
      <?php endif; ?>
    </div>




  <?php endif; ?>
  </div>

  <script>
    document.getElementById("hostNewEventBtn").addEventListener("click", function () {
      var form = document.getElementById("eventForm");
      form.style.display = form.style.display === "none" ? "block" : "none";
    });
  </script>
  <script>
    const button = document.querySelector('button');
    button.addEventListener('mouseenter', () => {
      button.style.backgroundColor = '#6f42c1';
      button.style.color = '#fff';
      button.style.transform = 'translateY(-3px)';
    });

    button.addEventListener('mouseleave', () => {
      button.style.backgroundColor = '#fff';
      button.style.color = '#6f42c1';
      button.style.transform = 'translateY(0)';
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

<?php
// apply_event.php

include 'db_connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = intval($_POST['user_id']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $event_id = intval($_POST['event_id']);
    $completion_hours = intval($_POST['completion_hours']);

    $query = "INSERT INTO event_applications (user_id, email, password, event_id, completion_hours) 
              VALUES ('$user_id', '$email', '$password', '$event_id', '$completion_hours')";

    if ($conn->query($query)) {
        // On success, show nice popup
        echo "
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
        <script>
        Swal.fire({
            title: 'Application Successful!',
            html: 'You can <a href=\"profile.php\">check it on your Profile</a><br><br>Or <a href=\"events.php\">apply for more events</a>!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'events.php'; // After OK, send back to events page
            }
        });
        </script>
        </body>
        </html>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>


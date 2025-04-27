<?php
// Database credentials
$servername = "localhost";
$username = "root"; // change if needed
$password = "";     // change if needed
$dbname = "volunteer_platform";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize and collect form data
$full_name     = mysqli_real_escape_string($conn, $_POST['name']);
$age           = (int) $_POST['age'];
$dob           = date('Y-m-d', strtotime($_POST['dob']));
$gender        = mysqli_real_escape_string($conn, $_POST['gender']);
$occupation    = mysqli_real_escape_string($conn, $_POST['occupation']);
$phone         = mysqli_real_escape_string($conn, $_POST['phone']);
$email         = mysqli_real_escape_string($conn, $_POST['email']);
$address       = mysqli_real_escape_string($conn, $_POST['address']);
$password      = mysqli_real_escape_string($conn, $_POST['password']); // Do not hash password
$role          = mysqli_real_escape_string($conn, $_POST['role']);
$ngo_name      = isset($_POST['ngo-name']) ? mysqli_real_escape_string($conn, $_POST['ngo-name']) : NULL;
$ngo_location  = isset($_POST['ngo-location']) ? mysqli_real_escape_string($conn, $_POST['ngo-location']) : NULL;

// Insert into database
$sql = "INSERT INTO users (
            full_name, age, date_of_birth, gender, occupation, phone_number,
            email, address, password, role, ngo_name, ngo_location
        ) VALUES (
            '$full_name', $age, '$dob', '$gender', '$occupation', '$phone',
            '$email', '$address', '$password', '$role', 
            " . ($role === 'ngo' ? "'$ngo_name', '$ngo_location'" : "NULL, NULL") . "
        )";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful. <a href='../login.html'>Login here</a>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>

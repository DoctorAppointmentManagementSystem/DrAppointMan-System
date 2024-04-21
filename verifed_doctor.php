<?php
// verified_doctor.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "DrAppointmentSystem";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$doctor_id = $_GET['id']; // Assuming you pass the doctor's ID as a query parameter

$sql = "UPDATE doctor SET is_verified = TRUE WHERE Doctor_id = $doctor_id";

if ($conn->query($sql) === TRUE) {
    echo "Doctor verified successfully";
} else {
    echo "Error verifying doctor: " . $conn->error;
}

$conn->close();
?>

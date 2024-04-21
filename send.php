<?php
// Connect to database
$conn = new mysqli('localhost', 'username', 'password', 'otp_verification');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$userType = $_POST['userType'];

// Generate OTP
$otp = mt_rand(100000, 999999);

// Insert OTP into sent_otps table
$sql = "INSERT INTO sent_otps (email, otp, user_type) VALUES ('$email', '$otp', '$userType')";

if ($conn->query($sql) === TRUE) {
    echo 'success';
} else {
    echo 'error';
}

$conn->close();
?>

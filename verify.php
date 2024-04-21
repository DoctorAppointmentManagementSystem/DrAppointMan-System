<?php
// Connect to database
$conn = new mysqli('localhost', 'username', 'password', 'otp_verification');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$otp = $_POST['otp'];
$userType = $_POST['userType'];

// Check if OTP is valid in sent_otps table
$sql = "SELECT * FROM sent_otps WHERE otp='$otp' AND user_type='$userType' ORDER BY created_at DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Move OTP to verified_otps table
    $row = $result->fetch_assoc();
    $email = $row['email'];
    $sql = "INSERT INTO verified_otps (email, otp, user_type) VALUES ('$email', '$otp', '$userType')";
    $conn->query($sql);

    echo 'success';
} else {
    echo 'error';
}

$conn->close();
?>

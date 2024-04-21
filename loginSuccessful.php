<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "DrAppointmentSystem";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$otp = $_POST['otp'];
$email = $_POST['email'];
// Check if OTP is valid in sent_otps table
$sql = "SELECT * FROM otp_codes WHERE otp='$otp' AND email='$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        if($otp == $row['otp'] && $email == $row['email']){
            echo 'patient';
        }else{
            // echo "<script>alert('Invalid OTP');</script>";
            echo 'register'. $conn->error;
        }
    }
} else {
    echo $conn->error;
}

$conn->close();
?>

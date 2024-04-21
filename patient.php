<?php
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

require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Function to send an email
function sendRegistrationConfirmationEmail($email) {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->Username = "yoginilande3@gmail.com"; // Your Gmail email address
    $mail->Password = "qsce clva abjm icwx"; // Your Gmail App Password

    // Sender and recipient settings
    $mail->setFrom("yoginilande@gmail.com", "DrAppointmentSystem");
    $mail->addAddress($email);

    // Email content
    $mail->Subject = "Registration Confirmation";
    $mail->Body = "Hello,\nYour registration as a patient has been successful. Thank you for registering and contacting with medcare.";

    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}

$stmt = null; // Define $stmt variable outside the if block

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['Name'] ?? '';
    $gender = $_POST['Gender'] ?? '';
    $email = $_POST['Email'] ?? '';
    $phonenumber = $_POST['Phone Number'] ?? '';
    $dateofbirth = $_POST['Date of birth'] ?? '';
    $address = $_POST['Address'] ?? '';
    $disease = $_POST['Disease'] ?? '';
    $age = $_POST['Age'] ?? '';
    $date = $_POST['Date'] ?? '';
    $rescheduledAppointment = $_POST['resheduleAppointment'] ?? '';
    $paymentMethod = $_POST['paymentMethod'] ?? '';
}

// Check if $rescheduledAppointment is empty and set a default value if it is
if (empty($rescheduledAppointment)) {
    $rescheduledAppointment = 'No rescheduled appointment';
}

$stmt = $conn->prepare("INSERT INTO patient (`Name`, `Date of birth`, `Gender`, `Phone Number`, `Email`, `Address`, `Disease`, `Age`, `Date`, `resheduleAppointment`, `PaymentMethod`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("sssssssssss", $name, $dateofbirth, $gender, $phonenumber, $email, $address, $disease, $age, $date, $rescheduledAppointment, $paymentMethod);

if ($stmt->execute()) {
    if (sendRegistrationConfirmationEmail($email)) {
        echo "New record created successfully and registration confirmation email sent";
    } else {
        echo "New record created successfully but failed to send registration confirmation email";
    }
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration</title>
    <!-- Add the Bootstrap CSS file -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add custom CSS styles -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('yogini.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: repeat;
            margin: 0;
            padding: 0;
            height: 100vh;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Patient Registration</h2>
    <form method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name">
        </div>
        <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="date" class="form-control" id="dob" name="dob">
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label>
            <select class="form-control" id="gender" name="gender">
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="tel" class="form-control" id="phone" placeholder="Enter your phone number" name="Phone Number">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter your email" name="Email">
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" placeholder="Enter your address" name="Address">
        </div>
        <div class="form-group">
            <label for="disease">Disease:</label>
            <input type="text" class="form-control" id="disease" placeholder="Enter your disease" name="Disease">
        </div>
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="text" class="form-control" id="age" placeholder="Enter your age" name="Age">
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" class="form-control" id="date" name="Date">
        </div>
        <div class="form-group">
            <label for="resheduleAppointment">Reschedule Appointment:</label>
            <input type="text" class="form-control" id="resheduleAppointment" name="resheduleAppointment">
        </div>
        <div class="form-group">
            <label for="paymentMethod">Payment Method:</label><br>
            <input type="radio" id="onlinePayment" name="paymentMethod" value="Online Payment" onclick="openPaymentPage()">
            <label for="onlinePayment">Online Payment</label><br>
            <input type="radio" id="cashPayment" name="paymentMethod" value="Cash">
            <label for="cashPayment">Cash</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<!-- Add the Bootstrap JavaScript and jQuery files -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function openPaymentPage() {
        window.location.href = 'payment.php';
    }
</script>
</body>
</html>
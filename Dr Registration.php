<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

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

// Function to send an email
function sendEmail($to, $subject, $message) {
    $mail = new PHPMailer(true); // Passing `true` enables exceptions

    try {
        // Server settings
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'smtp.yourmailserver.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'yoginilande3@gmail.com'; // SMTP username
        $mail->Password = 'qsce clva abjm icwx'; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // TCP port to connect to

        // Recipients
        $mail->setFrom('yoginilande3@gmail.com', 'Yogini');
        $mail->addAddress($to); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $email = $_POST['email'] ?? '';
    $phonenumber = $_POST['phone'] ?? '';
    $dateofbirth = $_POST['dob'] ?? '';
    $address = $_POST['address'] ?? '';
    $specialization = $_POST['specialization'] ?? '';
    $experience = $_POST['experience'] ?? '';
    $doctor_id = $_POST['Doctor_id'] ?? '';
    $license_number = $_POST['license_number'] ?? '';
    $affiliation = $_POST['affiliation'] ?? '';

    $stmt = $conn->prepare("INSERT INTO doctor (`Name`, `Date of birth`, `Gender`, `Phone Number`, `Email`, `Address`, `Specialization`, `Experience`, `verified`, `Doctor_id`, `License Number`, `Affiliation`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $name, $dateofbirth, $gender, $phonenumber, $email, $address, $specialization, $experience, $doctor_id, $license_number, $affiliation);

    if ($stmt->execute()) {
        echo "Successfully registered";

        // Send registration confirmation email
        $registrationConfirmationMessage = 'Your registration was successful.';
        if (sendEmail($email, 'Registration Confirmation', $registrationConfirmationMessage)) {
            echo "Registration confirmation email sent";
        } else {
            echo "Failed to send registration confirmation email";
        }

        // Notify admin for verification
        $adminEmail = 'lyogini573@gmail.com'; // Change this to your admin's email
        $verificationLink = 'http://localhost/drappointmentsystem/verifed_doctor.php?email=' . urlencode($email);
        $verificationMessage = "A new doctor has registered. Please verify their credentials: <a href='$verificationLink'>Verify Doctor</a>";
        if (sendEmail($adminEmail, 'New Doctor Registration', $verificationMessage)) {
            echo "Admin notified for verification";

            // Redirect to dashboard.php after admin verification
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Failed to notify admin for verification";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Registration</title>
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
    <h2>Doctor Registration</h2>
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
            <input type="tel" class="form-control" id="phone" placeholder="Enter your phone number" name="phone">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email">
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" placeholder="Enter your address" name="address">
        </div>
        <div class="form-group">
            <label for="specialization">Specialization:</label>
            <input type="text" class="form-control" id="specialization" placeholder="Enter your specialization"
                   name="specialization">
        </div>
        <div class="form-group">
            <label for="experience">Experience (in years):</label>
            <input type="number" class="form-control" id="experience" placeholder="Enter your experience"
                   name="experience">
        </div>
        <div class="form-group">
            <label for="Doctor_id">Doctor ID:</label>
            <input type="number" class="form-control" id="Doctor_id" placeholder="Enter your Doctor ID" name="Doctor_id">
        </div>
        <div class="form-group">
            <label for="license_number">License Number:</label>
            <input type="text" class="form-control" id="license_number" placeholder="Enter your License Number" name="license_number">
        </div>
        <div class="form-group">
            <label for="affiliation">Affiliation:</label>
            <input type="text" class="form-control" id="affiliation" placeholder="Enter your Affiliation" name="affiliation">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<!-- Add the Bootstrap JavaScript and jQuery files -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

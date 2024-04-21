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

include "src/PHPMailer.php";
include "src/SMTP.php";
include "src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Function to send email
function sendMail($send_to, $otp) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->Username = "yoginilande3@gmail.com"; // Your email
        $mail->Password = "qsce clva abjm icwx"; // Your email password
        $mail->setFrom("yoginilande3@gmail.com", "DrAppointmentSystem");
        $mail->addAddress($send_to);
        $mail->Subject = 'Welcome To Medcare here is your account activation key: ';
        $mail->Body = $otp;
        $mail->send();
        echo "Email sent successfully";
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $otp = rand(1111, 9999);
    $currentDateTime = date('Y-m-d H:i:s');
    
    // Prepare the statement
    $stmt = $conn->prepare("INSERT INTO otp_codes (otp, email, user_type, created_at) VALUES (?, ?, ?, ?)");
    
    // Bind parameters
    $stmt->bind_param("ssss", $otp, $email, $user_type, $currentDateTime);
    
    // Set user_type
    $user_type = 'Patient';
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "otp_sent";
        sendMail($email, $otp);
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();   
}
$conn->close();
?>
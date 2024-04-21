
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
function sendMail($send_to, $subject, $message) {
    global $conn;
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
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->send();
        echo "Email sent successfully";
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';

    // Call the sendMail function to send email
    sendMail($email, $subject, $message);

    // Insert data into the contact table
    $stmt = $conn->prepare("INSERT INTO contact (Name, Email, Subject, Message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        echo "Message sent successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewreport" content="width=device-width, initial-scale=1.0">
    <title>
        WEBPAGE
    </title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="contact.css" />
   
</head>
<body>
    <div class="container-fluid banner">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-md">
                    <div class="navbar-brand">MEDCARE</div>
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="main.php">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">ABOUT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">CONTACT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary" href="logout.php">LOGOUT</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <section class="mb-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
                    <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within a matter of hours to help you.</p>
                    <form id="contact-form" name="contact-form" action="contact.php" method="POST">
                        <div class="md-form mb-0">
                            <input type="text" id="name" name="name" class="form-control">
                            <label for="name" class="">Your name</label>
                        </div>
                        <div class="md-form mb-0">
                            <input type="text" id="email" name="email" class="form-control">
                            <label for="email" class="">Your email</label>
                        </div>
                        <div class="md-form mb-0">
                            <input type="text" id="subject" name="subject" class="form-control">
                            <label for="subject" class="">Subject</label>
                        </div>
                        <div class="md-form">
                            <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                            <label for="message">Your message</label>
                        </div>
                        <div class="text-center text-md-left">
                            <button class="btn btn-primary" type="submit">Send</button>
                        </div>
                    </form>
                    <div class="status"></div>
                </div>
            </div>
        </div>
    </section>
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>Address: pragati colony, sakoli, India</p>
                    <p>Phone: +7721858596</p>
                    <p>Email: medcare@123.com</p>
                </div>
                <div class="col-md-6 text-right">
                    <p>&copy; 2024 Medcare. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>

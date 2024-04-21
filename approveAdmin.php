<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "DrAppointmentSystem";
$data = json_decode(file_get_contents('php://input'), true);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Perform the database update using the received data
$sql = "UPDATE your_table SET verified = 1 WHERE id = {$data}"; // Change 'your_table' as per your table structure

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
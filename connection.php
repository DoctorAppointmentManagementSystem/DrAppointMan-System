<?php
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "DrAppointmentSystem"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data
$sql = "SELECT * FROM payment";
$result = $conn->query($sql);

// Check if query was successful
if (!$result) {
    die("Error executing the query: " . $conn->error);
}

// Check if any rows are returned
if ($result->num_rows > 0) {
    // Output data of each row
    echo "<table>";
    echo "<thead><tr><th>Patient Name</th><th>Doctor name</th><th>Amount</th><th>Payment method</th><th>Transaction ID</th></tr></thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["patient_name"] . "</td>";
        echo "<td>" . $row["doctor_name"] . "</td>";
        echo "<td>" . $row["amount"] . "</td>";
        echo "<td>" . $row["payment_method"] . "</td>";
        echo "<td>" . $row["transaction_id"] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p style='text-align: center; color: #333;'>No payment records found</p>";
}
$conn->close();
?>

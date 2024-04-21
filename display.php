<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5; /* Light grey background color */
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff; /* White background color */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Shadow effect */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        @media screen and (max-width: 600px) {
            table {
                width: 100%;
            }

            td:before {
                position: absolute;
                top: 6px;
                left: 6px;
                width: 100%;
                padding-right: 10px;
                white-space: nowrap;
            }

            td:nth-of-type(1):before { content: "Patient Name: "; }
            td:nth-of-type(2):before { content: "Doctor: "; }
            td:nth-of-type(3):before { content: "Amount: "; }
            td:nth-of-type(4):before { content: "Payment method: "; }
            td:nth-of-type(5):before { content: "Transaction ID: "; }
        }
    </style>
</head>
<body>

<div class="container">
    <h1 style="text-align: center;">Hospital Payment Information</h1>
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

    if ($result) {
        if ($result->num_rows > 0) {
            // Output data of each row
            echo "<table>";
            echo "<thead><tr><th>doctor</th><th>patient_name</th><th>Amount</th><th>Payment method</th><th>Transaction ID</th></tr></thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["doctor_name"] . "</td>";
                echo "<td>" . $row["patient_name"] . "</td>";
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
    } else {
        echo "<p style='text-align: center; color: red;'>Error: " . $conn->error . "</p>";
    }

    // Close connection
    $conn->close();
    ?>
</div>

</body>
</html>

<?php
// Establish connection to your MySQL database
$connection = mysqli_connect("localhost", "root", "", "DrAppointmentSystem");

// Check if the connection was successful
if ($connection === false) {
    die("Error: Could not connect. " . mysqli_connect_error());
}

// Process form submission if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $doctor = $_POST["doctor_name"];
    $patientName = $_POST["patient-name"];
    $amountPayable = $_POST["amount-payable"];
    $paymentMethod = $_POST["payment"];

    if($paymentMethod=="UPI"){

        function generateCode($length = 16) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $code = '';
            for ($i = 0; $i < $length; $i++) {
                $code .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $code;
        }
        
        $tid=generateCode();
    }else{
        $tid="No Tranjection Id";
    }

    // SQL query to insert data into the database
    $sql = "INSERT INTO payment (doctor_name, patient_name, amount, payment_method, transaction_id) VALUES ('$doctorname', '$patientName', $amountPayable, '$paymentMethod', '$tid')";

    // Execute the query
    if (mysqli_query($connection, $sql)) {
        echo "Record inserted successfully.";
        header("Location: display.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}

// Close the database connection
mysqli_close($connection);
?>


User
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            color: #9c45b7;
        }

        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 20px;
            color: blue;
        
        }

        

        #sidebar {
            background:blue;
            padding: 50px;
            border-radius: 10px;
        }
        .education-info {
        margin-bottom: 20px;
        color: blue;
        font-weight: bold;
}


        #main-content {
            color: #3c59b8;
            margin-top: 5px; 
            padding: 50px;
            border-radius: 10px;/* Adjust margin to prevent overlapping */
        }

        .nav-link {
            color: #701111;
        }

        .nav-link:hover {
            color: #3166ce;
        }

        .card {
            background: rgba(255, 255, 255, 0.1);
            color: #3c59b8;
            margin-bottom: 20px;
        }

        .table {
            color: #0fbe6f;
        }

        .table th,
        .table td {
            border-color: rgba(255, 255, 255, 0.1);
        }

        .table th {
            background-color: rgba(255, 255, 255, 0.1);
            color: #adbc2c;
        }
        .full-height {
            height: 1vh;
        }

    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 d-none d-md-block bg-light" id="sidebar">
                <div class="sidebar-sticky">
                    <h5 class="text-white mt-3 mb-4 ml-3">Dashboard</h5>
                    <div class="text-center">
                        <img src="urmi.jpg" alt="Doctor Profile Photo" class="profile-photo">
                        <h6 class="text-white mt-2" style="color:blue;">Dr. Urmila Shashtri</h6>
                        <p class="text-white mb-4" style="color: blue;">MBBS, MD (Internal Medicine)</p>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="patient.php">Appointment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="notification.php">Notification</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display.php">Payment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Settings</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 ml-sm-auto col-lg-10 px-4" id="main-content">
                <div class="container-fluid banner">
                    <div class="row">
                        <div class="col-md-12">
                            <nav class="navbar navbar-md">
                                <div class="navbar-brand">Dashboard</div>
                               
                                        <a class="nav-link btn btn-primary" href="logout.php">LOGOUT</a>
                                    </li>
                                </ul>
                            </nav>
                
                
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                Today's Appointments
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                Consultations
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                Missed Appointments
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                    <thead>
                            <th></th>
                            <th>Name</th>
                            <th>Date of birth</th>
                            <th>Gender</th>
                            <th>PhoneNumber</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>PaymentMethod</th>
                            <th>Age</th>
                            <th>Disease</th>
                            <th>Date</th>
                            <th>Delete</th>
                    </thead>
                    
                        
                        <tbody id="patientData">
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
                        $sql = "SELECT * FROM patient";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td><input type='checkbox' class='action'></td>
                                <td>{$row['Name']}</td>
                                <td>{$row['Date of birth']}</td>
                                <td>{$row['Gender']}</td>
                                <td>{$row['Phone Number']}</td>
                                <td>{$row['Email']}</td>
                                <td>{$row['Address']}</td>
                                <td>{$row['PaymentMethod']}</td>
                                <td>{$row['Age']}</td>
                                <td>{$row['Disease']}</td>
                                <td>{$row['Date']}</td>
                                <td><button class='btn btn-primary actionBtn'>Delete</button></td></tr>";
                        
                            }
                        }
// Update the verification status of the currently logged-in doctor
$doctor_id = 1; // Assuming the ID of the logged-in doctor is 1, replace it with the actual ID
$update_query = "UPDATE doctor SET verified = 1 WHERE Doctor_id = $doctor_id";
if(mysqli_query($conn, $update_query)) {
    echo "Verification status updated successfully.";
} else {
    echo "Error updating verification status: " . mysqli_error($conn);
}

// Display the verification status on the doctor dashboard
$verification_query = "SELECT verified FROM doctor WHERE Doctor_id = $doctor_id";
$result = mysqli_query($conn, $verification_query);
if($result) {
    $row = mysqli_fetch_assoc($result);
    $verified = $row['verified'];
    $verification_status = $verified ? "Verified" : "Not Verified";
    echo "<p>Verification Status: $verification_status</p>";
} else {
    echo "Error fetching verification status: " . mysqli_error($conn);
}

                    ?>
       
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const actionButtons = document.querySelectorAll('.actionBtn');
            actionButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const row = this.parentNode.parentNode;
                    if (row.querySelector('.action').checked) {
                        row.parentNode.removeChild(row);
                    } else {
                        // Logic to display patient details
                        alert('Displaying patient details');
                    }
                });
            });
        });
    </script>
    <!-- Include Bootstrap JS and any other scripts here -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
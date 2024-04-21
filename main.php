
<?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "DrAppointmentSystem";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password);

            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
            echo "Connected successfully";
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
    <link rel="stylesheet" type="text/css" href="imainindex.css" />
   
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
            <div class="col-md-8 offset-md-2 info">
                <h1 class="text-center">MEDCARE</h1>
                <p class="text-center">
                    stay safe tay healthu live long
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary" href="login.php">Login  here</a>
                    </li>
                </p>
                  
                </div>
                
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                var userType = $('input[name="userType"]:checked').val();
                if (userType === 'patient') {
                    window.location.href = 'patient.php';
                } else if (userType === 'doctor') {
                    window.location.href='Dr Registration.php';
                }
            });
        });
    </script>
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
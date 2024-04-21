<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Add the Bootstrap CSS file -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add custom CSS styles -->
    <style>
        body {
            font-family: Arial, sans-serif;
    font-family: Arial, sans-serif;
    background-image: url('yogini.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
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
        <h2>Register</h2>
        <form id="registerForm">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password">
            </div>
            <div class="form-group">
                <label for="userType">User Type:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="userType" id="doctor" value="doctor">
                    <label class="form-check-label" for="doctor">Doctor</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="userType" id="patient" value="patient">
                    <label class="form-check-label" for="patient">Patient</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="userType" id="admin" value="admin">
                    <label class="form-check-label" for="admin">Admin</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <br>
        <p>Already have an account? <a href="login.php">Login Now</a></p>
    </div>
    <!-- Add the Bootstrap JavaScript and jQuery files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
                <script>
    $(document).ready(function() {
        $('#registerForm').on('submit', function(e) {
            e.preventDefault();
            var userType = $('input[name="userType"]:checked').val();
            if (userType === 'patient') {
                window.location.href = 'patient.php';
            } else if (userType === 'doctor') {
                window.location.href = 'Dr Registration.php';
            } else if (userType === 'admin') {
                window.location.href = 'admindashboard.php';
            }
        });
    });
</script>


            </body>
            </html>
                   
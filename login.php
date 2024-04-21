
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send OTP</title>
    <style>
        body {
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
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

.form-check {
    margin-bottom: 10px;
}

.form-check-input {
    margin-right: 5px;
}

#message {
    margin-top: 10px;
    color: #dc3545;
}

#loginBtn {
    margin-top: 10px;
    display: block;
    width: 100%;
}

p {
    text-align: center;
    margin-top: 20px;
}

p a {
    color: #007bff;
    text-decoration: none;
}

p a:hover {
    text-decoration: underline;
}

.form-control {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ced4da;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.table th,
.table td {
    border: 1px solid #dee2e6;
    padding: 8px;
    text-align: center;
}

.table th {
    background-color: #f8f9fa;
}

.table td {
    background-color: #fff;
}

</style>
</head>

<body>
    <div class="container">
        <h2>Send OTP via Email</h2>
        <form id="otpForm" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" required>
            </div>
            <div id="otpSection">
                <div class="form-group">
                    <label for="otp">Enter OTP:</label>
                    <input type="text" class="form-control" id="otp" placeholder="Enter OTP" name="otp" required>
                </div>
            </div>
            <div class="form-group">
                <label for="userType">User Type:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="userType" id="doctor" value="doctor" required>
                    <label class="form-check-label" for="doctor">Doctor</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="userType" id="patient" value="patient" required>
                    <label class="form-check-label" for="patient">Patient</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="userType" id="admin" value="admin" required>
                    <label class="form-check-label" for="admin">Admin</label>
                </div>
            </div>
            <div class="form-group">
                <input type="button" id="submitBtn" onclick='sendOtp(event)' value="Send OTP">
            </div>
        </form>
        <div id="message"></div>
        <button type="submit" class="btn btn-primary" id="loginBtn">Login</button>
        <br>
        <p>Already have an account? <a href="register.php">Register Now</a></p>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function sendOtp(e){
            
                console.log('working');
                e.preventDefault();
                var email = $('#email').val();
                var otp = $('#otp').val();
                var userType = $('input[name="userType"]:checked').val();

                $.ajax({
                    url: 'verify-otp.php', // Change this to the correct file
                    type: 'POST',
                    data: {
                        email: email,
                        otp: otp,
                        userType: userType,
                    },
                    success: function(response) {
                        if (response === 'success') {
                            $('#loginSection').show();
                            $('#otpSection').hide();
                            // $('#message').php('<div class="alert alert-success">Login successful!</div>');
                            alert("Login Successful")
                        } else if (response === 'otp_sent') {
                            $('#otpSection').show();
                            // $('#message').php('<div class="alert alert-success">OTP sent to your email.</div>');
                            alert("Otp sent to your email")
                        } else {
                            // $('#message').php('<div class="alert alert-danger">Failed to send OTP. Please try again.</div>');
                            alert(response)

                        }
                    }
                });
        }

            $('#loginBtn').on('click', function() {
                
                var email = $('#email').val();
                var otp = $('#otp').val();
                var userType = $('input[name="userType"]:checked').val();

                $.ajax({
                    url: 'loginSuccessful.php', // Change this to the correct file
                    type: 'POST',
                    data: {
                        email: email,
                        otp: otp,
                        userType: userType,
                    },
                    success: function(response) {
                        if (userType === 'patient') {
                            window.location.href = 'patient.php';
                        } 
                        else if (userType === 'doctor') {
                                 window.location.href = 'Dr Registration.php';
                            } else if (userType=== 'admin') {
                                    window.location.href = 'adminregister.php';
                                 }
                        else{
                            window.location.href = 'register.php'
                        }
                    }
                });
                var userType = $('input[name="userType"]:checked').val();

            });
    </script>
</body>

</html>

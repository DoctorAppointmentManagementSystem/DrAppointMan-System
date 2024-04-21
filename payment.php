<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5; /* Light grey background color */
        }

        #main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #payment-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 500px; /* Limit container width for better readability */
            text-align: center;
        }

        h2 {
            color: #007bff; /* Hospital's primary color */
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #333; /* Dark grey color for labels */
        }

        input[type="text"],
        input[type="number"],
        select {
            width: calc(100% - 22px); /* Adjust input width for better display */
            padding: 10px;
            margin: 10px auto; /* Center inputs */
            display: block;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        button {
            background-color: #007bff; /* Hospital's primary color */
            color: #fff; /* White text color */
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3; /* Darker shade of primary color on hover */
        }
    </style>
</head>
<body>
    <div id="main-container">
        <div id="payment-container">
            <h2>Hospital Payment</h2>
            <form id="payment-form" method="POST" action="data.php">
                <label for="doctor">Select Doctor:</label>
                <select id="doctor" name="doctor">
                    <option value="Dr. John">Dr. John</option>
                    <option value="Dr. Emily">Dr. Emily</option>
                    <option value="Dr. Smith">Dr. Smith</option>
                </select>

                <label for="patient-name">Patient Name:</label>
                <input type="text" id="patient-name" name="patient-name" required>

                <label for="amount-payable">Amount Payable (INR):</label>
                <input type="number" id="amount-payable" name="amount-payable" min="0" value="0" required>

                <br><br>

                <input type="radio" name="payment" value="UPI" id="upi-option" checked>
                <label for="upi-option">UPI</label>

                <input type="radio" name="payment" value="CashOn" id="cash-option">
                <label for="cash-option">Cash in Hospital</label>

                <br><br>

                <button id="pay-button" type="submit">Make Payment</button>
            </form>
        </div>
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.getElementById('pay-button').addEventListener('click', function(event) {
            event.preventDefault();
            var amount = document.getElementById('amount-payable').value;
            var doctor = document.getElementById('doctor').value;
            var patientName = document.getElementById('patient-name').value;
            var paymentType = document.querySelector('input[name="payment"]:checked').value;

            if (!amount || !doctor || !patientName || !paymentType) {
                alert('Please fill out all required fields.');
                return;
            }

            if (paymentType === 'CashOn') {
                document.getElementById('payment-form').submit();
            } else {
                var options = {
                    key: 'rzp_test_9BJ0z9nca8Qlth',
                    amount: amount * 100, // Amount is in paise
                    currency: 'INR',
                    name: 'Hospital Payment',
                    description: 'Payment for ' + doctor + ' by ' + patientName,
                    image: 'https://example.com/logo.png',
                    handler: function(response) {
                        // Send payment ID along with other form data
                        var form = document.getElementById('payment-form');
                        var paymentIdField = document.createElement('input');
                        paymentIdField.setAttribute('type', 'hidden');
                        paymentIdField.setAttribute('name', 'razorpay_payment_id');
                        paymentIdField.setAttribute('value', response.razorpay_payment_id);
                        form.appendChild(paymentIdField);

                        form.submit();
                    },
                    prefill: {
                        name: patientName,
                    },
                    theme: {
                        color: '#007bff' /* Hospital's primary color */
                    }
                };

                var rzp = new Razorpay(options);
                rzp.open();
            }
        });
    </script>
</body>
</html>

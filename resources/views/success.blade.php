<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <script>
        // Function to redirect after a delay
        function redirectToMyOrders() {
            setTimeout(function() {
                window.location.href = "{{ route('myOrders') }}";
            }, 5000); // 5000 milliseconds = 5 seconds
        }
    </script>
</head>
<body onload="redirectToMyOrders()">
    <h1>Payment Successful!</h1>
    <p>Your payment was completed successfully. You will be redirected to your orders page shortly.</p>
</body>
</html>

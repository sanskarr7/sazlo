<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failure</title>
    <script>
        // Function to redirect after a delay
        function redirectToIndex() {
            setTimeout(function() {
                window.location.href = "{{ route('index') }}";
            }, 5000); // 5000 milliseconds = 5 seconds
        }
    </script>
</head>
<body onload="redirectToIndex()">
    <h1>Payment Failed!</h1>
    <p>There was an issue with your payment. You will be redirected to the home page shortly.</p>
</body>
</html>

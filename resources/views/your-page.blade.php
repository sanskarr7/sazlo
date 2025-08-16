<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: #333;
            animation: gradientShift 10s ease infinite;
        }

        @keyframes gradientShift {
            0%, 100% { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
            50% { background: linear-gradient(135deg, #667eea 20%, #764ba2 80%); }
        }

        .payment-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            padding: 40px;
            width: 100%;
            max-width: 500px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: slideIn 0.8s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .payment-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #60bb46, #4CAF50, #45a049);
            border-radius: 24px 24px 0 0;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .esewa-logo {
            width: 120px;
            height: 40px;
            background: linear-gradient(135deg, #60bb46, #4CAF50);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
            margin: 0 auto 20px;
            box-shadow: 0 8px 25px rgba(96, 187, 70, 0.3);
            animation: pulse 3s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        h1 {
            font-size: 32px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 12px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .subtitle {
            color: #7f8c8d;
            font-size: 16px;
            font-weight: 400;
        }

        .total-display {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 35px;
            text-align: center;
            border: 2px solid rgba(96, 187, 70, 0.1);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .total-display::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(transparent, rgba(96, 187, 70, 0.1), transparent);
            animation: rotate 4s linear infinite;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .total-display:hover::before {
            opacity: 1;
        }

        .total-display:hover {
            border-color: rgba(96, 187, 70, 0.3);
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .total-label {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 600;
            position: relative;
            z-index: 2;
        }

        .total-amount {
            font-size: 42px;
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 8px;
            position: relative;
            z-index: 2;
        }

        .currency-info {
            font-size: 16px;
            color: #60bb46;
            font-weight: 600;
            position: relative;
            z-index: 2;
        }

        .form-wrapper {
            position: relative;
        }

        .payment-form {
            position: relative;
            z-index: 1;
        }

        .pay-button {
            width: 100%;
            padding: 20px;
            background: linear-gradient(135deg, #60bb46 0%, #4CAF50 50%, #45a049 100%);
            color: white;
            border: none;
            border-radius: 16px;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(96, 187, 70, 0.4);
            font-family: inherit;
        }

        .pay-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s ease;
        }

        .pay-button:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 15px 40px rgba(96, 187, 70, 0.5);
        }

        .pay-button:hover::before {
            left: 100%;
        }

        .pay-button:active {
            transform: translateY(-2px) scale(0.98);
            transition: all 0.1s ease;
        }

        .security-indicators {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 25px;
            padding: 15px;
            background: rgba(96, 187, 70, 0.08);
            border-radius: 12px;
            font-size: 14px;
            color: #60bb46;
            font-weight: 600;
            border: 1px solid rgba(96, 187, 70, 0.2);
        }

        .security-indicators::before {
            content: '🔒';
            margin-right: 8px;
            font-size: 16px;
            animation: glow 2s ease-in-out infinite;
        }

        @keyframes glow {
            0%, 100% { filter: brightness(1); }
            50% { filter: brightness(1.3); }
        }

        .processing-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(5px);
            display: none;
            align-items: center;
            justify-content: center;
            border-radius: 24px;
            z-index: 1000;
        }

        .processing-overlay.active {
            display: flex;
        }

        .loader {
            width: 50px;
            height: 50px;
            border: 4px solid #e3e3e3;
            border-top: 4px solid #60bb46;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loading-text {
            margin-left: 20px;
            font-size: 16px;
            font-weight: 600;
            color: #60bb46;
        }

        @media (max-width: 480px) {
            .payment-container {
                padding: 25px;
                margin: 15px;
            }

            h1 {
                font-size: 26px;
            }

            .total-amount {
                font-size: 32px;
            }

            .pay-button {
                padding: 18px;
                font-size: 16px;
            }
        }

        .floating-particles {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            overflow: hidden;
            border-radius: 24px;
        }

        .particle {
            position: absolute;
            background: rgba(96, 187, 70, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(1) {
            width: 6px;
            height: 6px;
            top: 10%;
            left: 20%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            width: 8px;
            height: 8px;
            top: 60%;
            left: 80%;
            animation-delay: 1s;
        }

        .particle:nth-child(3) {
            width: 4px;
            height: 4px;
            top: 80%;
            left: 30%;
            animation-delay: 2s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.3;
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
                opacity: 0.8;
            }
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <div class="floating-particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>

        <div class="processing-overlay" id="processingOverlay">
            <div class="loader"></div>
            <div class="loading-text">Processing Payment...</div>
        </div>

        <div class="header">
            <div class="esewa-logo">eSewa</div>
            <h1>Checkout</h1>
            <p class="subtitle">Secure payment gateway</p>
        </div>

        <div class="total-display">
            <div class="total-label">Total Amount</div>
            <div class="total-amount">RS {{ $total }}</div>
            <div class="currency-info">Nepalese Rupees</div>
        </div>

        <div class="form-wrapper">
            <form class="payment-form" action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST" onsubmit="handlePayment(event)" target="_blank">
                <table style="display:none">
                    <tbody>
                        <tr>
                            <input type="hidden" name="success_url" value="{{ route('payment.success') }}">
                            <input type="hidden" name="failure_url" value="{{ route('payment.failure') }}">
                        </tr>
                        <tr>
                            <td><strong>Parameter</strong></td>
                            <td><strong>Value</strong></td>
                        </tr>
                        <tr>
                            <td>Amount:</td>
                            <td><input type="text" id="amount" name="amount" value="{{$total}}" class="form" required=""><br></td>
                        </tr>
                        <tr>
                            <td>Amount:</td>
                            <td><input type="text" id="amount" name="amount" value="{{$total}}" class="form" required=""><br></td>
                        </tr>
                        <tr>
                            <td>Tax Amount:</td>
                            <td><input type="text" id="tax_amount" name="tax_amount" value="0" class="form" required=""></td>
                        </tr>
                        <tr>
                            <td>Total Amount:</td>
                            <td><input type="text" id="total_amount" name="total_amount" value="{{$total}}" class="form" required=""></td>
                        </tr>
                        <tr>
                            <td>Transaction UUID:</td>
                            <td><input type="text" id="transaction_uuid" name="transaction_uuid" value="11-200-111sss1" class="form" required=""></td>
                        </tr>
                        <tr>
                            <td>Product Code:</td>
                            <td><input type="text" id="product_code" name="product_code" value="EPAYTEST" class="form" required=""></td>
                        </tr>
                        <tr>
                            <td>Product Service Charge:</td>
                            <td><input type="text" id="product_service_charge" name="product_service_charge" value="0" class="form" required=""></td>
                        </tr>
                        <tr>
                            <td>Product Delivery Charge:</td>
                            <td><input type="text" id="product_delivery_charge" name="product_delivery_charge" value="0" class="form" required=""></td>
                        </tr>
                        <tr>
                            <td>Success URL:</td>
                            <td><input type="text" id="success_url" name="success_url" value="{{ route('payment.success') }}" class="form" required=""></td>
                        </tr>
                        <tr>
                            <td>Failure URL:</td>
                            <td><input type="text" id="failure_url" name="failure_url" value="{{ route('payment.failure') }}" class="form" required=""></td>
                        </tr>
                        <tr>
                            <td>signed Field Names:</td>
                            <td><input type="text" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" class="form" required=""></td>
                        </tr>
                        <tr>
                            <td>Signature:</td>
                            <td><input type="text" id="signature" name="signature" value="4Ov7pCI1zIOdwtV2BRMUNjz1upIlT/COTxfLhWvVurE=" class="form" required=""></td>
                        </tr>
                        <tr>
                            <td>Secret Key:</td>
                            <td><input type="text" id="secret" name="secret" value="8gBm/:&amp;EnhH.1/q" class="form" required=""></td>
                        </tr>
                    </tbody>
                </table>
                <input value="Pay with eSewa" type="submit" class="pay-button">
            </form>


        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/hmac-sha256.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/enc-base64.min.js"></script>

    <script>
        // Your original signature generation function
        function generateSignature() {
            var currentTime = new Date();
            var formattedTime = currentTime.toISOString().slice(2, 10).replace(/-/g, '') + '-' + currentTime.getHours() +
                currentTime.getMinutes() + currentTime.getSeconds();
            document.getElementById("transaction_uuid").value = formattedTime;
            var total_amount = document.getElementById("total_amount").value;
            var transaction_uuid = document.getElementById("transaction_uuid").value;
            var product_code = document.getElementById("product_code").value;
            var secret = document.getElementById("secret").value;

            var hash = CryptoJS.HmacSHA256(
                `total_amount=${total_amount},transaction_uuid=${transaction_uuid},product_code=${product_code}`,
                `${secret}`);
            var hashInBase64 = CryptoJS.enc.Base64.stringify(hash);
            document.getElementById("signature").value = hashInBase64;
        }

        // Your original event listeners
        document.getElementById("total_amount").addEventListener("input", generateSignature);
        document.getElementById("transaction_uuid").addEventListener("input", generateSignature);
        document.getElementById("product_code").addEventListener("input", generateSignature);
        document.getElementById("secret").addEventListener("input", generateSignature);

        // Enhanced payment handling with UI feedback
        function handlePayment(event) {
            // Call your original generateSignature function
            generateSignature();

            // Show processing overlay
            const overlay = document.getElementById('processingOverlay');
            overlay.classList.add('active');

            // Hide overlay after a delay (in case user returns to page)
            setTimeout(() => {
                overlay.classList.remove('active');
            }, 5000);
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            generateSignature();
        });
    </script>
</body>
</html>

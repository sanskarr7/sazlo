<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
   
</head>
<body>
    <h1>Checkout</h1>
    <p>Total Amount: {{ $total }}</p>
    <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST" onsubmit="generateSignature()" target="_blank">

                    
<table style="display:none">
    <tbody>
        <tr> <input type="hidden" name="success_url" value="{{ route('payment.success') }}">
    <input type="hidden" name="failure_url" value="{{ route('payment.failure') }}">
    
        <tr>
            <td> <strong>Parameter </strong> </td>
            <td><strong>Value</strong></td>
        </tr>
        <tr>
            <td>Amount:</td>
            <td> <input type="text" id="amount" name="amount" value="{{$total}}" class="form" required=""> <br>
            </td>
        </tr>
        <tr>
            <td>Amount:</td>
            <td> <input type="text" id="amount" name="amount" value="{{$total}}" class="form" required=""> <br>
            </td>
        </tr>
        <tr>
            <td>Tax Amount:</td>
            <td><input type="text" id="tax_amount" name="tax_amount" value="0" class="form" required="">
            </td>
        </tr>
        <tr>
            <td>Total Amount:</td>
            <td><input type="text" id="total_amount" name="total_amount" value="{{$total}}" class="form" required="">
            </td>
        </tr>
        <tr>
            <td>Transaction UUID:</td>
            <td><input type="text" id="transaction_uuid" name="transaction_uuid" value="11-200-111sss1" class="form" required=""> </td>
        </tr>
        <tr>
            <td>Product Code:</td>
            <td><input type="text" id="product_code" name="product_code" value="EPAYTEST" class="form" required=""> </td>
        </tr>
        <tr>
            <td>Product Service Charge:</td>
            <td><input type="text" id="product_service_charge" name="product_service_charge" value="0" class="form" required=""> </td>
        </tr>
        <tr>
            <td>Product Delivery Charge:</td>
            <td><input type="text" id="product_delivery_charge" name="product_delivery_charge" value="0" class="form" required=""> </td>
        </tr>
        <tr>
            <td>Success URL:</td>
            <td><input type="text" id="success_url" name="success_url" value="{{ route('payment.success') }}" class="form" required=""> </td>
        </tr>
        <tr>
            <td>Failure URL:</td>
            <td><input type="text" id="failure_url" name="failure_url" value="{{ route('payment.failure') }}"class="form" required=""> </td>
        </tr>
        <tr>
            <td>signed Field Names:</td>
            <td><input type="text" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" class="form" required=""> </td>
        </tr>
        <tr>
            <td>Signature:</td>
            <td><input type="text" id="signature" name="signature" value="4Ov7pCI1zIOdwtV2BRMUNjz1upIlT/COTxfLhWvVurE=" class="form" required=""> </td>
        </tr>
        <tr>
            <td>Secret Key:</td>
            <td><input type="text" id="secret" name="secret" value="8gBm/:&amp;EnhH.1/q" class="form" required="">
            </td>
        </tr>
    </tbody>
</table>
<input value=" Pay with eSewa " type="submit" class="button" style="display:block !important; background-color: #60bb46; cursor: pointer; color: #fff; border: none; padding: 5px 10px;">
</form>
<script>
// Function to auto-generate signature
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

// Event listeners to call generateSignature() when inputs are changed
document.getElementById("total_amount").addEventListener("input", generateSignature);
document.getElementById("transaction_uuid").addEventListener("input", generateSignature);
document.getElementById("product_code").addEventListener("input", generateSignature);
document.getElementById("secret").addEventListener("input", generateSignature);
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/hmac-sha256.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/enc-base64.min.js"></script>


</body>
</html>

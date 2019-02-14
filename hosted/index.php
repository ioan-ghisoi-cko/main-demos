<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JS</title>
</head>

<script>
    function submitForm() {
        document.getElementById('payment-form').submit();
    }
</script>

<body>

    <button onclick="submitForm()">Click here go to Hosted</button>

    <form id="payment-form" style="display:none" action="https://secure1.checkout.com/sandbox/payment/" method="POST">
        <input name="publicKey" value="pk_test_9f28f117-1c9c-49de-b3b4-e583e67f56b7" />
        <input name="customerEmail" value="john@anonymous.com" />
        <input name="value" value="195" />
        <input name="currency" value="USD" />
        <input name="cardFormMode" value="cardTokenisation" />
        <input name="paymentMode" value="cards" />
        <input name="redirectUrl" value="http://cko-js/hosted/server.php" />
        <input name="cancelUrl" value="http://cko-js/hosted/server.php" />
    </form>

</body>

</html>
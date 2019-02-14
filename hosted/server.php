<?php

$cardToken = $_POST['cko-card-token'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://sandbox.checkout.com/api2/v2/charges/token");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization:sk_test_9d9a1778-b39c-43f0-b05f-a6eef4958786',
    'Content-Type:application/json;charset=UTF-8'
    ));
curl_setopt($ch, CURLOPT_POSTFIELDS,
            json_encode(array(
            'value' => '1000',
            'currency' => 'GBP',
            'cardToken' => $cardToken,
            'email' => 'test@email.com',
            'autoCapTime' => '0',
            'autoCapture' => 'Y',
            'chargeMode' => '1'
            )));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);

curl_close ($ch);

$response = json_decode($server_output);

echo '<pre>' . var_export($response, true) . '</pre>';

exit;

?>
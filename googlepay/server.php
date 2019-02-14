<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$signature = $_POST["signature"];
$protocolVersion = $_POST["protocolVersion"];
$signedMessage = $_POST["signedMessage"];

$token_data = array(
	'signature' => $signature,
	'protocolVersion' => $protocolVersion,
	'signedMessage' => $signedMessage,
);

//  GET TOKEN

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://sandbox.checkout.com/api2/tokens");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: pk_test_6e40a700-d563-43cd-89d0-f9bb17d35e73',
    'Content-Type:application/json;charset=UTF-8'
    ));
curl_setopt($ch, CURLOPT_POSTFIELDS,
            json_encode(array(
			'type' => 'googlepay',
			'token_data' => $token_data,
		  	)));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);

curl_close ($ch);

$response = json_decode($server_output);

$GoogleToken = $response->token;


//  CHARGE REQUEST

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://sandbox.checkout.com/api2/v2/charges/token");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: sk_test_43ed9a7f-4799-461d-b201-a70507878b51',
    'Content-Type:application/json;charset=UTF-8'
    ));
curl_setopt($ch, CURLOPT_POSTFIELDS,
            json_encode(array(
			'value' => '100',
			'currency' => 'USD',
			'trackId' => 'trkID1231',
			'chargeMode' => '1',
			'transactionIndicator' => '2',
			'cardToken' => $GoogleToken, // the card token generated in the previous step
			'customerName'=> 'back end name',
			'email' => "testme@email.com",
			'autoCapture' => 'Y',  // meaning that you want to capture the payment automatically
			'autoCapTime' => '0', // meaning that you want to capture the payment with 0 delay (ASAP)
		  	)));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);

curl_close ($ch);

$response = json_decode($server_output);


echo('<pre>'.print_r($response, true).'</pre>');

exit();

?>


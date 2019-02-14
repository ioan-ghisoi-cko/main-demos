<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$cardToken = $_POST['cko-card-token'];
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://sandbox.checkout.com/api2/v2/charges/token");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: sk_test_43ed9a7f-4799-461d-b201-a70507878b51',
    'Content-Type:application/json;charset=UTF-8'
    ));
curl_setopt($ch, CURLOPT_POSTFIELDS,
            json_encode(array(
			'value' => '10000',
			'currency' => 'USD',
			'	trackId' => 'trkID1231',
			'chargeMode' => '1',
			'transactionIndicator' => '2',
			'cardToken' => $cardToken, // the card token generated in the previous step
			'customerName'=> 'back end name',
			'email' => "testme@email.com",
			'autoCapTime' => '0',
			'autoCapture' => 'Y',
		  	)));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);

curl_close ($ch);

$response = json_decode($server_output);

// This form is only meant for demo purposes

echo '<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">';

echo "<div class='container' style='margin-top: 20px;'>
        <div class='jumbotron'>
            <h1>Done</h1></h1>
            <p>This is the Charge Id that you can use to capture the transaction that has just been authorised: <mark>".$response->id."</mark></p>
            <p> Click the button bellow to capture</p>
            
            <form action='capture.php'>
                <input type='hidden' name='charge-id' value='".$response->id."'><br>
                <input class='btn btn-success' type='submit' value='CAPTURE'>
            </form>
       
        </div>
      </div>";

exit();

?>


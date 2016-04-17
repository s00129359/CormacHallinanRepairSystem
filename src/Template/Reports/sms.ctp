<?php
// this line loads the library 
require('C:\xampp\webdav\CormacHallinanRepairSystem\vendor\twilio\sdk\Services/Twilio.php'); 
// require('/path/to/twilio-php/Services/Twilio.php'); 
 
$account_sid = 'AC06381dc8a0d0d4066159e4652060c501'; 
$auth_token = 'c72ba837981239bda03d14b9c8e3725c'; 
$client = new Services_Twilio($account_sid, $auth_token); 
 
$client->account->messages->create(array( 
    'To' => "+353879719321", 
    'From' => "+353766801374", 
    'Body' => "hello how are you",   
));


//https://github.com/messagebird/php-rest-api/tree/master/examples
//https://www.messagebird.com/developers/php
//https://github.com/messagebird/php-rest-api/blob/master/examples/message-create-unicode.php

//https://zapier.com/sign-up/?next=/zapbook/create/App14812API/get_lists/SMSAPI/send

// // require_once(__DIR__ . '
// require_once('C:\xampp\webdav\RepairSystemS00129359\php-rest-api-master/autoload.php');
// $MessageBird = new \MessageBird\Client('live_xAQKov6ShPOJF3wCWUcNm93Lp'); // Set your own API access key here.
// $Message             = new \MessageBird\Objects\Message();
// $Message->originator = 'MessageBird';
// $Message->recipients = array(+353879719321);
// $Message->body       = 'This is a test message with a smiling emoji 😀.';
// $Message->datacoding = 'unicode';
// try {
// 	echo "1<br>";
//     $MessageResult = $MessageBird->messages->create($Message);
//     echo "2<br>";
//     var_dump($MessageResult);
// } catch (\MessageBird\Exceptions\AuthenticateException $e) {
//     // That means that your accessKey is unknown
//     echo 'wrong login';
// } catch (\MessageBird\Exceptions\BalanceException $e) {
//     // That means that you are out of credits, so do something about it.
//     echo 'no balance';
// } catch (\Exception $e) {
//     echo $e->getMessage();
// }

// $CustName = $report->customer->fName;
// $CustSName = $report->customer->sName;
// $fullName = $CustName ." " . $CustSName;
// $Number = $report->customer->mobile;
// $item = $report->equipment;

//  $message = "Hello ".$CustName.", your ".$item." has been repaired and is now ready to collect from Cormac Hallinan S00129359. <br> Any queries you can contact us on 087-9719321";
//  echo "$message <br>";

// //reomve the 0
// $str = ltrim($Number, '0');

// //add 353
// $SmsNumber = "353".$str;
// echo $SmsNumber;

?>

<div class="MainDiv" style="text-align: center">
	<h1>Are you Sure you wish to send?</h1>
	
            <p>To : <?= $fullName ?>  </p>
			<p>Msg : <?= $message ?>  </p>
			<p> Number : <?= $Number ?> </p>
	<button id="yes">Yes</button>
	<button id="no">No</button>
</div>

// <script type="text/javascript">
//     $(document).ready(function(){

//     $("#yes").click(function(){
//     	var api = "<?= $api ?>"
//         alert(api);
//          window.open(api,'_blank');
//          window.close();  
//     });

// });
// </script>
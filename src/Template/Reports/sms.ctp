<?php
$CustName = $report->customer->fName;
$CustSName = $report->customer->sName;
$fullName = $CustName ." " . $CustSName;
$Number = $report->customer->mobile;
$item = $report->equipment;

 $message = "Hello ".$CustName.", your ".$item." has been repaired and is now ready to collect from Cormac Hallinan S00129359. <br> Any queries you can contact us on 087-9719321";
 echo "$message <br>";

//reomve the 0
$str = ltrim($Number, '0');

//add 353
$SmsNumber = "353".$str;
echo $SmsNumber;

// this line loads the library 
require('C:\xampp\webdav\RepairSystemS00129359\twilio-twilio-php-292fef4\Services/Twilio.php'); 
 
$account_sid = 'ACdfc9ddbbfe2501788e3c349939c9a2ba'; 
$auth_token = '4ec697d20a5f96720973d62ef4a39f38'; 

$http = new Services_Twilio_TinyHttp(
    'https://api.twilio.com',
    array('curlopts' => array(
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
    ))
);

$client = new Services_Twilio($account_sid, $auth_token, "2010-04-01", $http);
 $message = $client->account->messages->sendMessage(
  '+353766801326', // From a Twilio number in your account
  '+353879719321', // Text any number
  "Hello monkey!"
);

print $message->sid;


//////////////////////////////////////////////////////
//api URL
 $api = "http://api.clickatell.com/http/sendmsg?user=cormach&password=KDVcQJLfQXJUER&api_id=3579162&to=" . $SmsNumber . "&text=" . $message;

?>

<!-- <div class="MainDiv" style="text-align: center">
	<h1>Are you Sure you wish to send?</h1>
	
            <p>To : <?= $fullName ?>  </p>
			<p>Msg : <?= $message ?>  </p>
			<p> Number : <?= $Number ?> </p>
	<button id="yes">Yes</button>
	<button id="no">No</button>
</div> -->

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
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
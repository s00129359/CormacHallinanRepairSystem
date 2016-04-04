<?php 
foreach ($reports as $report) {
    echo $report->id;
    echo "++++++++++";
    echo $report->customer->fName;
    echo "++++++++++";
    echo $report->finished;
    echo "<br>";
}

?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Reports</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><?= $this->Html->link(__('Add Report'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('KPIs'), ['action' => 'kpi']) ?></li>
        <li><?= $this->Html->link(__('Admin'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Log Out'), ['controller' => 'Users', 'action' => 'logout']) ?></li>
      </ul>
        
      <!-- </ul> -->
    </div>
  </div>
</nav>

<div id="tableWrapper">
<div id="tableContainer" class="tableContainer">
<div class="MainDiv">

    <h3><?= __('Reports') ?></h3>
    <h4 style="color: #BF0026">Open reports : <?php echo $open; ?></h4>

    <!-- Create Table to view reports -->
    <table class="table table-striped table-responsive" id="indxTbl">
        <thead>
            <tr>
                <!-- Table Head -->
                <th><?= __('Ticket Id') ?></th>
                <th><?= __('customer') ?></th>
                <th><?= __('SMS') ?></th>
                <th><?= __('Finished?') ?></th>
                <th><?= __('Equipment') ?></th>
                <th><?= __('Brand') ?></th>
                <th><?= $this->Paginator->sort('priority', null, ['direction' => 'desc']) ?></th>
                <th><?= __('Edit') ?></th>
            </tr>
        </thead>

        <tbody id="scrollit">

            <?php             
            //Foreach loop top loop through each row of table
            foreach ($reports as $report): 
            //For table to say if its "high" OR "Normal" Priority
            //Its a bool so if checkbox for high priority checked
            // it will be True = 1 therefore high priority
            $Priority = $report->priority;
            if ($Priority== 1) {
                $PriorityStatus = "High";
                $priorityColor = "#ff1a1a";
            }
            //If priority checkbox was left unchecked
            //It will be False = 1 therefore low priority
            else{
                $PriorityStatus = "Normal";
                $priorityColor = "black";

            }

            //To Say if the Report is open or Closed-Finished
            //Report Stays open until clicked as closed
            //to close click and redirect to page where PHP changes
            //Open to Closed
            $Status = $report->finished;
            
            //If its been closed bool = 1
            if ($Status == 1) {
                $ticketStatus = "Closed";
                $ticketColor = "#3399ff";
            }
            //if it asent been closed yet bool = 0
            else{
                $ticketStatus = "Open";
                $ticketColor = "#008000";
            }
            
            //Get Full Name
            $fName = $report->customer->fName;
            $sName = $report->customer->sName;
            //Concat First and Second name
            $fullName = $fName . " " . "$sName";

            //Get Mobile number to send SMS
            $SmsNumber = $report->customer->mobile;
            //have they opted in to get SMS?
            $SmsOpt = $report->sms_list;
            $color = "";
            if ($SmsOpt == 1) {
                $color = "blue";
                $value = "1";
            }
            elseif ($SmsOpt == 0) {
                $color = "red";
                $value = "0";
            }

            ?>
            
                
            <tr id="<?= $report->id ?>">
                <td>
                <?= 
                $this->Html->link($report->id, 
                ['action' => 'view', 
                $report->id]) 
                ?>
                </td>

                <!-- View Customer ny clicking And
                    have Customers first Name displayed-->
                <td><?= $report->has('customer') ? 
                $this->Html->link($fullName, 
                ['controller' => 'Customers', 'action' => 'view', 
                $report->customer->id]) : '' ?>
                </td>

                                <!-- SMS -->
                <td class="sms" id="<?= $value ?>" style="color: <?= $color ?> "><?= h($SmsNumber) ?></td>

                <!-- Add Repair Status -->
                <td style="color: <?= $ticketColor ?> "><?= h($ticketStatus) ?></td>
                <td><?= h($report->equipment) ?></td>
                <td><?= h($report->brand) ?></td>
                <!-- Add Priority Status -->
                <td style="color: <?= $priorityColor ?>"><?= h($PriorityStatus) ?></td>



                <td>            
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $report->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>


    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>

</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){

    document.getElementById("1").style.cursor = "pointer";
    document.getElementById("0").style.cursor = "not-allowed";
    // $(.sms).hover(function(){
    //     cursor: hand;
    // });

    $(".sms").click(function(){
        var $SmsNumber = $(this).text();
        var $SmsOpt = event.target.id;
        var $reportId = $(this).closest('tr').attr('id');
        var $send = "/reports/sms/";
        var $route = $send + $reportId;
        if ($SmsOpt == 1) {
            alert("send to "+ $SmsNumber);
            alert($send + $reportId);
            window.open($route,'_blank');
        }
        else{
            alert("Cant send");
        }

    });

});
</script>
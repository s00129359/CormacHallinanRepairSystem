<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="/reports">Reports</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><?= $this->Html->link(__('Add Report'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Admin'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
    
      </ul>
        <a href="users/logout"><span class="glyphicon glyphicon-log-in"></span> Log Out</a>
      </ul>
    </div>
  </div>
</nav>

<div class="MainDiv">
    <fieldset>
        <legend><?= __('View Kpi') ?></legend>
        <h3>Average Tickets Per customer</h3>
        <p><?php
        $avgTickets = $open / $distinct;
        echo $avgTickets;
         ?> Open Ticket Average Per Employee</p>

        <h3>Average Tickets Open Time</h3>
        <p><?php 
                $count = 0;
        $reportTime = 0;
        foreach($closed as $clsd => $cl){
          $count++;
            $openDate = $cl->created;
            $closdDate = $cl->completed_date;
            $totalTime = $openDate->diff($closdDate);

          $totalTime = $totalTime->format("%a");
          
          $totalTimeInt = (int)$totalTime;

          $reportTime += $totalTimeInt;

        
        }

        $AverageOpenTime = $reportTime / $count;
        $AverageOpenTimeFormat = number_format($AverageOpenTime, 2, '.', '');
         echo $AverageOpenTimeFormat;
         ?> Days Open</p>

        <h3>Number of Open Tickets per Employee</h3>
        <h3></h3>
    </fieldset>
</div>

<?php 

?>
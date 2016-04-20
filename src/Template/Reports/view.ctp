<?php
//PHP must be at top of page to get what variables are needed to fill the form

//GET Admin FULL NAME
$AdmFName = $report->user->fName;
$AdmSName = $report->user->sName;
$AdmFullName = $AdmFName . " " . $AdmSName;

//GET CUSTOMER FULL NAME
$CusFName = $report->customer->fName;
$CusSName = $report->customer->sName;
$CusFullName = $CusFName . " " . $CusSName;

//Changeing Date From Month/Day/Year TO => Day/Month/Year
// Time in AM / PM CakePhp Default
$CreatedDate = $report->created;
$ModifiedDate = $report->modified;

//d-m-Y = day, month & year(full)
//g:i a = time in am/pm
$NewCreatedDate = date("d-m-Y, g:i a", strtotime($CreatedDate));
$NewModifiedDate = date("d-m-Y, g:i a", strtotime($CreatedDate));

?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="/reports">reports</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><?= $this->Html->link(__('Edit Report'), ['action' => 'edit', $report->id]) ?> </li>
        <li><?= $this->Html->link(__('New Report'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Employees'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('Log Out'), ['controller' => 'Users', 'action' => 'logout']) ?></li>
    
      </ul>
      </ul>
    </div>
  </div>
</nav>


<div class="MainDiv">

        <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($report->description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Notes') ?></h4>
        <?= $this->Text->autoParagraph(h($report->notes)); ?>
    </div>
    <div class="row">
        <h4><?= __('Conclusion') ?></h4>
        <?= $this->Text->autoParagraph(h($report->conclusion)); ?>
    </div>

    <table class="vertical-table" tdd>
        <tr>
            <td><?= __('Entered By') ?></td>
            <td>
            <!-- DISPLAY ADMIN BY NAME -->
            <?= $report->has('user') ? $this->Html->link($AdmFullName,
            // VALUE IS ADMIN ID 
            ['controller' => 'Users', 'action' => 'view', $report->user->id]) 
            : '' ?>
            </td>
        </tr>
        <tr>
            <td><?= __('Customer') ?></td>
            <td style="text-align: left;">
            <!-- DISPLAY CUSTOMER BY FULL NAME -->
            <?= $report->has('customer') ? $this->Html->link($CusFullName, 
            // VALUE IS CUSTOMER ID 
            ['controller' => 'Customers', 'action' => 'view', $report->customer->id]) : '' ?>
            </td>
        </tr>
        <tr>
            <td><?= __('Equipment') ?></td>
            <td><?= h($report->equipment) ?></td>
        </tr>
        <tr>
            <td><?= __('Brand') ?></td>
            <td><?= h($report->brand) ?></td>
        </tr>
        <tr>
            <td><?= __('Accessories') ?></td>
            <td><?= h($report->accessories) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($report->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Amount Due') ?></td>
            <td><?= $this->Number->format($report->amount_due) ?></td>
        </tr>
        <tr>
<!--    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////
        /////////////////////////////////////////////////////
        ///////////////////////////////////////////////////// -->
            <td><?= __('Created') ?></td>
            <!-- Var to display date d-m-Y -->
            <td><?= h($NewCreatedDate) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <!-- Var to display date d-m-Y -->
            <td><?= h($NewModifiedDate) ?></td>
        </tr>
        <tr>
            <td><?= __('Completed Date') ?></td>
            <td><?= h($report->completed_date) ?></td>
        </tr>
        <tr>
            <td><?= __('SmsSendDate') ?></td>
            <td><?= h($report->smsSendDate) ?></td>
        </tr>
        <tr>
            <td><?= __('EmailSendDate') ?></td>
            <td><?= h($report->emailSendDate) ?></td>
        </tr>
        <tr>
            <td><?= __('Priority') ?></td>
            <td><?= $report->priority ? __('Yes') : __('No'); ?></td>
         </tr>
        <tr>
            <td><?= __('Finished') ?></td>
            <td><?= $report->finished ? __('Yes') : __('No'); ?></td>
         </tr>
        <tr>
            <td><?= __('Paid Status') ?></td>
            <td><?= $report->paid_status ? __('Yes') : __('No'); ?></td>
         </tr>
        <tr>
            <td><?= __('Sms List') ?></td>
            <td><?= $report->sms_list ? __('Yes') : __('No'); ?></td>
         </tr>
        <tr>
            <td><?= __('Email List') ?></td>
            <td><?= $report->email_list ? __('Yes') : __('No'); ?></td>
         </tr>
    </table>

</div>

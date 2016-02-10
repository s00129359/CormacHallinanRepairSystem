<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="/customers">Customers</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><?= $this->Html->link(__('Edit Customer'), ['action' => 'edit', $customer->id]) ?> </li>
        <li><?= $this->Html->link(__('Add Customer'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Reports'), ['controller' => 'Reports', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
    
        <!-- <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 3</a></li> -->
      </ul>
<!--       <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul> -->
    </div>
  </div>
</nav>

<div class="MainDiv">
    <h3><?= h($customer->id) ?></h3>
    <table class="vertical-table" >
        <tr>
            <td><?= __('FName') ?></td>
            <td><?= h($customer->fName) ?></td>
        </tr>
        <tr>
            <td><?= __('SName') ?></td>
            <td><?= h($customer->sName) ?></td>
        </tr>
        <tr>
            <td><?= __('Address1') ?></td>
            <td><?= h($customer->address1) ?></td>
        </tr>
        <tr>
            <td><?= __('Address2') ?></td>
            <td><?= h($customer->address2) ?></td>
        </tr>
        <tr>
            <td><?= __('County') ?></td>
            <td><?= h($customer->county) ?></td>
        </tr>
        <tr>
            <td><?= __('Mobile') ?></td>
            <td><?= h($customer->mobile) ?></td>
        </tr>
        <tr>
            <td><?= __('Email') ?></td>
            <td><?= h($customer->email) ?></td>
        </tr>
        <tr>
            <td><?= __('Landline') ?></td>
            <td><?= h($customer->landline) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($customer->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($customer->created) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Reports') ?></h4>
        <?php if (!empty($customer->reports)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>

                <th><?= __('Report Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Equipment') ?></th>
                <th><?= __('Finished') ?></th>
                <th><?= __('Paid Status') ?></th>
            </tr>
            <?php foreach ($customer->reports as $reports): 
            $finishedStatus = $reports->finished;
            $paymentStatus = $reports->paid_status;
        
            //If its been closed bool = 1
            if ($finishedStatus == 1) {
                $StatusStatus = "Closed";
            }
            //if it asent been closed yet bool = 0
            else{
                $StatusStatus = "Open";
            }

            //If its been payed bool = 1
            if ($paymentStatus == 1) {
                $payStatus = "Paid";
            }
            //if it asent been closed yet bool = 0
            else{
                $payStatus = "Not Paid";
            }
            $rId = $reports->id;
            $cId
            ?>
            <tr>
                

                <td>
                <?= 
                $this->Html->link($reports->id, 
                ['controller' => 'Reports', 'action' => 'view', 
                $reports->id]) 
                ?>
                </td>
                <td><?= h($reports->user_id) ?></td>
                <td><?= h($reports->equipment) ?></td>
                <td><?= h($StatusStatus) ?></td>
                <td><?= h($payStatus) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>
</div>

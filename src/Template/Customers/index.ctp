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
        <li><?= $this->Html->link(__('Add Customer'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Reports'), ['controller' => 'Reports', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
    
      </ul>
        <a href="users/logout"><span class="glyphicon glyphicon-log-in"></span> Log Out</a>
      </ul>
    </div>
  </div>
</nav>

<div id="tableWrapper">
<div id="tableContainer" class="tableContainer">
    
<div class="MainDiv">
    <h3><?= __('Customers') ?></h3>
    
    <table class="table table-striped table-responsive" id="indxTbl">
        <thead>
            <tr>
                <th><?= __('Id') ?></th>                
                <th><?= __('Name') ?></th>                
                <th><?= __('County') ?></th>                
                <th><?= __('Mobile') ?></th>                
                <th><?= __('Edit') ?></th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer):
            $fName = $customer->fName; 
            $sName = $customer->sName;
            $fullName = $fName ." " . $sName;
            ?>
            <tr>
                <td><?= 
                $this->Html->link($customer->id, 
                ['action' => 'view', 
                $customer->id]) 
                ?></td>
                <td><?= h($fullName) ?></td>
                <td><?= h($customer->county) ?></td>
                <td><?= h($customer->mobile) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $customer->id]) ?>
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

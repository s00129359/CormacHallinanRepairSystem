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
                <li><?= $this->Html->link(__('Log Out'), ['controller' => 'Users', 'action' => 'logout']) ?></li>
      </ul>
      </ul>
    </div>
  </div>
</nav>

<div class="MainDiv">
<legend><?= __('Add Report') ?></legend>
    <table class="table table-striped table-responsive" id="indxTbl">
        <thead>
            <tr>
                <!-- Table Head -->
                <th><?= __('Report Id') ?></th>
                <th><?= __('Employee') ?></th>
                <th><?= __('Collected') ?></th>
                <th><?= __('Completed On?') ?></th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($unCollected as $collect): ?>
        	<tr>
        	<td><?= h($collect->customer_id) ?></td>
        	<td><?= h($collect->user_id) ?></td>
        	<td><?= h($collect->collected) ?></td>
        	<td><?= h($collect->completed_date) ?></td>
        	</tr>
        <?php endforeach; ?>

        </tbody>
      </table>
</div>
 

</div>
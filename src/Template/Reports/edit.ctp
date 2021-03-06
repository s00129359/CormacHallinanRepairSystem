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
        <li><?= $this->Html->link(__('Admin'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('Log Out'), ['controller' => 'Users', 'action' => 'logout']) ?></li>
      </ul>
      </ul>
    </div>
  </div>
</nav>

<div class="MainDiv">
    <?= $this->Form->create($report) ?>
    <fieldset>
        <legend><?= __('Edit Report') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('customer_id', ['options' => $customers]);
            echo $this->Form->input('equipment');
            echo $this->Form->input('brand');
            echo $this->Form->input('description');
            echo $this->Form->input('accessories');
            echo $this->Form->input('notes');
            echo $this->Form->input('priority');
            echo $this->Form->input('finished',[
                "onclick"=>'if(this.checked){myFunction()}'
                ]);
            echo $this->Form->input('conclusion');
            echo $this->Form->input('completed_date',[
                 'disabled' => true,
                   // 'class' => 'compDate'
                
                ]);
            echo $this->Form->input('paid_status');
            echo $this->Form->input('amount_due');
            echo $this->Form->input('sms_list');
            echo $this->Form->input('email_list');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<script>
function myFunction() {
    // alert("hi");
    document.getElementsByClassName("compDate").disabled = true;
    // alert("hi2");

}
</script>
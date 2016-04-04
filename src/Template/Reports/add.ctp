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
    <?= $this->Form->create($report) ?>

    <fieldset>
        <legend><?= __('Add Report') ?></legend>
        <?php
        // var_dump($customer);

            //TO put a VALUE and Option for Dropdown
            // Value = ID
            //Option = email
        $adminOption = array();

            foreach ($users as $user){
                $uID = $user['id'];
                $uEmail = $user['email'];
            $adminOption[] = ["$uID" => $uEmail];
            }

            //Get Items from database
            // foreach ($items as $item){
            //     $itemID = $user['Id'];
            //     $itemName = $user['Name'];
            // $itemOption[] = ["$itemID" => $itemName];
            // }

            // Value = ID
            //Option = First and Second name concat
            // $custOption = array();
            foreach ($customers as $customer){
                $custId = $customer['id'];
                $custFirstName = $customer['fName'];
                $custSurName = $customer['sName'];
                $custMobile = $customer['mobile'];
                $custEmail = $customer['email'];

                //concatonate
                $FullName = $custFirstName." ".$custSurName;
                //show customers full and mobile and landline for recognition 
            $custOption[] = ["$custId" => "$FullName    ( $custMobile  ) ( $custEmail )"];
            }

            //Form Input Fields => user
            echo $this->Form->input('user_id', ['options' => $adminOption]);
            
            //Button to add customer
            echo $this->Html->link(
                                    'Add Customer',
                                    '/customers/add',
                                    ['class' => 'btnAdd']
                                    // ['class' => 'button', 'target' => '_blank']
                                    );

            //Form Input Fields => add customer
            echo $this->Form->input('customer_id', ['options' => $custOption]);
            ?>
            <br>
            <?php
            
            //Button to add Equipment
            echo $this->Html->link(
                                    'Add Equipment',
                                    '/items/add',
                                    ['class' => 'btnAdd0']
                                    // ['class' => 'button', 'target' => '_blank']
                                    );

            //Add Items from Database
            // echo $this->Form->input('equipment', ['options' => $itemOption]);

            echo $this->Form->input('brand');
            echo $this->Form->input('description');
            echo $this->Form->input('accessories');
            echo $this->Form->input('notes');
            echo $this->Form->input('priority');
            echo $this->Form->input('sms_list');
            echo $this->Form->input('email_list');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>



 <script type="text/javascript">
 // alert("hio");
 window.onload = function() {
    $("#customer-id").select2();
    $(".js-example-basic-single").select2();
}
 </script>
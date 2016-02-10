 <script type="text/javascript">
 // alert("hio");
 window.onload = function() {
    $("#customer-id").select2();
    $(".js-example-basic-single").select2();
}
 </script>

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
    <?= $this->Form->create($report) ?>

    <fieldset>
        <legend><?= __('Add Report') ?></legend>
        <?php
            //TO put a VALUE and Option for Dropdown
            // Value = ID
            //Optio = email
        $adminOption = array();
            foreach ($users as $user){
                $uID = $user['id'];
                $uEmail = $user['email'];
            $adminOption[] = ["$uID" => $uEmail];
            }

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


            echo $this->Form->input('equipment');
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




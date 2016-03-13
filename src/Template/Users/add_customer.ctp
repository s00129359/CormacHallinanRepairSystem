<?php

    $id = $this->request->session()->read('Config.id');
    $email = $this->request->session()->read('Config.email');
?>

<div class="MainDiv">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Add Customer Account') ?></legend>
        <?php
            echo $this->Form->input('customerId', ['value' => $id]);
            echo $this->Form->input('role', ['value' => 'customer']);
            echo $this->Form->input('email', ['value' => $email]);
            echo $this->Form->input('password');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
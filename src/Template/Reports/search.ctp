   <?php
    echo $this->Form->create();
    // You'll need to populate $authors in the template from your controller
    echo $this->Form->input('id');
    // Match the search param in your table configuration
    echo $this->Form->input('q');
    echo $this->Form->button('Filter', ['type' => 'submit']);
    echo $this->Html->link('Reset', ['action' => 'search']);
    echo $this->Form->end();
    ?>
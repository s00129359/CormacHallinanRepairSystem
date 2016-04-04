<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Item'), ['action' => 'edit', $item->Id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Item'), ['action' => 'delete', $item->Id], ['confirm' => __('Are you sure you want to delete # {0}?', $item->Id)]) ?> </li>
        <li><?= $this->Html->link(__('List Items'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="items view large-9 medium-8 columns content">
    <h3><?= h($item->Id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($item->Name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($item->Id) ?></td>
        </tr>
    </table>
</div>

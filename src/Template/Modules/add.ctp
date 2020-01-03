<?php /**/ ?>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Acl Modules'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Acl Module Action Groups'), ['controller' => 'AclModuleActionGroups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Acl Module Action Group'), ['controller' => 'AclModuleActionGroups', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="aclModules form large-10 medium-9 columns">
    <?= $this->Form->create($aclModule) ?>
    <fieldset>
        <legend><?= __('Add Acl Module') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('handle');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

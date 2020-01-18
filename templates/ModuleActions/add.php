<?php /**/ ?>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Acl Module Actions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Acl Module Action Groups'), ['controller' => 'AclModuleActionGroups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Acl Module Action Group'), ['controller' => 'AclModuleActionGroups', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Acl Role Actions'), ['controller' => 'AclRoleActions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Acl Role Action'), ['controller' => 'AclRoleActions', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="aclModuleActions form large-10 medium-9 columns">
    <?= $this->Form->create($aclModuleAction) ?>
    <fieldset>
        <legend><?= __('Add Acl Module Action') ?></legend>
        <?php
            echo $this->Form->input('acl_module_action_group_id', ['options' => $aclModuleActionGroups, 'empty' => true]);
            echo $this->Form->input('name');
            echo $this->Form->input('handle');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

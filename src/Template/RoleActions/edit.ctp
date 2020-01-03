<?php /**/ ?>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $aclRoleAction->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $aclRoleAction->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Acl Role Actions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Acl Roles'), ['controller' => 'AclRoles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Acl Role'), ['controller' => 'AclRoles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Acl Module Actions'), ['controller' => 'AclModuleActions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Acl Module Action'), ['controller' => 'AclModuleActions', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="aclRoleActions form large-10 medium-9 columns">
    <?= $this->Form->create($aclRoleAction) ?>
    <fieldset>
        <legend><?= __('Edit Acl Role Action') ?></legend>
        <?php
            echo $this->Form->input('acl_role_id', ['options' => $aclRoles, 'empty' => true]);
            echo $this->Form->input('acl_module_action_id', ['options' => $aclModuleActions, 'empty' => true]);
            echo $this->Form->input('assigned_by');
            echo $this->Form->input('transaction_key');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

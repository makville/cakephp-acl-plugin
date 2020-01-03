<?php /**/ ?>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Acl Role Action'), ['action' => 'edit', $aclRoleAction->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Acl Role Action'), ['action' => 'delete', $aclRoleAction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aclRoleAction->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Acl Role Actions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Acl Role Action'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Acl Roles'), ['controller' => 'AclRoles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Acl Role'), ['controller' => 'AclRoles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Acl Module Actions'), ['controller' => 'AclModuleActions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Acl Module Action'), ['controller' => 'AclModuleActions', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="aclRoleActions view large-10 medium-9 columns">
    <h2><?= h($aclRoleAction->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Acl Role') ?></h6>
            <p><?= $aclRoleAction->has('acl_role') ? $this->Html->link($aclRoleAction->acl_role->name, ['controller' => 'AclRoles', 'action' => 'view', $aclRoleAction->acl_role->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Acl Module Action') ?></h6>
            <p><?= $aclRoleAction->has('acl_module_action') ? $this->Html->link($aclRoleAction->acl_module_action->name, ['controller' => 'AclModuleActions', 'action' => 'view', $aclRoleAction->acl_module_action->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Transaction Key') ?></h6>
            <p><?= h($aclRoleAction->transaction_key) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($aclRoleAction->id) ?></p>
            <h6 class="subheader"><?= __('Assigned By') ?></h6>
            <p><?= $this->Number->format($aclRoleAction->assigned_by) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($aclRoleAction->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($aclRoleAction->modified) ?></p>
        </div>
    </div>
</div>

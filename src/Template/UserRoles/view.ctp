<?php /**/ ?>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Acl User Role'), ['action' => 'edit', $aclUserRole->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Acl User Role'), ['action' => 'delete', $aclUserRole->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aclUserRole->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Acl User Roles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Acl User Role'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Acl Users'), ['controller' => 'AclUsers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Acl User'), ['controller' => 'AclUsers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Acl Roles'), ['controller' => 'AclRoles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Acl Role'), ['controller' => 'AclRoles', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="aclUserRoles view large-10 medium-9 columns">
    <h2><?= h($aclUserRole->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Acl User') ?></h6>
            <p><?= $aclUserRole->has('acl_user') ? $this->Html->link($aclUserRole->acl_user->id, ['controller' => 'AclUsers', 'action' => 'view', $aclUserRole->acl_user->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Acl Role') ?></h6>
            <p><?= $aclUserRole->has('acl_role') ? $this->Html->link($aclUserRole->acl_role->name, ['controller' => 'AclRoles', 'action' => 'view', $aclUserRole->acl_role->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($aclUserRole->id) ?></p>
            <h6 class="subheader"><?= __('Assigned By') ?></h6>
            <p><?= $this->Number->format($aclUserRole->assigned_by) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($aclUserRole->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($aclUserRole->modified) ?></p>
        </div>
    </div>
</div>

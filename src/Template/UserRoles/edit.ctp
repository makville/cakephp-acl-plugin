<?php /**/ ?>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $aclUserRole->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $aclUserRole->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Acl User Roles'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Acl Users'), ['controller' => 'AclUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Acl User'), ['controller' => 'AclUsers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Acl Roles'), ['controller' => 'AclRoles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Acl Role'), ['controller' => 'AclRoles', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="aclUserRoles form large-10 medium-9 columns">
    <?= $this->Form->create($aclUserRole) ?>
    <fieldset>
        <legend><?= __('Edit Acl User Role') ?></legend>
        <?php
            echo $this->Form->input('acl_user_id', ['options' => $aclUsers, 'empty' => true]);
            echo $this->Form->input('acl_role_id', ['options' => $aclRoles, 'empty' => true]);
            echo $this->Form->input('assigned_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

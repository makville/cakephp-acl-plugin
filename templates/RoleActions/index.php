<?php /**/ ?>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Acl Role Action'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Acl Roles'), ['controller' => 'AclRoles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Acl Role'), ['controller' => 'AclRoles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Acl Module Actions'), ['controller' => 'AclModuleActions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Acl Module Action'), ['controller' => 'AclModuleActions', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="aclRoleActions index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('acl_role_id') ?></th>
            <th><?= $this->Paginator->sort('acl_module_action_id') ?></th>
            <th><?= $this->Paginator->sort('assigned_by') ?></th>
            <th><?= $this->Paginator->sort('transaction_key') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($aclRoleActions as $aclRoleAction): ?>
        <tr>
            <td><?= $this->Number->format($aclRoleAction->id) ?></td>
            <td>
                <?= $aclRoleAction->has('acl_role') ? $this->Html->link($aclRoleAction->acl_role->name, ['controller' => 'AclRoles', 'action' => 'view', $aclRoleAction->acl_role->id]) : '' ?>
            </td>
            <td>
                <?= $aclRoleAction->has('acl_module_action') ? $this->Html->link($aclRoleAction->acl_module_action->name, ['controller' => 'AclModuleActions', 'action' => 'view', $aclRoleAction->acl_module_action->id]) : '' ?>
            </td>
            <td><?= $this->Number->format($aclRoleAction->assigned_by) ?></td>
            <td><?= h($aclRoleAction->transaction_key) ?></td>
            <td><?= h($aclRoleAction->created) ?></td>
            <td><?= h($aclRoleAction->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $aclRoleAction->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $aclRoleAction->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $aclRoleAction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aclRoleAction->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>

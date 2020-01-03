<?php /**/ ?>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Acl User Role'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Acl Users'), ['controller' => 'AclUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Acl User'), ['controller' => 'AclUsers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Acl Roles'), ['controller' => 'AclRoles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Acl Role'), ['controller' => 'AclRoles', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="aclUserRoles index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('acl_user_id') ?></th>
            <th><?= $this->Paginator->sort('acl_role_id') ?></th>
            <th><?= $this->Paginator->sort('assigned_by') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($aclUserRoles as $aclUserRole): ?>
        <tr>
            <td><?= $this->Number->format($aclUserRole->id) ?></td>
            <td>
                <?= $aclUserRole->has('acl_user') ? $this->Html->link($aclUserRole->acl_user->id, ['controller' => 'AclUsers', 'action' => 'view', $aclUserRole->acl_user->id]) : '' ?>
            </td>
            <td>
                <?= $aclUserRole->has('acl_role') ? $this->Html->link($aclUserRole->acl_role->name, ['controller' => 'AclRoles', 'action' => 'view', $aclUserRole->acl_role->id]) : '' ?>
            </td>
            <td><?= $this->Number->format($aclUserRole->assigned_by) ?></td>
            <td><?= h($aclUserRole->created) ?></td>
            <td><?= h($aclUserRole->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $aclUserRole->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $aclUserRole->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $aclUserRole->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aclUserRole->id)]) ?>
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

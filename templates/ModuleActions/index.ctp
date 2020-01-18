<?php /**/ ?>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Acl Module Action'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Acl Module Action Groups'), ['controller' => 'AclModuleActionGroups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Acl Module Action Group'), ['controller' => 'AclModuleActionGroups', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Acl Role Actions'), ['controller' => 'AclRoleActions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Acl Role Action'), ['controller' => 'AclRoleActions', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="aclModuleActions index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('acl_module_action_group_id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('handle') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($aclModuleActions as $aclModuleAction): ?>
        <tr>
            <td><?= $this->Number->format($aclModuleAction->id) ?></td>
            <td>
                <?= $aclModuleAction->has('acl_module_action_group') ? $this->Html->link($aclModuleAction->acl_module_action_group->name, ['controller' => 'AclModuleActionGroups', 'action' => 'view', $aclModuleAction->acl_module_action_group->id]) : '' ?>
            </td>
            <td><?= h($aclModuleAction->name) ?></td>
            <td><?= h($aclModuleAction->handle) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $aclModuleAction->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $aclModuleAction->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $aclModuleAction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aclModuleAction->id)]) ?>
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

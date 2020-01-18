<?php /**/ ?>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Acl Module Action Group'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Acl Modules'), ['controller' => 'AclModules', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Acl Module'), ['controller' => 'AclModules', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Acl Module Actions'), ['controller' => 'AclModuleActions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Acl Module Action'), ['controller' => 'AclModuleActions', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="aclModuleActionGroups index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('acl_module_id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('handle') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($aclModuleActionGroups as $aclModuleActionGroup): ?>
        <tr>
            <td><?= $this->Number->format($aclModuleActionGroup->id) ?></td>
            <td>
                <?= $aclModuleActionGroup->has('acl_module') ? $this->Html->link($aclModuleActionGroup->acl_module->name, ['controller' => 'AclModules', 'action' => 'view', $aclModuleActionGroup->acl_module->id]) : '' ?>
            </td>
            <td><?= h($aclModuleActionGroup->name) ?></td>
            <td><?= h($aclModuleActionGroup->handle) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $aclModuleActionGroup->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $aclModuleActionGroup->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $aclModuleActionGroup->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aclModuleActionGroup->id)]) ?>
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

<?php /**/ ?>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Acl Module'), ['action' => 'edit', $aclModule->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Acl Module'), ['action' => 'delete', $aclModule->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aclModule->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Acl Modules'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Acl Module'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Acl Module Action Groups'), ['controller' => 'AclModuleActionGroups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Acl Module Action Group'), ['controller' => 'AclModuleActionGroups', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="aclModules view large-10 medium-9 columns">
    <h2><?= h($aclModule->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($aclModule->name) ?></p>
            <h6 class="subheader"><?= __('Handle') ?></h6>
            <p><?= h($aclModule->handle) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($aclModule->id) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Acl Module Action Groups') ?></h4>
    <?php if (!empty($aclModule->acl_module_action_groups)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Acl Module Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Handle') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($aclModule->acl_module_action_groups as $aclModuleActionGroups): ?>
        <tr>
            <td><?= h($aclModuleActionGroups->id) ?></td>
            <td><?= h($aclModuleActionGroups->acl_module_id) ?></td>
            <td><?= h($aclModuleActionGroups->name) ?></td>
            <td><?= h($aclModuleActionGroups->handle) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'AclModuleActionGroups', 'action' => 'view', $aclModuleActionGroups->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'AclModuleActionGroups', 'action' => 'edit', $aclModuleActionGroups->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'AclModuleActionGroups', 'action' => 'delete', $aclModuleActionGroups->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aclModuleActionGroups->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>

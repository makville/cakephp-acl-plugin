<?php /**/ ?>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Acl Module Action Group'), ['action' => 'edit', $aclModuleActionGroup->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Acl Module Action Group'), ['action' => 'delete', $aclModuleActionGroup->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aclModuleActionGroup->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Acl Module Action Groups'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Acl Module Action Group'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Acl Modules'), ['controller' => 'AclModules', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Acl Module'), ['controller' => 'AclModules', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Acl Module Actions'), ['controller' => 'AclModuleActions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Acl Module Action'), ['controller' => 'AclModuleActions', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="aclModuleActionGroups view large-10 medium-9 columns">
    <h2><?= h($aclModuleActionGroup->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Acl Module') ?></h6>
            <p><?= $aclModuleActionGroup->has('acl_module') ? $this->Html->link($aclModuleActionGroup->acl_module->name, ['controller' => 'AclModules', 'action' => 'view', $aclModuleActionGroup->acl_module->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($aclModuleActionGroup->name) ?></p>
            <h6 class="subheader"><?= __('Handle') ?></h6>
            <p><?= h($aclModuleActionGroup->handle) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($aclModuleActionGroup->id) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Acl Module Actions') ?></h4>
    <?php if (!empty($aclModuleActionGroup->acl_module_actions)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Acl Module Action Group Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Handle') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($aclModuleActionGroup->acl_module_actions as $aclModuleActions): ?>
        <tr>
            <td><?= h($aclModuleActions->id) ?></td>
            <td><?= h($aclModuleActions->acl_module_action_group_id) ?></td>
            <td><?= h($aclModuleActions->name) ?></td>
            <td><?= h($aclModuleActions->handle) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'AclModuleActions', 'action' => 'view', $aclModuleActions->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'AclModuleActions', 'action' => 'edit', $aclModuleActions->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'AclModuleActions', 'action' => 'delete', $aclModuleActions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aclModuleActions->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>

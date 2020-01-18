<?php /**/ ?>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Acl Module Action'), ['action' => 'edit', $aclModuleAction->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Acl Module Action'), ['action' => 'delete', $aclModuleAction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aclModuleAction->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Acl Module Actions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Acl Module Action'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Acl Module Action Groups'), ['controller' => 'AclModuleActionGroups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Acl Module Action Group'), ['controller' => 'AclModuleActionGroups', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Acl Role Actions'), ['controller' => 'AclRoleActions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Acl Role Action'), ['controller' => 'AclRoleActions', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="aclModuleActions view large-10 medium-9 columns">
    <h2><?= h($aclModuleAction->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Acl Module Action Group') ?></h6>
            <p><?= $aclModuleAction->has('acl_module_action_group') ? $this->Html->link($aclModuleAction->acl_module_action_group->name, ['controller' => 'AclModuleActionGroups', 'action' => 'view', $aclModuleAction->acl_module_action_group->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($aclModuleAction->name) ?></p>
            <h6 class="subheader"><?= __('Handle') ?></h6>
            <p><?= h($aclModuleAction->handle) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($aclModuleAction->id) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Acl Role Actions') ?></h4>
    <?php if (!empty($aclModuleAction->acl_role_actions)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Acl Role Id') ?></th>
            <th><?= __('Acl Module Action Id') ?></th>
            <th><?= __('Assigned By') ?></th>
            <th><?= __('Transaction Key') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($aclModuleAction->acl_role_actions as $aclRoleActions): ?>
        <tr>
            <td><?= h($aclRoleActions->id) ?></td>
            <td><?= h($aclRoleActions->acl_role_id) ?></td>
            <td><?= h($aclRoleActions->acl_module_action_id) ?></td>
            <td><?= h($aclRoleActions->assigned_by) ?></td>
            <td><?= h($aclRoleActions->transaction_key) ?></td>
            <td><?= h($aclRoleActions->created) ?></td>
            <td><?= h($aclRoleActions->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'AclRoleActions', 'action' => 'view', $aclRoleActions->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'AclRoleActions', 'action' => 'edit', $aclRoleActions->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'AclRoleActions', 'action' => 'delete', $aclRoleActions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aclRoleActions->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>

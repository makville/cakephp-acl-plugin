<?php /**/ ?>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Acl Role'), ['action' => 'edit', $aclRole->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Acl Role'), ['action' => 'delete', $aclRole->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aclRole->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Acl Roles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Acl Role'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Acl Role Actions'), ['controller' => 'AclRoleActions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Acl Role Action'), ['controller' => 'AclRoleActions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Acl User Roles'), ['controller' => 'AclUserRoles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Acl User Role'), ['controller' => 'AclUserRoles', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="aclRoles view large-10 medium-9 columns">
    <h2><?= h($aclRole->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($aclRole->name) ?></p>
            <h6 class="subheader"><?= __('Description') ?></h6>
            <p><?= h($aclRole->description) ?></p>
            <h6 class="subheader"><?= __('Transaction Key') ?></h6>
            <p><?= h($aclRole->transaction_key) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($aclRole->id) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Acl Role Actions') ?></h4>
    <?php if (!empty($aclRole->acl_role_actions)): ?>
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
        <?php foreach ($aclRole->acl_role_actions as $aclRoleActions): ?>
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
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Acl User Roles') ?></h4>
    <?php if (!empty($aclRole->acl_user_roles)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Acl User Id') ?></th>
            <th><?= __('Acl Role Id') ?></th>
            <th><?= __('Assigned By') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($aclRole->acl_user_roles as $aclUserRoles): ?>
        <tr>
            <td><?= h($aclUserRoles->id) ?></td>
            <td><?= h($aclUserRoles->acl_user_id) ?></td>
            <td><?= h($aclUserRoles->acl_role_id) ?></td>
            <td><?= h($aclUserRoles->assigned_by) ?></td>
            <td><?= h($aclUserRoles->created) ?></td>
            <td><?= h($aclUserRoles->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'AclUserRoles', 'action' => 'view', $aclUserRoles->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'AclUserRoles', 'action' => 'edit', $aclUserRoles->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'AclUserRoles', 'action' => 'delete', $aclUserRoles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aclUserRoles->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>

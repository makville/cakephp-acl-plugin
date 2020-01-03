<?php /**/ ?>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Acl User Profile'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Acl Users'), ['controller' => 'AclUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Acl User'), ['controller' => 'AclUsers', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="aclUserProfiles index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('acl_user_id') ?></th>
            <th><?= $this->Paginator->sort('salutation') ?></th>
            <th><?= $this->Paginator->sort('surname') ?></th>
            <th><?= $this->Paginator->sort('othernames') ?></th>
            <th><?= $this->Paginator->sort('sex') ?></th>
            <th><?= $this->Paginator->sort('date_of_birth') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($aclUserProfiles as $aclUserProfile): ?>
        <tr>
            <td><?= $this->Number->format($aclUserProfile->id) ?></td>
            <td>
                <?= $aclUserProfile->has('acl_user') ? $this->Html->link($aclUserProfile->acl_user->id, ['controller' => 'AclUsers', 'action' => 'view', $aclUserProfile->acl_user->id]) : '' ?>
            </td>
            <td><?= h($aclUserProfile->salutation) ?></td>
            <td><?= h($aclUserProfile->surname) ?></td>
            <td><?= h($aclUserProfile->othernames) ?></td>
            <td><?= h($aclUserProfile->sex) ?></td>
            <td><?= h($aclUserProfile->date_of_birth) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $aclUserProfile->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $aclUserProfile->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $aclUserProfile->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aclUserProfile->id)]) ?>
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

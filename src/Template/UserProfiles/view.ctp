<?php /**/ ?>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Acl User Profile'), ['action' => 'edit', $aclUserProfile->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Acl User Profile'), ['action' => 'delete', $aclUserProfile->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aclUserProfile->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Acl User Profiles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Acl User Profile'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Acl Users'), ['controller' => 'AclUsers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Acl User'), ['controller' => 'AclUsers', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="aclUserProfiles view large-10 medium-9 columns">
    <h2><?= h($aclUserProfile->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Acl User') ?></h6>
            <p><?= $aclUserProfile->has('acl_user') ? $this->Html->link($aclUserProfile->acl_user->id, ['controller' => 'AclUsers', 'action' => 'view', $aclUserProfile->acl_user->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Salutation') ?></h6>
            <p><?= h($aclUserProfile->salutation) ?></p>
            <h6 class="subheader"><?= __('Surname') ?></h6>
            <p><?= h($aclUserProfile->surname) ?></p>
            <h6 class="subheader"><?= __('Othernames') ?></h6>
            <p><?= h($aclUserProfile->othernames) ?></p>
            <h6 class="subheader"><?= __('Sex') ?></h6>
            <p><?= h($aclUserProfile->sex) ?></p>
            <h6 class="subheader"><?= __('Address') ?></h6>
            <p><?= h($aclUserProfile->address) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($aclUserProfile->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Date Of Birth') ?></h6>
            <p><?= h($aclUserProfile->date_of_birth) ?></p>
        </div>
    </div>
</div>

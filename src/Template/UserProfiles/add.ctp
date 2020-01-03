<?php /**/ ?>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Acl User Profiles'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Acl Users'), ['controller' => 'AclUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Acl User'), ['controller' => 'AclUsers', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="aclUserProfiles form large-10 medium-9 columns">
    <?= $this->Form->create($aclUserProfile) ?>
    <fieldset>
        <legend><?= __('Add Acl User Profile') ?></legend>
        <?php
            echo $this->Form->input('acl_user_id', ['options' => $aclUsers, 'empty' => true]);
            echo $this->Form->input('salutation');
            echo $this->Form->input('surname');
            echo $this->Form->input('othernames');
            echo $this->Form->input('sex');
            echo $this->Form->input('date_of_birth', ['empty' => true, 'default' => '']);
            echo $this->Form->input('address');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

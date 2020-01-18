<?php /**/ ?>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $aclUser->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $aclUser->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Acl Users'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="aclUsers form large-10 medium-9 columns">
    <?= $this->Form->create($aclUser) ?>
    <fieldset>
        <legend><?= __('Edit Acl User') ?></legend>
        <?php
            echo $this->Form->input('email');
            echo $this->Form->input('password');
            echo $this->Form->input('status');
            echo $this->Form->input('code');
            echo $this->Form->input('expiring');
            echo $this->Form->input('activated');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

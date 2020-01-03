<?php /**/ ?>
<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $aclModuleActionGroup->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $aclModuleActionGroup->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Acl Module Action Groups'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Acl Modules'), ['controller' => 'AclModules', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Acl Module'), ['controller' => 'AclModules', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Acl Module Actions'), ['controller' => 'AclModuleActions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Acl Module Action'), ['controller' => 'AclModuleActions', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="aclModuleActionGroups form large-10 medium-9 columns">
    <?= $this->Form->create($aclModuleActionGroup) ?>
    <fieldset>
        <legend><?= __('Edit Acl Module Action Group') ?></legend>
        <?php
            echo $this->Form->input('acl_module_id', ['options' => $aclModules, 'empty' => true]);
            echo $this->Form->input('name');
            echo $this->Form->input('handle');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

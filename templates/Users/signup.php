<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="users form content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Account credentials') ?></legend>
        <?php
        if (\Cake\Core\Configure::read('makville-acl-use-username')) {
            echo $this->Form->control('username', ['class' => 'form-control']);
        }
        echo $this->Form->control('email', ['class' => 'form-control']);
        echo $this->Form->control('password', ['class' => 'form-control']);
        echo $this->Form->control('confirm_password', ['class' => 'form-control', 'type' => 'password']);
        ?>
    </fieldset>
    <?php if ($profileFields->count() > 0): ?>
    <fieldset>
        <legend>Profile</legend>
        <?php
        foreach ($profileFields as $profileField) {
            echo $this->Acl->profileControl($profileField);
        }
        ?>
    </fieldset>
    <?php endif; ?>
    <?= $this->Element('MakvilleAcl.recaptcha'); ?>
    <p>&nbsp;</p>
    <?= $this->Form->button(__('Sign up'), ['class' => 'btn btn-success pull-right']) ?>
    <?= $this->Form->end() ?>
</div>
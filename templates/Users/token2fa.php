<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="users form content">
    <?= $this->Form->create(null) ?>
    <fieldset>
        <legend><?= __('Enter your authentication token') ?></legend>
        <?php
        echo $this->Form->control('email', ['type' => 'hidden', 'value' => $email]);
        echo $this->Form->control('token', ['class' => 'form-control']);
        ?>
    </fieldset>
    <?= $this->Element('MakvilleAcl.recaptcha'); ?>
    <p>&nbsp;</p>
    <?= $this->Form->button(__('Authenticate'), ['name' => 'authenticate', 'class' => 'btn btn-success pull-right']) ?>
    <?= $this->Form->end() ?>
    <p><?= $this->Form->postLink('Resend token', ['action' => 'token2fa', $email], ['data' => ['email' => $email]]); ?></p>
</div>
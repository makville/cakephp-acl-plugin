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
        <legend><?= __('Reset your password') ?></legend>
        <?php
        echo $this->Form->control('password', ['class' => 'form-control']);
        echo $this->Form->control('confirm_password', ['class' => 'form-control', 'type' => 'password']);
        ?>
    </fieldset>
    <?= $this->Element('MakvilleAcl.recaptcha'); ?>
    <p>&nbsp;</p>
    <?= $this->Form->button(__('Reset password'), ['class' => 'btn btn-success pull-right']) ?>
    <?= $this->Form->end() ?>
</div>
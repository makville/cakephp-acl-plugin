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
        <legend><?= __('Enter your email') ?></legend>
        <?php
        echo $this->Form->control('email', ['class' => 'form-control']);
        ?>
    </fieldset>
    <?= $this->Element('MakvilleAcl.recaptcha'); ?>
    <p>&nbsp;</p>
    <?= $this->Form->button(__('Recover account'), ['class' => 'btn btn-success pull-right']) ?>
    <?= $this->Form->end() ?>
</div>
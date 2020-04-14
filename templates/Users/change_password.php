<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Edit password</h5>
                <hr />
                <?= $this->Form->create(null) ?>
                <fieldset>
                    <?php
                    echo $this->Form->control('email', ['type' => 'hidden', 'value' => $user->email, 'class' => 'form-control']);
                    echo $this->Form->control('password', ['class' => 'form-control']);
                    echo $this->Form->control('new_password', ['class' => 'form-control', 'type' => 'password']);
                    echo $this->Form->control('confirm_new_password', ['class' => 'form-control', 'type' => 'password']);
                    ?>
                </fieldset>
                <?= $this->Element('MakvilleAcl.recaptcha'); ?>
                <p>&nbsp;</p>
                <?= $this->Form->button(__('Change password'), ['class' => 'btn btn-success']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
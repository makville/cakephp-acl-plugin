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
                <h5 class="card-title">Create User</h5>
                <hr />
                <?= $this->Form->create($user) ?>
                <fieldset>
                    <?php
                    if (\Cake\Core\Configure::read('makville-acl-use-username')) {
                        echo $this->Form->control('username', ['class' => 'form-control']);
                    }
                    echo $this->Form->control('email', ['class' => 'form-control']);
                    ?>
                </fieldset>
                <?= $this->Element('MakvilleAcl.recaptcha'); ?>
                <p>&nbsp;</p>
                <?= $this->Form->button(__('Create user'), ['class' => 'btn btn-success pull-right']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<?php

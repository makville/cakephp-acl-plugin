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
                <h5 class="card-title">Edit Profile</h5>
                <hr />
                <?= $this->Form->create(null) ?>
                <?php if ($profileFields->count() > 0): ?>
                    <fieldset>
                        <?php
                        foreach ($profileFields as $profileField) {
                            $profile = $userProfile[$profileField->id];
                            echo $this->Acl->profileControl($profileField, $profile['value'], $profile['id']);
                        }
                        ?>
                    </fieldset>
                <?php endif; ?>
                <?= $this->Element('MakvilleAcl.recaptcha'); ?>
                <p>&nbsp;</p>
                <?= $this->Form->button(__('Edit profile'), ['class' => 'btn btn-success pull-right']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
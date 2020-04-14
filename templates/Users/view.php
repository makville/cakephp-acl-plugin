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
                <h5 class="card-title">User Account</h5>
                <hr />
                <ul class="list-group">
                    <?php if (\Cake\Core\Configure::read('makville-acl-use-username')): ?>
                        <li class="list-group-item">
                            <h6 class="list-group-item-heading">Username</h6>
                            <p class="list-group-item-text"><?= $user->username; ?></p>
                        </li>
                    <?php endif; ?>
                    <li class="list-group-item">
                        <h6 class="list-group-item-heading">Email address</h6>
                        <p class="list-group-item-text"><?= $user->email; ?></p>
                    </li>
                </ul>
                <p></p>
                <ol class="breadcrumb">
                    <li class="active breadcrumb-item" aria-current="page">Profile</li>
                </ol>
                <ul class="list-group">
                    <?php foreach ($user->user_profiles as $profile): ?>
                        <li class="list-group-item">
                            <h6 class="list-group-item-heading"><?= $profileFields[$profile->user_profile_field_id]; ?></h6>
                            <p class="list-group-item-text"><?= $profile->value; ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <p></p>
                <ol class="breadcrumb">
                    <li class="active breadcrumb-item" aria-current="page">Roles</li>
                </ol>
                <?= $this->Form->create(null, ['class' => 'pull-left']); ?>
                <div class="scroll-area-lg">
                    <div class="scrollbar-container ps--active-y ps">
                        <ul class="list-group" style="list-style: none;">
                            <?php foreach ($roles as $role): ?>
                                <li class="list-group-item">
                                    <div class="position-relative form-check">
                                        <label class="form-check-label">
                                            <?= $this->Form->input('roles[]', ['type' => 'checkbox', 'class' => 'form-check-input', 'value' => $role->id, 'checked' => in_array($role->id, $userRoles) ? true : false]); ?>
                                            <?= $role->name; ?>
                                        </label>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?= $this->Form->submit(__('Update roles'), ['class' => 'btn btn-success pull-right']); ?>
                <span class="pull-right">&nbsp;</span>
                <span class="pull-right">&nbsp;</span>
                <?= $this->Form->end(); ?>
                <?= $this->Form->postLink('Delete', ['plugin' => 'MakvilleAcl', 'controller' => 'Users', 'action' => 'delete', $user->id], ['class' => 'btn btn-danger pull-left', 'confirm' => 'Are you sure you want to delete this account']); ?>
                <span class="pull-right">&nbsp;</span>
                <span class="pull-right">&nbsp;</span>
                <?= $this->Form->postLink('Deactivate', ['plugin' => 'MakvilleAcl', 'controller' => 'Users', 'action' => 'deactivate', $user->id], ['class' => 'btn btn-warning pull-left', 'confirm' => 'Are you sure you want to deactivate this account']); ?>
            </div>
        </div>
    </div>
</div>
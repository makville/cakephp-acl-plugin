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
                <h5 class="card-title">Approve User Account</h5>
                <hr />
                <ul class="list-group">
                    <li class="list-group-item">
                        <h6 class="list-group-item-heading">Username</h6>
                        <p class="list-group-item-text"><?= $user->username; ?></p>
                    </li>
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
                <p>&nbsp;</p>
                <?= $this->Form->postLink('Approve', ['plugin' => 'MakvilleAcl', 'controller' => 'Users', 'action' => 'approve', $email, $code], ['class' => 'btn btn-warning pull-right']); ?>
            </div>
        </div>
    </div>
</div>
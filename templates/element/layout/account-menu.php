<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="btn-group">
    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
        <img width="42" class="rounded-circle" src="assets/images/avatars/1.jpg" alt="">
        <i class="fa fa-angle-down ml-2 opacity-8"></i>
    </a>
    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
        <?= $this->Html->link('<button type="button" tabindex="0" class="dropdown-item">Edit profile</button>', ['plugin' => 'MakvilleAcl', 'controller' => 'Users', 'action' => 'edit-profile'], ['escape' => false]); ?>
        <h6 tabindex="-1" class="dropdown-header">Account</h6>
        <?= $this->Html->link('<button type="button" tabindex="0" class="dropdown-item">Change password</button>', ['plugin' => 'MakvilleAcl', 'controller' => 'Users', 'action' => 'change-password'], ['escape' => false]); ?>
        <div tabindex="-1" class="dropdown-divider"></div>
        <?= $this->Html->link('<button type="button" tabindex="0" class="dropdown-item">Logout</button>', ['plugin' => 'MakvilleAcl', 'controller' => 'Users', 'action' => 'logout'], ['escape' => false]); ?>
    </div>
</div>
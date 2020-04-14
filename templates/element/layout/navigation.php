<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<ul class="vertical-nav-menu">
    <li class="app-sidebar__heading">Access control</li>
    <li>
        <a href="#"><i class="metismenu-icon pe-7s-users"></i>Users<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
        <ul>
            <li><?= $this->Html->link('<i class="metismenu-icon pe-7s-user"></i> View users', ['plugin' => 'MakvilleAcl', 'controller' => 'Users', 'action' => 'index'], ['escape' => false]); ?></li>
            <li><?= $this->Html->link('<i class="metismenu-icon pe-7s-user"></i> Create user', ['plugin' => 'MakvilleAcl', 'controller' => 'Users', 'action' => 'invite'], ['escape' => false]); ?></li>
        </ul>
    </li>
    <li>
        <a href="#"><i class="metismenu-icon pe-7s-users"></i>Roles<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
        <ul>
            <li><?= $this->Html->link('<i class="metismenu-icon pe-7s-user"></i> View roles', ['plugin' => 'MakvilleAcl', 'controller' => 'Roles', 'action' => 'index'], ['escape' => false]); ?></li>
            <li><?= $this->Html->link('<i class="metismenu-icon pe-7s-user"></i> Create role', ['plugin' => 'MakvilleAcl', 'controller' => 'Roles', 'action' => 'add'], ['escape' => false]); ?></li>
        </ul>
    </li>
    <li>
        <a href="#"><i class="metismenu-icon pe-7s-users"></i>Modules<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
        <ul>
            <li><?= $this->Html->link('<i class="metismenu-icon pe-7s-user"></i> View modules', ['plugin' => 'MakvilleAcl', 'controller' => 'Modules', 'action' => 'index'], ['escape' => false]); ?></li>
        </ul>
    </li>
</ul>
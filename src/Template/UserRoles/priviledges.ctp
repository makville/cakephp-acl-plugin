<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$usersRoles = $userRoles->toArray();
echo $this->Form->create();
?>
<ul class="role-list">
<?php foreach ( $roles as $role ) : ?>
    <li class="role">
        <label class="form-checkbox form-normal form-primary active form-text">
            <?php if ( in_array($role->id, $usersRoles)) : ?>
            <input type="checkbox" value="<?= $role->id;?>" name="user_roles[<?= $role->id;?>][acl_role_id]" checked="checked" /> 
            <?php else: ?>
            <input type="checkbox" value="<?= $role->id;?>" name="user_roles[<?= $role->id;?>][acl_role_id]" /> 
            <?php endif; ?>
            <input type="hidden" value="<?= $user->id;?>" name="user_roles[<?= $role->id;?>][acl_user_id]" /> 
            <?= $role->name; ?>
        </label>
    </li>
<?php endforeach;?>
</ul>
<?= $this->Form->button('Set priviledges'); ?>
<?= $this->Form->end(); ?>

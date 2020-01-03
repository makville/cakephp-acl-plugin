<?php

$this->start('page_header');?>
<h2>Select privileges</h2>
<em>list of roles this user can perform</em>
<?php
$this->end();
echo $this->Form->create();
echo $this->Form->input('acl_user_id', ['type' => 'hidden', 'value' => $id]);
?>
<?php foreach($roles as $id => $role ): ?>
    <label class="fancy-checkbox custom-bgcolor-green">
        <input type="checkbox" <?= (array_key_exists($role->id, $currentRoles)) ? 'checked="checked"' : '';?> name="acl_user_roles[<?=$id;?>][acl_role_id]" value="<?=$role->id;?>" />
        <span><?= $role->name; ?></span>
    </label>
<?php endforeach; ?>
<?php
echo $this->Form->button('Submit');
echo $this->Form->end();
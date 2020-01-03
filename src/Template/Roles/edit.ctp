<?php

/**/ ?>
<div class="widget">
    <div class="widget-content">
    <?= $this->Form->create($aclRole) ?>
        <?php
            echo $this->Form->input('acl_roles.id', ['type' => 'hidden', 'value' => $aclRole->id]);
            echo $this->Form->input('acl_roles.name', ['class' => 'form-control', 'value' => $aclRole->name]);
            echo $this->Form->input('acl_roles.description', ['class' => 'form-control', 'value' => $aclRole->description]);
        ?>
        <p>&nbsp;</p>
        <p class="subheader">Select actions allowed for role</p>
        <div class="row">
            <div class="actions-structure">
                <ul>
                <?php foreach ($moduleActionStructure as $module) : ?>
                <?php if ( $module->is_system == 1 && $isSystemUser != 1 ) { continue; } ?>
                    <li class="module-row">
                        <i class="pull-left toggle collapsed fa fa-plus"></i>
                        <label class="fancy-checkbox custom-bgcolor-green">
                            <input class="m-box" type="checkbox" />
                            <span><?= $module->name; ?></span>
                        </label>
                    </li>
                    <li class="no-border" style="display: none;">
                        <ul>
                        <?php foreach ($module->acl_module_action_groups as $group) : ?>
                        <?php if ( $group->is_system == 1 && $isSystemUser != 1 ) { continue; } ?>
                            <li class="group-row">
                                <i class="pull-left toggle collapsed fa fa-plus"></i>
                                <label class="fancy-checkbox custom-bgcolor-green">
                                    <input class="g-box" type="checkbox" />
                                    <span><?= $group->name; ?></span>
                                </label>
                            </li>
                            <li class="no-border" style="display: none;">
                                <ul>
                                <?php foreach ($group->acl_module_actions as $action) : ?>
                                <?php if ( $action->is_system == 1 && $isSystemUser != 1 ) { continue; } ?>
                                    <li>
                                        <label class="fancy-checkbox custom-bgcolor-green">
                                            <input <?=(array_key_exists($action->id, $rolePrivileges)) ? 'checked="checked"' : '' ;?> class="a-box" name="acl_roles[acl_role_actions][<?=$action->id;?>][acl_module_action_id]" value="<?= $action->id;?>" type="checkbox" />
                                            <span><?= $action->name;?></span>
                                        </label>
                                    </li>
                                <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success']) ?>
    <?= $this->Form->end() ?>
    </div>
</div>

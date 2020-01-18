<?php/**/ ?>
<div class="tab-content profile-page">
    <!-- PROFILE TAB CONTENT -->
    <div class="tab-pane profile active" id="profile-tab">
        <div class="row">
            <div class="col-md-3">
                <div class="user-info-left">
                    <img src="assets/img/profile-avatar.png" alt="Profile Picture">
                    <h2><?= $aclUser->email; ?> <i class="fa fa-circle green-font online-icon"></i><sup class="sr-only">online</sup></h2>
                    <div class="contact">
                        <p><a href="page-profile.html#" class="btn btn-block btn-custom-primary"><i class="fa fa-envelope-o"></i> Send Message</a></p>
                        <?= $this->Form->postLink(__(($aclUser->status == 'active') ? 'Inactivate' : 'Activate'), ['action' => 'toggle', $aclUser->id], ['class' => 'btn btn-block btn-warning'], ['confirm' => __('Are you sure you want to change this users\'s status?' )]) ?>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="user-info-right">
                    <div class="basic-info">
                        <h3><i class="fa fa-square"></i> Basic Information</h3>
                        <p class="data-row">
                            <span class="data-name">Status</span>
                            <span class="data-value"><?= $aclUser->status; ?></span>
                        </p>
                        <p class="data-row">
                            <span class="data-name">Registered</span>
                            <span class="data-value"><?= $this->Time->format($aclUser->created, 'd/M/Y');?></span>
                        </p>
                    </div>
                    <div class="about">
                        <h3><i class="fa fa-square"></i> Privileges | <em><?= $this->Html->link('Edit', ['plugin' => 'acl', 'controller' => 'acl_users', 'action' => 'privileges', $aclUser->id], ['class' => '']);?></em></h3>
                        <ul>
                        <?php foreach ($aclUser->acl_user_roles as $userRoles): ?>
                            <li><?= $userRoles->acl_role->name;?></li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
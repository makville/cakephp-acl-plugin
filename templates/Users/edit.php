<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $user
 */
?>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Edit account</h5>
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
                    <li class="active breadcrumb-item" aria-current="page">Roles</li>
                </ol>
                <?= $this->Form->create($user) ?>
                <fieldset>
                    <legend><?= __('Edit User') ?></legend>
                    <?php
                    echo $this->Form->control('username');
                    echo $this->Form->control('email');
                    echo $this->Form->control('password');
                    echo $this->Form->control('status');
                    echo $this->Form->control('code');
                    echo $this->Form->control('expiring', ['empty' => true]);
                    echo $this->Form->control('activated', ['empty' => true]);
                    echo $this->Form->control('owner');
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

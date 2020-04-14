<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $userProfileField
 */
?>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">User profile field</h5>
                <hr />
                <table class="mb-0 table table-bordered">
                    <tr>
                        <th><?= __('Name') ?></th>
                        <td><?= h($userProfileField->name) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Label') ?></th>
                        <td><?= h($userProfileField->label) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Required') ?></th>
                        <td><?= h($userProfileField->required) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Input Type') ?></th>
                        <td><?= h($userProfileField->input_type) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Option Source') ?></th>
                        <td><?= h($userProfileField->option_source) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Options') ?></th>
                        <td><?= h($userProfileField->options) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Created') ?></th>
                        <td><?= h($userProfileField->created) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Modified') ?></th>
                        <td><?= h($userProfileField->modified) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

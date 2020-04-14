<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $role
 */
?>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Roles</h5>
                <hr />
                <ul class="list-group">
                    <li class="list-group-item">
                        <h5 class="list-group-item-heading"><?= $role->name; ?></h5>
                        <p class="list-group-item-text"><?= $role->description; ?></p>
                    </li>
                </ul>


            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $this->Form->create(null); ?>
                    <div class="card-body">
                        <h5 class="card-title">Members</h5>
                        <hr />
                        <div class="scroll-area-lg">
                            <div class="scrollbar-container ps--active-y ps">
                                <ul class="list-group" style="list-style: none;">
                                    <?php foreach ($users as $user): ?>
                                        <li class="list-group-item">
                                            <div class="position-relative form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="members[]" value="<?= $user->id; ?>" <?= in_array($user->id, $roleUsers) ? 'checked="checked"' : ''; ?>>
                                                    <?= $user->email; ?>
                                                </label>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <p></p>
                        <?= $this->Form->submit(__('Update members'), ['name' => 'membership', 'class' => 'btn btn-success pull-right']); ?>
                    </div>
                    <?= $this->Form->end(); ?>
                </div>
                <div class="col-md-6">
                    <?= $this->Form->create(null); ?>
                    <div class="card-body">
                        <h5 class="card-title">Role actions</h5>
                        <hr />
                        <div class="scroll-area-lg">
                            <div class="scrollbar-container ps--active-y ps">
                                <div id="accordion" class="accordion-wrapper mb-3">
                                    <?php foreach ($modules as $module) : ?>
                                    <div class="card">
                                        <div id="headingOne" class="card-header">
                                            <button type="button" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="false" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block collapsed">
                                                <h5 class="m-0 p-0"><?= $module->name; ?></h5>
                                            </button>
                                        </div>
                                        <div data-parent="#accordion" id="collapseOne1" aria-labelledby="headingOne" class="collapse" style="">
                                            <div class="card-body">
                                                <ul class="list-group" style="list-style: none;">
                                                    <?php 
                                                    foreach ($module->duties as $duty): 
                                                        $actionList = array_map(function ($action) {
                                                            return $action->id;
                                                        }, $duty->module_actions);
                                                        $checked = '';
                                                        if (!empty(array_intersect($roleActions, $actionList))) {
                                                            $checked = 'checked="checked"';
                                                        }
                                                    ?>
                                                        <li class="list-group-item">
                                                            <div class="position-relative form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" name="actions[]" value="<?= $duty->id; ?>" <?=$checked; ?>>
                                                                    <?= $duty->name; ?>
                                                                </label>
                                                            </div>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <p></p>
                        <?= $this->Form->submit(__('Update actions'), ['name' => 'duties', 'class' => 'btn btn-success pull-right']); ?>
                    </div>
                    <?= $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
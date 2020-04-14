<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $module
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Module'), ['action' => 'edit', $module->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Module'), ['action' => 'delete', $module->id], ['confirm' => __('Are you sure you want to delete # {0}?', $module->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Modules'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Module'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="modules view content">
            <h3><?= h($module->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($module->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($module->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is System') ?></th>
                    <td><?= h($module->is_system) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Public') ?></th>
                    <td><?= h($module->is_public) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($module->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Module Action Groups') ?></h4>
                <?php if (!empty($module->module_action_groups)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Module Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Handle') ?></th>
                            <th><?= __('Is System') ?></th>
                            <th><?= __('Is Public') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($module->module_action_groups as $moduleActionGroups) : ?>
                        <tr>
                            <td><?= h($moduleActionGroups->id) ?></td>
                            <td><?= h($moduleActionGroups->module_id) ?></td>
                            <td><?= h($moduleActionGroups->name) ?></td>
                            <td><?= h($moduleActionGroups->description) ?></td>
                            <td><?= h($moduleActionGroups->handle) ?></td>
                            <td><?= h($moduleActionGroups->is_system) ?></td>
                            <td><?= h($moduleActionGroups->is_public) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ModuleActionGroups', 'action' => 'view', $moduleActionGroups->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ModuleActionGroups', 'action' => 'edit', $moduleActionGroups->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ModuleActionGroups', 'action' => 'delete', $moduleActionGroups->id], ['confirm' => __('Are you sure you want to delete # {0}?', $moduleActionGroups->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Module Actions') ?></h4>
                <?php if (!empty($module->module_actions)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Module Id') ?></th>
                            <th><?= __('Module Action Group Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Handle') ?></th>
                            <th><?= __('Is System') ?></th>
                            <th><?= __('Is Public') ?></th>
                            <th><?= __('Ownership Check') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($module->module_actions as $moduleActions) : ?>
                        <tr>
                            <td><?= h($moduleActions->id) ?></td>
                            <td><?= h($moduleActions->module_id) ?></td>
                            <td><?= h($moduleActions->module_action_group_id) ?></td>
                            <td><?= h($moduleActions->name) ?></td>
                            <td><?= h($moduleActions->description) ?></td>
                            <td><?= h($moduleActions->handle) ?></td>
                            <td><?= h($moduleActions->is_system) ?></td>
                            <td><?= h($moduleActions->is_public) ?></td>
                            <td><?= h($moduleActions->ownership_check) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ModuleActions', 'action' => 'view', $moduleActions->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ModuleActions', 'action' => 'edit', $moduleActions->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ModuleActions', 'action' => 'delete', $moduleActions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $moduleActions->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

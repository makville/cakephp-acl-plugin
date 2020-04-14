<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $userProfileFields
 */
echo $this->ControlPanel->pageTitle();
?>

<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Create User Account Profile Field</h5>
                <hr />
                <div class="table-responsive">
                    <table class="mb-0 table">
                        <thead>
                            <tr>
                                <th><?= $this->Paginator->sort('id') ?></th>
                                <th><?= $this->Paginator->sort('name') ?></th>
                                <th><?= $this->Paginator->sort('label') ?></th>
                                <th><?= $this->Paginator->sort('required') ?></th>
                                <th><?= $this->Paginator->sort('input_type') ?></th>
                                <th><?= $this->Paginator->sort('option_source') ?></th>
                                <th><?= $this->Paginator->sort('created') ?></th>
                                <th><?= $this->Paginator->sort('modified') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($userProfileFields as $userProfileField): ?>
                                <tr>
                                    <td><?= $this->Number->format($userProfileField->id) ?></td>
                                    <td><?= h($userProfileField->name) ?></td>
                                    <td><?= h($userProfileField->label) ?></td>
                                    <td><?= h($userProfileField->required) ?></td>
                                    <td><?= h($userProfileField->input_type) ?></td>
                                    <td><?= h($userProfileField->option_source) ?></td>
                                    <td><?= h($userProfileField->created) ?></td>
                                    <td><?= h($userProfileField->modified) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['action' => 'view', $userProfileField->id]) ?>
                                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userProfileField->id]) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userProfileField->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userProfileField->id)]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="paginator">
                    <ul class="pagination">
                        <?= $this->Paginator->first('<< ' . __('first')) ?>
                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('next') . ' >') ?>
                        <?= $this->Paginator->last(__('last') . ' >>') ?>
                    </ul>
                    <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

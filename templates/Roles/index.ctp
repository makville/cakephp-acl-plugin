<?php

$this->start('page_header');?>
<h2>Access control roles</h2>
<em> roles allocatable to users</em>
<?php
$this->end();
?>
<div class="widget widget-table">
    <div class="widget-header">
        <h3><i class="fa fa-edit"></i> Access control roles</h3> <em> - roles allocatable to users</em>
        <?= $this->Html->link('<i class="fa fa-plus"></i> New role', ['action' => 'add'], ['escape' => false, 'class' => 'btn btn-sm btn-info pull-right widget-header-link']); ?>
    </div>
    <div class="widget-content">
        <div id="featured-datatable_wrapper" class="dataTables_wrapper form-inline no-footer">
            <table id="featured-datatable" class="table table-sorting table-striped table-hover datatable dataTable no-footer" role="grid" aria-describedby="featured-datatable_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="featured-datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Name</th>
                        <th class="sorting" tabindex="0" aria-controls="featured-datatable" rowspan="1" colspan="1" aria-label="">Description</th>
                        <th class="sorting" tabindex="0" aria-controls="featured-datatable" rowspan="1" colspan="1" aria-label=""></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($aclRoles as $aclRole): ?>
                    <tr>
                        <td><?= h($aclRole->name) ?></td>
                        <td><?= h($aclRole->description) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $aclRole->id], ['class' => 'btn btn-xs btn-info']) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $aclRole->id], ['class' => 'btn btn-xs btn-warning']) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $aclRole->id], ['class' => 'btn btn-xs btn-danger'], ['confirm' => __('Are you sure you want to delete # {0}?', $aclRole->id)]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

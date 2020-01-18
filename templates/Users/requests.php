<?php ?>
<div class="row">

    <div class="large-12 columns">
        <div class="box">
            <div class="box-header bg-transparent">
                <h3 class="box-title"><i class="fontello-window"></i>
                    <span style="font-size: 14px; font-weight: bold;">
                        Participants
                    </span>
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: block;">

                <div class="widget widget-table">
                    <!--<div class="widget-header">
                        <h3><i class="fa fa-users"></i> Users</h3> <em> - list of registered users</em>
                    </div>-->
                    <div class="widget-content">
                        <div id="featured-datatable_wrapper" class="dataTables_wrapper form-inline no-footer">
                            <table id="featured-datatable" class="table table-sorting table-striped table-hover datatable dataTable no-footer" role="grid" aria-describedby="featured-datatable_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="featured-datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="featured-datatable" rowspan="1" colspan="1" aria-label="">Email</th>
                                        <th class="sorting" tabindex="0" aria-controls="featured-datatable" rowspan="1" colspan="1" aria-label=""></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user): ?>
                                    <?php if($user->email == 'ayomakanjuola@gmail.com') {continue;} ?>
                                    <tr role="row" class="odd">
                                        <td class="sorting_1"><?= $user->user_profile->name; ?></td>
                                        <td class="sorting_1"><?= $user->email; ?></td>
                                        <td>
                                        <?= $this->Form->postLink(__('Approve'), ['action' => 'recover', 'yes'], ['class' => 'btn btn-xs btn-info', 'data' => ['email' => $user->email]])   ?>
                                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['class' => 'btn btn-xs btn-danger'], ['confirm' => __('Are you sure you want to delete this physician?')]) ?>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                        <div class="paginator">
                            <ul class="pagination">
                                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                                <?= $this->Paginator->numbers() ?>
                                <?= $this->Paginator->next(__('next') . ' >') ?>
                            </ul>
                            <p><?= $this->Paginator->counter() ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
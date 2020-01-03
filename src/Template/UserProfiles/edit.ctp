<?php

/**/ ?>
<div class="row" style="margin-top:-20px">

    <div class="large-12 columns">
        <div class="box">
            <div class="box-header bg-transparent">
                <!-- tools box -->
                <div class="pull-right box-tools">

                    <span class="box-btn" data-widget="collapse"><i class="icon-minus"></i>
                    </span>
                    <span class="box-btn" data-widget="remove"><i class="icon-cross"></i>
                    </span>
                </div>
                <h3 class="box-title"><i class="fontello-th-large-outline"></i>
                    <span>Edit your profile</span>
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body " style="display: block;">
                <?= $this->Form->create($userProfile) ?>
                <?php
                    echo $this->Form->input('name');
                    echo $this->Form->input('institution', ['label' => 'Institution']);
                ?>
                <?= $this->Form->button(__('Save'), ['class' => 'tiny']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

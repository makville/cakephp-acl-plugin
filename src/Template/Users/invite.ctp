<?php

/**/?>
<div class="row">

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
                    <span>INVITE A USER</span>
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: block;">
                <?= $this->Form->create('', ['class' => 'form-horizontal', 'id' => 'signup-form']); ?>
                <?= $this->Form->input('name'); ?>
                <?= $this->Form->input('email'); ?>
                <?= $this->Form->input('administrator', ['label' => 'Grant administrative priviledges', 'options' => ['no' => 'No', 'yes' => 'Yes']]); ?>
                <button class="tiny">Send Invite</button>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
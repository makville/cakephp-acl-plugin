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
                <h5 class="card-title">Edit role</h5>
                <hr />
                <?= $this->Form->create($role) ?>
                <fieldset>
                    <?php
                    echo $this->Form->control('name', ['class' => 'form-control']);
                    echo $this->Form->control('description', ['class' => 'form-control']);
                    ?>
                </fieldset>
                <p>&nbsp;</p>
                <?= $this->Form->button(__('Edit role'), ['class' => 'btn btn-success pull-right']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

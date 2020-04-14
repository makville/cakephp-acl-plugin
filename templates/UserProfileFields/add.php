<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $userProfileField
 */
echo $this->ControlPanel->pageTitle();
?>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Create User Account Profile Field</h5>
                <hr />
                <?= $this->Form->create($userProfileField) ?>
                <fieldset>
                    <?php
                    echo $this->Form->control('name', ['class' => 'form-control']);
                    echo $this->Form->control('label', ['class' => 'form-control']);
                    echo $this->Form->control('required', ['class' => 'form-control', 'options' => ['0' => 'No', '1' => 'Yes']]);
                    echo $this->Form->control('input_type', ['class' => 'form-control', 'options' => [
                            'short-text' => 'Short text',
                            'long-text' => 'Long text',
                            'number' => 'Number',
                            'date' => 'Date',
                            'single-choice' => 'Single choice from a list of options',
                            'multiple-choice' => 'Multiple choice from a list of options'
                        ]
                    ]);
                    echo $this->Form->control('option_source', ['class' => 'form-control']);
                    echo $this->Form->control('options', ['class' => 'form-control']);
                    ?>
                </fieldset>
                <p>&nbsp;</p>
                <?= $this->Form->button(__('Create'), ['class' => 'btn btn-success pull-right']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$configured = [];
?>

<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Module setup</h5>
                <hr />
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title">Configured</h5>
                            <hr />
                            <div class="scroll-area-lg">
                                <div class="scrollbar-container ps--active-y ps">
                                    <ul class="list-group" style="list-style: none;">
                                        <?php 
                                            foreach ($modules as $module): 
                                                $configured[] = $module->name;
                                        ?>
                                            <li class="list-group-item">
                                                <h5 class="list-group-item-heading"><?= $module->name; ?></h5>
                                                <p class="list-group-item-text">
                                                    <?= $module->description; ?> 
                                                    <?= $this->Form->postLink('Remove', ['action' => 'delete', $module->id], ['class' => 'pull-right btn btn-sm btn-danger', 'confirm' => 'Are you sure you want to remove this module?']);?>
                                                    <span class="pull-right">&nbsp;</span>
                                                    <?= $this->Html->link('Update', ['action' => 'update', $module->id], ['class' => 'pull-right btn btn-sm btn-warning']);?>
                                                    <span class="pull-right">&nbsp;</span>
                                                    <?= $this->Html->link('Details', ['action' => 'details', $module->id], ['class' => 'pull-right btn btn-sm btn-info']);?>
                                                </p>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title">Available</h5>
                            <hr />
                            <div class="scroll-area-lg">
                                <div class="scrollbar-container ps--active-y ps">
                                    <ul class="list-group" style="list-style: none;">
                                        <?php 
                                        foreach (Cake\Core\Plugin::loaded() as $plugin): 
                                            //does this plugin conform to acl requirements?
                                            $dutiesConfigPath = Cake\Core\Plugin::configPath($plugin) . "/duties.json";
                                            if (file_exists($dutiesConfigPath)):
                                                $dutiesConfiguration = json_decode(file_get_contents($dutiesConfigPath), true);
                                                if (in_array($dutiesConfiguration['name'], $configured)) { continue; }
                                        ?>
                                        
                                            <li class="list-group-item">
                                                <h5 class="list-group-item-heading"><?= $plugin; ?></h5>
                                                <p class="list-group-item-text"><?= $dutiesConfiguration['description']; ?> <?= $this->Html->link('Setup', ['action' => 'setup', $plugin], ['class' => 'pull-right btn btn-sm btn-warning']);?><span class="pull-right">&nbsp;</span><?= $this->Html->link('Details', ['action' => 'readme', $plugin], ['class' => 'pull-right btn btn-sm btn-info']);?></p>
                                            </li>
                                        <?php 
                                            endif;
                                        endforeach; 
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
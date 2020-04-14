<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"><?= $module->name; ?>: Module details</h5>
                <hr />
                <ul class="list-group" style="list-style: none;">
                    <li class="list-group-item">
                        <h5 class="list-group-item-heading"><?= $module->name; ?></h5>
                        <p class="list-group-item-text">Version: <?= $module->version; ?></p>
                        <p class="list-group-item-text">Description: <?= $module->description; ?> </p>
                    </li>
                </ul>
                <p></p>
                <ol class="breadcrumb">
                    <li class="active breadcrumb-item" aria-current="page">Available duties in this module</li>
                </ol>
                <div class="scroll-area-lg">
                    <div class="scrollbar-container ps--active-y ps">
                        <table class="mb-0 table table-bordered">
                            <tbody>
                                <?php foreach ($module->duties as $duty): ?>
                                    <tr>
                                        <th scope="row">
                                            <b><?= $duty->name; ?></b>
                                        </th>
                                        <td>
                                            <ul class="list-group list-group-flush" style="list-style: none;">
                                                <?php foreach ($duty->module_actions as $action): ?>
                                                    <li class="list-group-item"><?= $action->name; ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <p></p><!--<?= $this->Html->link('Setup', ['action' => 'configure', $name], ['class' => 'pull-right btn btn-sm btn-warning']); ?>-->
            </div>
        </div>
    </div>
</div>
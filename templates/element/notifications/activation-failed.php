<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="" style="text-align: center; color: #ad1d1d">
    <p>We were unable to activate your account.</p>
    <p>This is most likely due to an expired or invalid activation code.</p>
    <p><strong><?= $this->Html->link('Click here', ['plugin' => 'MakvilleAcl', 'controller' => 'Users', 'action' => 'recover']); ?></strong> to attempt to recover the account.</p>
</div>
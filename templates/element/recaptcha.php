<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Cake\Core\Configure;
?>
<script src="https://www.google.com/recaptcha/api.js?render=<?= Configure::read('google-recaptcha-site-key'); ?>"></script>
<script>
grecaptcha.ready(function() {
    grecaptcha.execute('<?= Configure::read('google-recaptcha-site-key'); ?>', {action: 'homepage'}).then(function(token) {
       
    });
});
</script>
<?php ?>


<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie ie9" lang="en" class="no-js"> <![endif]-->
<!--[if !(IE)]><!-->
<html lang="en" class="no-js">
    <!--<![endif]-->

    <head>
        <title>Login | Creche</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Quidle Admin">
        <meta name="author" content="Quidle Inc">

        <!-- CSS -->
        <?= $this->Html->css('admin/plugins/bootstrap/bootstrap.min'); ?>
        <?= $this->Html->css('admin/plugins/font-awesome/font-awesome.min'); ?>
        <?= $this->Html->css('admin/main'); ?>

        <!--[if lte IE 9]>
                <link href="assets/css/main-ie.css" rel="stylesheet" type="text/css" />
                <link href="assets/css/main-ie-part2.css" rel="stylesheet" type="text/css" />
        <![endif]-->

    </head>

    <body>
        <div class="wrapper full-page-wrapper page-auth page-login text-center">
            <?= $this->fetch('content'); ?>
        </div>

        <footer class="footer">&copy; 2016 Quidle Inc</footer>

        <!-- Javascript -->
        <?= $this->Html->script('admin/jquery/jquery-2.1.0.min'); ?>
        <?= $this->Html->script('admin/bootstrap/bootstrap.min'); ?>
        <?= $this->Html->script('admin/plugins/modernizr/modernizr'); ?>
    </body>

</html>


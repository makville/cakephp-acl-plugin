<?php
switch ($type) {
    case 'activation':
        $message = 'Your account has been activated and a new password set successfully.';
        $message .= '<ol style="list-style: none;"><li>If you are attempting to activate an invite, contact the site administrator for a new invite. </li><li>If you\'ve lost your account password, click here to request a new reset token which will be sent to your email address.</li></ol>';
        $message .= 'Thank you!';
        break;
    case 'new':
        $message = 'Your sign up has been confirmed. Once your account has been approved, you will receive an email with a link with which you can set a password and activate your account';
        break;
    case 'recovery':
        $message = 'Your account recovery request has been processed and a recovery link sent to your email address.';
        break;
    default:
        $message = 'Requested action has been completed successfully';
        break;
}
?>
<div class="main">
    <div class="main-body">
        <div class="row">
            <div class="columns large-12">
                <div class="content">
                    <article class="post post-single" itemscope itemtype="https://schema.org/BlogPosting">

                        <div class="post-body">
                            <div class="entry" itemprop="articleBody">

                                <h1 class="error-title text-center" style="font-size: 120px;">Success</h1>
                                <h2 class="error-subtitle text-center"><?= $message; ?></h2>
                                <p class="text-center"><?= $this->Html->link( 'Go to Home Page', ['plugin' => null, 'controller' => 'Pages', 'action' => 'display', 'home'], ['class' => 'header-logo']); ?></p>

                            </div><!-- /.entry -->
                        </div><!-- /.post-body -->

                    </article><!-- /.post post-single -->
                </div><!-- /.content -->
            </div><!-- /.columns large-8 -->

        </div><!-- /.row -->
    </div><!-- /.main-body -->
</div><!-- /.main -->

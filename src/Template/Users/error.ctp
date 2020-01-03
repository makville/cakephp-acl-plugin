<?php
switch ($type) {
    case 'token':
        $message = 'Activating you account/Reseting your acount password could not be completed because your request token has expired';
        $message .= '<ol style="list-style: none;"><li>If you are attempting to activate a new account or If you\'ve lost your account password, ' . $this->Html->link('click here', ['plugin' => 'Acl', 'controller' => 'users', 'action' => 'recover']) . ' to request a new reset token which will be sent to your email address.</li></ol>';
        $message .= 'Thank you!';
        break;
    case 'recovery':
        $message = 'There is no account associated with the email address provided.';
        break;
    default:
        $message = 'An error occurred please try again later';
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

                                <h1 class="error-title text-center" style="font-size: 120px;">Error</h1>
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

<?php
$this->layout = 'default';
?>
<div class="main-body">
    <div class="row">
        <div class="small-12 columns large-12">
            <div class="content">
                <article id="post-335" class="post post-single format-gallery post-335 page type-page status-publish hentry" itemscope itemtype="https://schema.org/BlogPosting">
                    <div class="post-body">
                        <div class="entry" itemprop="articleBody">
                            <div class="woocommerce">
                                <h2>Set a password for your account</h2>
                                <?= $this->Form->create('', ['class' => 'login form-horizontal', 'id' => 'login-form']); ?>
                                <?php
                                    echo $this->Form->input('email', ['type' => 'hidden', 'value' => $email]);
                                    echo $this->Form->input('username', ['type' => 'hidden', 'value' => $email]);
                                    echo $this->Form->input('code', ['type' => 'hidden', 'value' => $code]);
                                ?>
                                <p class="title"></p>
                                <input type="password" name="password" placeholder="Password" class="form-control">
                                <input type="password" name="password2" placeholder="Confirm password" class="form-control">
                                <button class="tiny"> Set password</button>
                                <?= $this->Form->end(); ?>
                            </div>
                        </div><!-- /.entry -->
                    </div><!-- /.post-body -->
                </article><!-- /.post -->																		</div><!-- /.content -->
        </div><!-- /.columns large-8 -->
    </div><!-- /.row -->
</div><!-- /.main-body -->
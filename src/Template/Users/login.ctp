<?php $this->layout = 'default' ?>

<div class="main-body">
    <div class="row">
        <div class="small-12 columns large-12">
            <div class="content">
                <article id="post-335" class="post post-single format-gallery post-335 page type-page status-publish hentry" itemscope itemtype="https://schema.org/BlogPosting">
                    <div class="post-body">
                        <div class="entry" itemprop="articleBody">
                            <div class="woocommerce">
                                <h2>Login</h2>
                                <?= $this->Form->create('', ['class' => 'login form-horizontal', 'id' => 'login-form']); ?>
                                <p class="title">Sign into your account</p>
                                <div class="form-group">
                                    <label for="username" class="control-label sr-only">Username</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="text" placeholder="username" id="username" name="username" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <label for="password" class="control-label sr-only">Password</label>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="password" placeholder="password" id="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <!--<label class="fancy-checkbox">
                                    <input type="checkbox">
                                    <span>Remember me next time</span>
                                </label>-->
                                <button class="btn btn-custom-primary btn-lg btn-block btn-auth"><i class="fa fa-arrow-circle-o-right"></i> Login</button>
                                <p><?= $this->Html->link('Forgot Password?', ['action' => 'recover']); ?></p>
                                <?= $this->Form->end(); ?>
                            </div>
                        </div><!-- /.entry -->
                    </div><!-- /.post-body -->
                </article><!-- /.post -->																		</div><!-- /.content -->
        </div><!-- /.columns large-8 -->
    </div><!-- /.row -->
</div><!-- /.main-body -->

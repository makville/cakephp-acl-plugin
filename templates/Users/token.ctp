<?php $this->layout = 'default' ?>

<div class="main-body">
    <div class="row">
        <div class="small-12 columns large-12">
            <div class="content">
                <article id="post-335" class="post post-single format-gallery post-335 page type-page status-publish hentry" itemscope itemtype="https://schema.org/BlogPosting">
                    <div class="post-body">
                        <div class="entry" itemprop="articleBody">
                            <div class="woocommerce">
                                <h2>Second factor authentication</h2>
                                <?= $this->Form->create('', ['class' => 'login form-horizontal', 'id' => 'login-form']); ?>
                                <?= $this->Form->input('email', ['type' => 'hidden', 'value' => $email]); ?>
                                <p class="title">Enter the 6 digit token that was sent to your email to complete your sign in request</p>
                                <div class="form-group">
                                    <label for="token" class="control-label sr-only">Enter token</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="text" placeholder="Enter token" id="token" name="token" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-custom-primary btn-lg btn-block btn-auth" name="authenticate"><i class="fa fa-arrow-circle-o-right"></i> Authenticate</button>
                                <?= $this->Form->end(); ?>
                                <p><?= $this->Form->postLink('Resend token', ['action' => 'token', $email], ['data' => ['email' => $email]]); ?></p>
                            </div>
                        </div><!-- /.entry -->
                    </div><!-- /.post-body -->
                </article><!-- /.post -->																		</div><!-- /.content -->
        </div><!-- /.columns large-8 -->
    </div><!-- /.row -->
</div><!-- /.main-body -->

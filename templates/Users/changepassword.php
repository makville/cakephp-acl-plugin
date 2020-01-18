<?php ?>
<div class="main-body">
    <div class="row">
        <div class="small-12 columns large-12">
            <div class="content">
                <article id="post-335" class="post post-single format-gallery post-335 page type-page status-publish hentry" itemscope itemtype="https://schema.org/BlogPosting">
                    <div class="post-body">
                        <div class="entry" itemprop="articleBody">
                            <div class="woocommerce">
                                <h2>Login</h2>
                                <?= $this->Form->create('', ['class' => 'form-horizontal']); ?>
                                <?= $this->Form->input('username', ['type' => 'hidden', 'value' => $email]);?>
                                <p class="title">Change password</p>
                                <input type="password" name="password" placeholder="Current password" class="form-control">
                                <input type="password" name="new_password" placeholder="Password" class="form-control">
                                <input type="password" name="new_password2" placeholder="Confirm password" class="form-control">
                                <button class="btn btn-custom-primary btn-lg btn-block btn-auth"><i class="fa fa-arrow-circle-o-right"></i> Edit password</button>
                                <?= $this->Form->end(); ?>
                            </div>
                        </div><!-- /.entry -->
                    </div><!-- /.post-body -->
                </article><!-- /.post -->																		</div><!-- /.content -->
        </div><!-- /.columns large-8 -->
    </div><!-- /.row -->
</div><!-- /.main-body -->
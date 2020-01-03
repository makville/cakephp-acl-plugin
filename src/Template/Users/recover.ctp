<?php

$this->layout = 'default' ?>

<div class="main-body">
    <div class="row">
        <div class="small-12 columns large-12">
            <div class="content">
                <article id="post-335" class="post post-single format-gallery post-335 page type-page status-publish hentry" itemscope itemtype="https://schema.org/BlogPosting">
                    <div class="post-body">
                        <div class="entry" itemprop="articleBody">
                            <div class="woocommerce">
                                <h2>Recover your password</h2>
                                <?= $this->Form->create('', ['class' => 'form-horizontal']); ?>
                                <div class="form-group">
                                    <label for="email" class="control-label sr-only">Email Address</label>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="text" placeholder="Email Address" id="email" name="email" class="form-control">
                                            <!--<span class="input-group-addon"><i class="fa fa-envelope"></i></span>-->
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-custom-primary btn-lg btn-block btn-auth"><i class="fa fa-arrow-circle-o-right"></i> Recover</button>
                                <?= $this->Form->end(); ?>
                            </div>
                        </div><!-- /.entry -->
                    </div><!-- /.post-body -->
                </article><!-- /.post -->																		</div><!-- /.content -->
        </div><!-- /.columns large-8 -->
    </div><!-- /.row -->
</div><!-- /.main-body -->
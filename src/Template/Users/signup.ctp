<?php /**/ ?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<?= $this->Html->script('behaviors/common', ['block' => 'scriptBottom']); ?>
<div class="main-body">
    <div class="row">
        <div class="small-12 columns large-12">
            <div class="content">
                <article id="post-335" class="post post-single format-gallery post-335 page type-page status-publish hentry" itemscope itemtype="https://schema.org/BlogPosting">
                    <div class="post-body">
                        <div class="entry" itemprop="articleBody">
                            <div class="woocommerce">
                                <h2>Sign up</h2>
                                <?= $this->Form->create('', ['class' => 'login form-horizontal', 'id' => 'signup-form']); ?>
                                <input id="surname" required="required" type="text" name="surname" placeholder="Surname" class="form-control">
                                <input id="othernames" required="required" type="text" name="othernames" placeholder="Othernames" class="form-control">
                                <input id="email" type="email" name="email" placeholder="Email address" class="form-control">
                                <textarea id="institution" name="institution" placeholder="Institution" class="form-control"></textarea>
                                <select id="specialty" name="specialty" placeholder="Your specialty" class="form-control">
                                    <option value="Neurology">Neurology</option>
                                    <option value="Internal Medicine">Internal Medicine</option>
                                    <option value="General Practice">General Practice</option>
                                    <option value="Others">Others</option>
                                </select>
                                <input id="specialty-others" type="text" name="specialty_others" placeholder="Your specialty" class="form-control">
                                <label class="fancy-checkbox">
                                    <input type="checkbox" id="agree" name="agree" value="yes" required="required">
                                    <span>I accept the <?= $this->Html->link('Terms & Agreements', ['plugin' => 'acl', 'controller' => 'users', 'action' => 'terms'], ['target' => '_blank']); ?></span>
                                </label>
                                <div class="g-recaptcha" data-sitekey="6Lcs0XkUAAAAAFUWLZvJvH-P0zPsEm3QBtD4pDcf"></div>
                                <button class="btn btn-custom-primary btn-lg btn-block btn-auth" id="signup"><i class="fa fa-check-circle"></i> Signup</button>
                                <?= $this->Form->end(); ?>
                            </div>
                        </div><!-- /.entry -->
                    </div><!-- /.post-body -->
                </article><!-- /.post -->																		</div><!-- /.content -->
        </div><!-- /.columns large-8 -->
    </div><!-- /.row -->
</div><!-- /.main-body -->

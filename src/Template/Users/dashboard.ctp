<?php //$this->Html->script('layouts/admin/init', ['block' => 'scriptBottom']); ?>
<div class="row" style="margin-top:-20px">
    <div class="large-8 columns">
        <div class="box bg-transparent ">
            <!-- /.box-header -->
            <div class="box-header no-pad bg-transparent">

                <h3 style="margin-bottom:20px;" class="box-title">
                    <span>YOUR ENTRY HISTORY</span>
                </h3>


            </div>
            <div class="box-body no-pad">

                <div id="line-chart" style="height: 235px; width: 100%"></div>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

    <div class="large-4 columns">
        <div class="box bg-transparent ">
            <!-- /.box-header -->
            <div class="box-header no-pad bg-transparent">

                <h3 style="margin:0 20px 0 -5px;" class="box-title">
                    <span>STATS</span>
                </h3>


            </div>
            <div style="margin:15px 0 0" class="box-body no-pad">

                <div class="stats-wrap">
                    <h2><b class="counter-up" style="color:#666;"><?= $count;?></b> <!--<span  style="background:#666;" >+<b  class="counter-up">20</b>%</span>--></h2>
                    <p class="text-grey">Total entries reported by you!<small></small>
                    </p>
                    <!--
                    <h4><b class="counter-up" style="color:#888;">1,204</b> <span style="background:#888;">+<b class="counter-up">5</b>%</span></h4>
                    <p>Graduate <small>This week</small>
                    </p>

                    <h4 style="color:#333;"><b class="counter-up">2,690</b> <span  style="background:#333;">+<b class="counter-up">12,5</b></span></h4>
                    <p>New students<small>This Month</small>
                    </p>
                    -->
                </div>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>



<div class="row">
    <div class="large-6 columns">
        <!--<div class="your-account">
            <div class="row">
                <div class="medium-3 columns">
                    <!-- <div class="circle-progress"></div> -->
                    <!--<div class="circlestat" data-dimension="90" data-text="55%" data-width="8" data-fontsize="16" data-percent="55" data-fgcolor="#222" data-border="5" data-bgcolor="#D5DAE6" data-fill="#FFF"></div>
                </div>
                <div class="medium-9 columns ">
                    <div style="margin:0 10px;padding:0 0 0 20px" class="summary-border-left">
                        <h4>Your Account isn't complete!</h4>
                        <h6>You must <strong>complete</strong> this issues.</h6>
                        <ul>
                            <li class="label round bg-green"><a href="index.html#"><i class="text-white fontello-location"></i></a>
                            </li>
                            <li class="label round bg-green"><a href="index.html#"><i class="text-white fontello-user-add"></i></a>
                            </li>
                            <li class="label round bg-green"><a href="index.html#"><i class="text-white fontello-loop"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>-->

    </div>
    <?= $this->Html->link('<div class="large-2 columns">
        <div class="bg-complete-profile">
            <span class="bg-green fontello-user"></span>
            <!--   <img src="img/bag.png"> -->
            <h6 class="bg-black text-white"><strong>Your Profile</strong></h6>
        </div>
    </div>', ['plugin' => 'Acl', 'controller' => 'UserProfiles', 'action' => 'edit'], ['escape' => false]); ?>
        
    <?= $this->Html->link('<div class="large-2 columns">
        <div class="bg-complete-profile">
            <span class="bg-green fontello-edit"></span>
            <!-- <img src="img/box.png"> -->
            <h6 class="bg-black text-white">Edit Password</h6>
        </div>

    </div>', ['plugin' => 'Acl', 'controller' => 'Users', 'action' => 'changepassword'], ['escape' => false]); ?>

    <?= $this->Html->link('<div class="large-2 columns">
        <div class="bg-complete-profile">
            <span class="bg-green  fontello-lock"></span>
            <!--  <i class="img/count.png"></i> -->
            <h6 class="bg-black text-white">Log out</h6>
        </div>

    </div>', ['plugin' => 'Acl', 'controller' => 'Users', 'action' => 'logout'], ['escape' => false]); ?>

</div>
               

<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
    <div class="page-title">

        <div class="pull-left">
            <h1 class="title"> <?php Yii::t('app', 'Dashboard') ?></h1>                            </div>


    </div>
</div>
<div class="clearfix"></div>

<div class="col-lg-12">
    <section class="box nobox">
        <div class="content-body" >
        
        <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="r4_counter db_box">
                        <i class='pull-left fa fa-thumbs-up icon-md icon-rounded icon-primary'></i>
                        <div class="stats">
                            <h4><strong><?= $all_status['current_level'] ?></strong></h4>
                            <span><?= Yii::t('app', 'User Level') ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="r4_counter db_box">
                        <i class='pull-left fa fa-shopping-cart icon-md icon-rounded icon-orange'></i>
                        <div class="stats">
                            <h4><strong><?= $all_status['current_user'] ?></strong></h4>
                            <span> <?= Yii::t('app', 'Total User') ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="r4_counter db_box">
                        <i class='pull-left fa fa-dollar icon-md icon-rounded icon-purple'></i>
                        <div class="stats">
                            <h4><strong><?= $all_status['user_remning'] ?></strong></h4>
                            <span> <?= Yii::t('app', 'Remaining User') ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="r4_counter db_box">
                        <i class='pull-left fa fa-users icon-md icon-rounded icon-warning'></i>
                        <div class="stats">
                            <h4><strong><?= $all_status['current_stock'] ?></strong></h4>
                            <span><?= Yii::t('app', 'Current Stock') ?></span>
                        </div>
                    </div>
                </div>
        </div> <!-- End .row -->    
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="r4_counter db_box">
                    <i class='pull-left fa fa-thumbs-up icon-md icon-rounded icon-primary'></i>
                    <div class="stats">
                        <h4><strong><?= $all_status['current_profit'] ?></strong></h4>
                        <span> <?= Yii::t('app', 'Profit') ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="r4_counter db_box">
                    <i class='pull-left fa fa-shopping-cart icon-md icon-rounded icon-orange'></i>
                    <div class="stats">
                        <h4><strong><?= $all_status['total_order'] ?></strong></h4>
                        <span><?= Yii::t('app', 'Total Orders') ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="r4_counter db_box">
                    <i class='pull-left fa fa-dollar icon-md icon-rounded icon-purple'></i>
                    <div class="stats">
                        <h4><strong><?= $all_status['pending_order'] ?></strong></h4>
                        <span><?= Yii::t('app', 'Pending Orders') ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="r4_counter db_box">
                    <i class='pull-left fa fa-users icon-md icon-rounded icon-warning'></i>
                    <div class="stats">
                        <h4><strong><?= $all_status['approved_order'] ?></strong></h4>
                        <span> <?= Yii::t('app', 'Approved Orders') ?></span>
                    </div>
                </div>
            </div>
        </div> <!-- End .row -->             
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="r4_counter db_box">
                    <i class='pull-left fa fa-thumbs-up icon-md icon-rounded icon-primary'></i>
                    <div class="stats">
                        <h4><strong><?= $all_status['current_profit'] ?></strong></h4>
                        <span> <?= Yii::t('app', 'Returned Units') ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="r4_counter db_box">
                    <i class='pull-left fa fa-shopping-cart icon-md icon-rounded icon-orange'></i>
                    <div class="stats">
                        <h4><strong><?= $all_status['total_order'] ?></strong></h4>
                        <span><?= Yii::t('app', 'Transferred Units') ?></span>
                    </div>
                </div>
            </div>
        </div> <!-- End .row -->             

      </div>
    </section>
</div>



               
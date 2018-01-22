<!-- START TOPBAR -->
<?php use yii\helpers\Url;
        use yii\db\Query;
?>
        <div class='page-topbar '>
            <div class='logo-area'>

            </div>
            <div class='quick-area'>
                <div class='pull-left'>
                    <ul class="info-menu left-links list-inline list-unstyled">
                        <li class="sidebar-toggle-wrap">
                            <a href="#" data-toggle="sidebar" class="sidebar_toggle">
                                <i class="fa fa-bars"></i>
                            </a>
                        </li>
                        <?php  if (!Yii::$app->user->isGuest) {?>
                            <?php $status_stock =  (new Query())
    ->select('SUM(remaining_quantity) as remaning_stock,SUM(initial_quantity) as initial_stock')
    ->from('stock_in')
    ->where(['=','user_id',Yii::$app->user->identity->id])
    ->groupby(['product_id'])
    ->one();
    $stock_remaning_percent = $status_stock['remaning_stock'] / $status_stock['initial_stock'];
    $stock_remaning_percent = $stock_remaning_percent *100;
$selected_percentage = \common\models\StockStatus::findOne(['user_id'=>Yii::$app->user->identity->id]);
$remaning_percent  = '';
if($selected_percentage){
if($selected_percentage->below_percentage > $stock_remaning_percent ){
    $remaning_percent = round($stock_remaning_percent);
}else{
    $remaning_percent  = '';
}
}
    ?>
                        <li class="notify-toggle-wrapper">
                        <a href="#" data-toggle="dropdown" class="toggle">
                                <i class="fa fa-bell"></i>
                                <span class="badge badge-orange">
                                <?php if($remaning_percent ) { ?>
                                1
                                     <?php }else{ ?>
                                      0

                                     <?php }
                                        ?>
                                </span>
                            </a>
                            <ul class="dropdown-menu notifications animated fadeIn">
                                <li class="total">
                                    <span class="small">
                                    <?php if($remaning_percent ) { ?>
                                        You have <strong>1</strong> new notifications.
                                    <?php  }else{ ?>
                                        You have <strong>no</strong> new notifications.

                                     <?php }
                                        ?>
                                    </span>
                                </li>
                                <li class="list">

                                    <ul class="dropdown-menu-list list-unstyled ps-scrollbar">
                                        <li class="unread available"> <!-- available: success, warning, info, error -->
                                            <a href="javascript:;">
                                                <div class="notice-icon">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div>
                                                <?php if($remaning_percent ) { ?>
                                                    <span class="name">
                                                        <strong>Your Remaning stock is <?php echo $remaning_percent ?>%</strong>
                                                        
                                                    </span>
                                    <?php  }else{ ?>
                                        <strong>Your Remaning stock is <?php echo $remaning_percent ?>%</strong>

                                     <?php }
                                        ?>
                                                   
                                                </div>
                                            </a>
                                        </li>
                                 

                                    </ul>

                                </li>

                                <li class="external">
                                    <a href="javascript:;">
                                        <!-- <span>Read All Notifications</span> -->
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="hidden-sm hidden-xs searchform">
                            <div class="input-group">
                            
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>      
                <div class='pull-right'>
  
  
                    <ul class="info-menu right-links list-inline list-unstyled">
                    <?php  if (Yii::$app->user->isGuest) {?>
                       
                      <li><a data-method="POST" href="<?= Yii::$app->request->baseUrl;?>/site/login">Login</a></li>
                      <?php }else{?>
                        <li class="">
								<a class="data-toggle" data-toggle="dropdown">
                                <span> language <i class="fa fa-angle-down"></i></span>
	 							   <p class="hidden-lg hidden-md">Profile</p>
		 						</a>
		 							<ul class="dropdown-menu">
									<li><a  href="<?php echo Yii::$app->request->baseUrl;?>/site/language?language=en-US">English</a></li>
									<li><a href="<?php echo Yii::$app->request->baseUrl; ?>/site/language?language=th-TH">Thiland</a></li>
								</ul>
							</li>
                            <?php // Yii::t('app','Tranfer from');?>
                        <li class="profile">
                            <a href="#" data-toggle="dropdown" class="toggle">
                                <img src="<?= Yii::$app->homeUrl; ?>images/profile.jpg" alt="user-image" class="img-circle img-inline">
                                <span><?php echo Yii::$app->user->identity->username ?> <i class="fa fa-angle-down"></i></span>
                            </a>
                            <ul class="dropdown-menu profile animated fadeIn">
                                <li>
                                    <a href="#settings">
                                        <i class="fa fa-wrench"></i>
                                        Settings
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Yii::$app->homeUrl;?>user/view/<?= Yii::$app->user->identity->id?>">
                                        <i class="fa fa-user"></i>
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="#help">
                                        <i class="fa fa-info"></i>
                                        Help
                                    </a>
                                </li>
                                <li class="last">
                                    <a data-method="post" href="<?= Yii::$app->request->baseUrl;?>/site/logout">
                                        <i class="fa fa-lock"></i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                     
                      <?php } ?>
              
                    </ul>           
                </div>      
            </div>

        </div>
        <!-- END TOPBAR -->
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
                        <?php 
                        $remaning_percent = '';
                        if (!Yii::$app->user->isGuest) {?>
                            <?php $status_stock_child =  (new Query())
                                ->select('SUM(stock_in.remaining_quantity) as remaning_stock,SUM(stock_in.initial_quantity) as initial_stock,user.username as name,user.id as id')
                                ->from('stock_in')
                                ->innerJoin('user', 'stock_in.user_id = user.id')
                                ->where(['=','user.parent_id',Yii::$app->user->identity->id])
                                ->groupby(['stock_in.product_id','user.id'])
                                ->all();
                             
                                ?>
                        <li class="notify-toggle-wrapper">
                        <a href="#" data-toggle="dropdown" class="toggle">
                                <i class="fa fa-bell"></i>
                                <span class="badge badge-orange">
                                <?php if($status_stock_child) {
                                        $i = 0;    
                                        $all_notification = '';                                    ?>
<?php foreach($status_stock_child as $status_stock){
    
      $stock_remaning_percent = $status_stock['remaning_stock'] / $status_stock['initial_stock'];
      $stock_remaning_percent = $stock_remaning_percent *100;
  $selected_percentage = \common\models\StockStatus::find()->where(['user_id'=>$status_stock['id']])->one();
  $remaning_percent  = '';
  if($selected_percentage){
  if($selected_percentage->below_percentage > $stock_remaning_percent ){
      $i++;
      $remaning_percent = round($stock_remaning_percent);
  $all_notification.=  ' <li class="unread available">   <a href="javascript:;">
  <div class="notice-icon"> <i class="fa fa-check"></i> </div><div><span class="name">
  '.$status_stock['name'].' has <strong> '.$remaning_percent.'%</strong>
                                                     </span>   </div>
                                                     </a>
                                                 </li>';
  }
  }
}
echo $i;

                                                    }
                                                
?>
                                </span>
                            </a>
                            <ul class="dropdown-menu notifications animated fadeIn">
                                <li class="total">
                                    <span class="small">
     <?= Yii::t('app', 'You have');?> <strong><?= $i; ?></strong><?= Yii::t('app', 'New Notifications.');?>
         
                              </span>
                                </li>
                                <li class="list">

                                    <ul class="dropdown-menu-list list-unstyled ps-scrollbar">
                                      
                                                <?= $all_notification;?>
                                          
                                 

                                    </ul>

                                </li>

                                <li class="external">
                                    <a href="javascript:;">
                                        <!-- <span>Read All Notifications</span> -->
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- <li class="hidden-sm hidden-xs searchform">
                            <div class="input-group">
                            
                            </div>
                        </li> -->
                        <li class="message-toggle-wrapper">
								<a class="data-toggle" data-toggle="dropdown">
                                <span class="languageDropdown"><i class="fa fa-globe"></i></span>
	 							   <!-- <p class="hidden-lg hidden-md"><?= Yii::t('app', 'Profile');?></p> -->
		 						</a>
		 							<ul class="dropdown-menu language">
                                        <li><a href="<?php echo Yii::$app->request->baseUrl; ?>/site/language?language=th-TH"><img src="<?= Yii::$app->homeUrl; ?>images/thai-flag.png" alt="user-image" class="img-circle">TH</a></li>
									<li><a  href="<?php echo Yii::$app->request->baseUrl;?>/site/language?language=en-US"><img src="<?= Yii::$app->homeUrl; ?>images/uk-flag.png" alt="user-image" class="img-circle">EN</a></li>
									
								</ul>
							</li>
                        <?php } ?>
                    </ul>
                </div>      
                <div class='pull-right'>
  
  
                    <ul class="info-menu right-links list-inline list-unstyled">
                    <?php  if (Yii::$app->user->isGuest) {?>
                       
                      <li><a data-method="POST" href="<?= Yii::$app->request->baseUrl;?>/site/login"><?= Yii::t('app', 'Login');?></a></li>
                      <?php }else{?>
                                                   <?php // Yii::t('app','Tranfer from');?>
                        <li class="profile">
                            <a href="#" data-toggle="dropdown" class="toggle">
                                <img src="<?= Yii::$app->homeUrl; ?>images/profile.jpg" alt="user-image" class="img-circle img-inline">
                                <span><?php echo Yii::$app->user->identity->username ?> <i class="fa fa-angle-down"></i></span>
                            </a>
                            <ul class="dropdown-menu profile animated fadeIn">
                                <li>
                                    <a href="<?= Yii::$app->homeUrl;?>user/view/<?= Yii::$app->user->identity->id?>">
                                        <i class="fa fa-user"></i>
                                        <?= Yii::t('app', 'PROFILE');?>
                                    </a>
                                </li>
                               
                                <li class="last">
                                    <a data-method="post" href="<?= Yii::$app->request->baseUrl;?>/site/logout">
                                        <i class="fa fa-lock"></i>
                                        <?= Yii::t('app', 'Logout');?>
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
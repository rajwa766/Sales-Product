 <?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\models\users_level;
?>
 <!-- SIDEBAR - START -->
            <div class="page-sidebar ">

                <!-- MAIN MENU - START -->
                <div class="page-sidebar-wrapper" id="main-menu-wrapper"> 

                    <!-- USER INFO - START -->
                    <div class="profile-info row">

                        <div class="profile-image col-md-4 col-sm-4 col-xs-4">
                            <a href="<?= Yii::$app->homeUrl;?>site/index">
                                <img src="<?= Yii::$app->homeUrl; ?>images/profile.jpg" class="img-responsive img-circle">
                            </a>
                        </div>

                        <div class="profile-details col-md-8 col-sm-8 col-xs-8">

                            <h3>
                                <a href="<?= Yii::$app->homeUrl;?>user/view/<?= Yii::$app->user->identity->id?>"><?php echo Yii::$app->user->identity->username; ?></a>

                                <!-- Available statuses: online, idle, busy, away and offline -->
                                <span class="profile-status online"></span>
                            </h3>
                            <?php 
                            $user_level = '';

                            $query = (new \yii\db\Query())->select(['name'])->from('users_level')->where(['id' => Yii::$app->user->identity->user_level_id]);
                                $command = $query->createCommand();
                                $data = $command->queryAll();
                                
                                 foreach($data as $row) {
                                    $user_level .= $row['name'];
                                }



                            ?>
                            <p class="profile-title"><?php echo $user_level; ?></p>

                        </div>

                    </div>
                    <!-- USER INFO - END -->



                    <ul class='wraplist'>	


                        <li class="open"> 
                            <a href="<?= Yii::$app->homeUrl;?>site/index">
                                <i class="fa fa-dashboard"></i>
                                <span class="title"><?= Yii::t('app','Dashboard'); ?></span>
                            </a>
                        </li>
                        <!-- profile -->
                        <li class=""> 
                            <a href="javascript:;">
                                <i class="fa fa-user"></i>
                                <span class="title"><?= Yii::t('app','PROFILE'); ?></span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>
                                    <a class="" href="<?= Yii::$app->homeUrl;?>user/view/<?= Yii::$app->user->identity->id?>"><?= Yii::t('app', 'Visit Profile');?></a>

                                </li>
                                <li>
                                    <a class="" href="<?= Yii::$app->homeUrl;?>user/update/<?= Yii::$app->user->identity->id?>" ><?= Yii::t('app', 'Update Profile');?></a>
                                </li>
                               
                                
                            </ul>
                        </li>
                        <!-- end profile -->
                        <?php  
                         $user_id = Yii::$app->user->getId();
                         $Role =   Yii::$app->authManager->getRolesByUser($user_id);
 if(!isset($Role['customer'])){
    
                        ?>
                        <li class=""> 
                            <a href="javascript:;">
                                <i class="fa fa-users"></i>
                                <span class="title"><?= Yii::t('app','User'); ?></span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>
                                    <a class="" href="<?= Yii::$app->homeUrl; ?>user"><?= Yii::t('app', 'User');?></a>

                                </li>
                                <li>
                                    <a class="" href="<?= Yii::$app->homeUrl; ?>user/create" ><?= Yii::t('app', 'Create User');?></a>
                                </li>
                                
                                
                            </ul>
                        </li>
 <?php  }  ?>
                     <!-- order -->
                     <li class=""> 
                            <a href="javascript:;">
                                <i class="fa fa-pencil-square-o"></i>
                                <span class="title"><?= Yii::t('app','Order'); ?></span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>
                                    <a class="" href="<?= Yii::$app->homeUrl; ?>order"> <?= Yii::t('app', 'Order');?></a>

                                </li>
                             
                                <?php

 if(!isset($Role['customer'])){
                                ?>
                                <li>
                                    <a class="" href="<?= Yii::$app->homeUrl; ?>order/return"><?= Yii::t('app', 'RETURN ORDERS');?>
                                    <span class="label label-orange"><?= \common\models\Order::find()->where(['order_request_id'=>Yii::$app->user->identity->id])->andWhere(['status'=>'3'])->count(); ?></span>
                                
                                </a>

                                </li>
                                <?php
                                if(isset($Role['super_admin'])){ ?>
                                <li>
                                    <a class="" href="<?= Yii::$app->homeUrl; ?>order/transfer"><?= Yii::t('app', 'Transfer Request');?>
                                    <span class="label label-orange"><?= \common\models\Order::find()->where(['status'=>'5'])->count(); ?></span>
                                </a>
                                </li>
                                <?php }else{ ?>
                                    <li>
                                    <a class="" href="<?= Yii::$app->homeUrl; ?>order/transfer"><?= Yii::t('app', 'Transfer Request');?>
                                    <span class="label label-orange"><?= \common\models\Order::find()->where(['status'=>'5'])->andWhere(['user_id'=>Yii::$app->user->identity->id])->count(); ?></span>
                                </a>
                                </li>
                                <?php } ?>
                                <li>
                                
                                    <a class="" href="<?= Yii::$app->homeUrl; ?>order/pending"><?= Yii::t('app', 'Pending Orders');?>
                                    <span class="label label-orange"><?= \common\models\Order::find()->where(['order_request_id'=>Yii::$app->user->identity->id])->andWhere(['status'=>'0'])->count(); ?></span>
                                </a>

                                </li>
                                <li>
                                    <a class="" href="<?= Yii::$app->homeUrl; ?>order/approved"><?= Yii::t('app', 'Approved Orders');?>
                                    <span class="label label-orange"><?= \common\models\Order::find()->where(['order_request_id'=>Yii::$app->user->identity->id])->andWhere(['status'=>'1'])->count(); ?></span>
                                
                                </a>

                                </li>
 <?php }?>
                            </ul>
                        </li>
                                <!-- order -->
            
              
                     <!-- order ends -->
              <?php       if(!isset($Role['customer'])){ ?>
                     <li class=""> 
                            <a href="javascript:;">
                                <i class="fa fa-users"></i>
                                <span class="title"><?= Yii::t('app','Stock'); ?></span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>
                                <a class="" href="<?= Yii::$app->homeUrl; ?>stock-in"><?= Yii::t('app', 'Stock');?></a>
                                </li>
                            
                                
                                
                            </ul>
                        </li>

                        <!-- reports starts here -->
                        <li class=""> 
                            <a href="javascript:;">
                                <i class="fa fa-flag-checkered"></i>
                                <span class="title"><?= Yii::t('app','Report'); ?></span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>
                                    <a class="" href="<?= Yii::$app->homeUrl; ?>reports/inventory-report"><?= Yii::t('app', 'Inventory');?></a>

                                </li>
                                <li>
                                    <a class="" href="<?= Yii::$app->homeUrl; ?>reports/order-report"><?= Yii::t('app', 'Order');?></a>

                                </li>
                            </ul>
                        </li>
                     <?php } ?>
                     <li class=""> 
                            <a href="javascript:;">
                                <i class="fa fa-users"></i>
                                <span class="title"><?= Yii::t('app','Stock Status'); ?></span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>
                                <a class="" href="<?= Yii::$app->homeUrl; ?>stock-status"><?= Yii::t('app', 'Stock Status');?></a>
                                </li>
                            
                                
                                
                            </ul>
                        </li>
                        <!-- reports ends here -->
                    </ul>

                </div>
                <!-- MAIN MENU - END -->


<div class="project-info">

                    <div class="block1">
                        <div class="data">
                            <span class='title'><?= Yii::t('app', 'New Orders');?></span>
                            <span class='total'>2,345</span>
                        </div>
                        <div class="graph">
                            <span class="sidebar_orders">...</span>
                        </div>
                    </div>

                    <div class="block2">
                        <div class="data">
                            <span class='title'><?= Yii::t('app', 'Visitors');?></span>
                            <span class='total'>345</span>
                        </div>
                        <div class="graph">
                            <span class="sidebar_visitors">...</span>
                        </div>
                    </div>

                </div>
                

            </div>
            <!--  SIDEBAR - END -->
 <?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>
 <!-- SIDEBAR - START -->
            <div class="page-sidebar ">

                <!-- MAIN MENU - START -->
                <div class="page-sidebar-wrapper" id="main-menu-wrapper"> 

                    <!-- USER INFO - START -->
                    <div class="profile-info row">

                        <div class="profile-image col-md-4 col-sm-4 col-xs-4">
                            <a href="ui-profile.html">
                                <img src="<?= Yii::$app->homeUrl; ?>images/profile.jpg" class="img-responsive img-circle">
                            </a>
                        </div>

                        <div class="profile-details col-md-8 col-sm-8 col-xs-8">

                            <h3>
                                <a href="<?= Yii::$app->homeUrl;?>user/view/<?= Yii::$app->user->identity->id?>"><?php echo Yii::$app->user->identity->username; ?></a>

                                <!-- Available statuses: online, idle, busy, away and offline -->
                                <span class="profile-status online"></span>
                            </h3>

                            <p class="profile-title">Web Developer</p>

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
                                <span class="title"><?= Yii::t('app','Profile'); ?></span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu" >
                                <li>
                                    <a class="" href="<?= Yii::$app->homeUrl;?>user/view/<?= Yii::$app->user->identity->id?>">Visit Profile</a>

                                </li>
                                <li>
                                    <a class="" href="<?= Yii::$app->homeUrl;?>user/update/<?= Yii::$app->user->identity->id?>" >Update Profile</a>
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
                                    <a class="" href="<?= Yii::$app->homeUrl; ?>user">User</a>

                                </li>
                                <li>
                                    <a class="" href="<?= Yii::$app->homeUrl; ?>user/create" >Create User</a>
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
                                    <a class="" href="<?= Yii::$app->homeUrl; ?>order">Orders</a>

                                </li>
                             
                                <?php

 if(!isset($Role['customer'])){
                                ?>
                                <li>
                                    <a class="" href="<?= Yii::$app->homeUrl; ?>order/return">Return Orders
                                    <span class="label label-orange"><?= \common\models\Order::find()->where(['order_request_id'=>Yii::$app->user->identity->id])->andWhere(['status'=>'3'])->count(); ?></span>
                                
                                </a>

                                </li>
                                <?php
                                if(isset($Role['super_admin'])){ ?>
                                <li>
                                    <a class="" href="<?= Yii::$app->homeUrl; ?>order/transfer">Transfer Request
                                    <span class="label label-orange"><?= \common\models\Order::find()->where(['status'=>'5'])->count(); ?></span>
                                </a>
                                </li>
                                <?php }else{ ?>
                                    <li>
                                    <a class="" href="<?= Yii::$app->homeUrl; ?>order/transfer">Transfer Request
                                    <span class="label label-orange"><?= \common\models\Order::find()->where(['status'=>'5'])->andWhere(['user_id'=>Yii::$app->user->identity->id])->count(); ?></span>
                                </a>
                                </li>
                                <?php } ?>
                                <li>
                                
                                    <a class="" href="<?= Yii::$app->homeUrl; ?>order/pending">Pending Orders
                                    <span class="label label-orange"><?= \common\models\Order::find()->where(['order_request_id'=>Yii::$app->user->identity->id])->andWhere(['status'=>'0'])->count(); ?></span>
                                </a>

                                </li>
                                <li>
                                    <a class="" href="<?= Yii::$app->homeUrl; ?>order/approved">Approved Orders
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
                                    <a class="" href="<?php Yii::$app->homeUrl; ?>stock-in"><?= Yii::t('app','Stock'); ?></a>

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
                                    <a class="" href="<?= Yii::$app->homeUrl; ?>order/inventory-reports">INVENTORY</a>

                                </li>
                                <li>
                                    <a class="" href="<?= Yii::$app->homeUrl; ?>order/status-reports">Order</a>

                                </li>
                            </ul>
                        </li>
                     <?php } ?>
                        <!-- reports ends here -->
                    </ul>

                </div>
                <!-- MAIN MENU - END -->


<div class="project-info">

                    <div class="block1">
                        <div class="data">
                            <span class='title'>New&nbsp;Orders</span>
                            <span class='total'>2,345</span>
                        </div>
                        <div class="graph">
                            <span class="sidebar_orders">...</span>
                        </div>
                    </div>

                    <div class="block2">
                        <div class="data">
                            <span class='title'>Visitors</span>
                            <span class='total'>345</span>
                        </div>
                        <div class="graph">
                            <span class="sidebar_visitors">...</span>
                        </div>
                    </div>

                </div>
                

            </div>
            <!--  SIDEBAR - END -->
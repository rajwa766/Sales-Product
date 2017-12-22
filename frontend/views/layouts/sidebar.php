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
                                <img src="<?= Yii::$app->homeUrl; ?>images/avatar-1.png" class="img-responsive img-circle">
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
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <!-- profile -->
                        <li class=""> 
                            <a href="javascript:;">
                                <i class="fa fa-user"></i>
                                <span class="title">Profile</span>
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
                        <li class=""> 
                            <a href="javascript:;">
                                <i class="fa fa-suitcase"></i>
                                <span class="title">User</span>
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
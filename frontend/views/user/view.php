<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    

   

    <div class="row lg-padding">
        <div class="col-lg-3 ">
            <div class="profile">
                <img src="http://localhost:8080/sales-management-system/frontend/web/images/placeholder-profile.png" class="img-circle img-inline add-border" height="250"><br/>

                <div class="username"><strong>@ <?php echo $model->username; ?></strong><br/>
                    Member Since  <?php echo $model->created_at; ?>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="other-details">
            <h3><strong>Other Profile Info</strong></h3>
            <ul class="profile-details">
                <li><i class="fa fa-envelope"></i>&nbsp <?php echo $model->email; ?></li>
                <li><i class="fa fa-phone"></i>&nbsp <?php echo $model->phone_no; ?></li>
                <li><i class="fa fa-globe"></i>&nbsp <?php echo $model->link; ?></li>
                <li><i class="fa fa-level-up"></i>&nbsp <?php echo $model->user_level_id; ?></li>
                <li><i class="fa fa-home"></i>&nbsp <?php echo $model->city; ?></li>
                <li><i class="fa fa-flag-o"></i>&nbsp <?php echo $model->country; ?></li>
                <li><i class="fa fa-map-marker"></i>&nbsp <?php echo $model->address; ?></li>
            </ul>
        </div>
    </div>
</div>

     <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
